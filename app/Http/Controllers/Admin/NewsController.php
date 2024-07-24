<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Language;
use App\Models\News;
use App\Models\Tag;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class NewsController extends Controller implements HasMiddleware
{
    use FileUploadTrait;

    public static function middleware(): array
    {
        return [
            new Middleware('permission:News Index,admin', only: ['index', 'newsCopy']),
            new Middleware('permission:News Create,admin', only: ['create', 'store']),
            new Middleware('permission:News Update,admin', only: ['edit', 'update']),
            new Middleware('permission:News Delete,admin', only: ['destroy']),
            new Middleware('permission:News News All-Access,admin', only: ['toggleNewsStatus']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = Language::where('status', 1)->get();
        return view('admin.news.index', compact('languages'));
    }

    public function pendingNews()
    {
        $languages = Language::where('status', 1)->get();
        return view('admin.pending-news.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $languages = Language::where('status', 1)->get();
        return view('admin.news.create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $content = $request->content;

        $dom = new \DOMDocument();
        $dom->loadHTML('<?xml encoding="UTF-8">' . $content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        if ($images->length > 0) {
            foreach ($images as $k => $img) {
                $data = base64_decode(explode(',', explode(';', $img->getAttribute('src'))[1])[1]);
                $image_name = 'uploads/' . time() . $k . '.png';
                file_put_contents(public_path($image_name), $data);

                $img->removeAttribute('src');
                $img->setAttribute('src', asset($image_name));
            }

            $content = $dom->saveHTML();
        } else {
            $content = $request->content;
        }

        $imagePath = $this->handleFileUpload($request, 'image');

        $news = new News();

        if (canAccess(['News All-Access'])) {
            if ($news->author_id !== auth()->guard('admin')->user()->id) {
                return abort(403, 'Unauthorized');
            }
        }

        $news->author_id = \Auth::guard('admin')->user()->id;
        $news->language = $request->language;
        $news->category_id = $request->category;
        $news->title = $request->title;
        $news->content = $content;
        $news->image = $imagePath;

        $news->meta_title = $request->meta_title;
        $news->meta_description = $request->meta_description;
        $news->is_breaking_news = $request->is_breaking_news ? 1 : 0;
        $news->show_at_slider = $request->show_at_slider ? 1 : 0;
        $news->status = $request->status ? 1 : 0;
        $news->is_approved = getRole() == 'Admin' || checkPermission('News All-Access') ? 1 : 0;
        $news->save();

        $tags = explode(',', $request->tags);
        $tagIds = [];

        foreach ($tags as $tag) {
            $item = new Tag();
            $item->name = $tag;
            $item->language = $news->language;
            $item->save();

            $tagIds[] = $item->id;
        }

        $news->tags()->attach($tagIds);


        toast('Thêm bài viết thành công', 'success');
        if (getRole() == 'Admin' || checkPermission('News All-Access')) {
            return redirect()->route('admin.new.index');
        } else {
            return redirect()->route('admin.news-pending');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $languages = Language::all();
        $news = News::findOrFail($id);

        $categories = Category::where('language', $news->language)->get();
        return view('admin.news.edit', compact('languages', 'news', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $content = $request->content;

        $dom = new \DOMDocument();
        $dom->loadHTML('<?xml encoding="UTF-8">' . $content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        //nếu có ảnh dạng base64
        if ($images->length > 0) {
            foreach ($images as $k => $img) {
                if (strpos($img->getAttribute('src'), 'data:image') !== false) {
                    $data = base64_decode(explode(',', explode(';', $img->getAttribute('src'))[1])[1]);
                    $image_name = 'uploads/' . time() . $k . '.png';
                    file_put_contents(public_path($image_name), $data);

                    $img->removeAttribute('src');
                    $img->setAttribute('src', asset($image_name));
                } else {
                    $img->setAttribute('src', asset($img->getAttribute('src')));
                }
            }

            $content = $dom->saveHTML();
        } else {
            $content = $request->content;
        }


        $news = News::findOrFail($id);

        $imgePath = $this->handleFileUpload($request, 'image', $news->image);

        $news->author_id = \Auth::guard('admin')->user()->id;
        $news->language = $request->language;
        $news->category_id = $request->category;
        $news->title = $request->title;
        $news->content = $content;
        $news->image = $imgePath ?? $news->image;

        $news->meta_title = $request->meta_title;
        $news->meta_description = $request->meta_description;
        $news->is_breaking_news = $request->is_breaking_news ? 1 : 0;
        $news->show_at_slider = $request->show_at_slider ? 1 : 0;
        $news->status = $request->status ? 1 : 0;

        $news->save();

        $tags = explode(',', $request->tags);
        $tagIds = [];

        /** Delete previos tags */
        $news->tags()->delete();

        /** detach tags form pivot table */
        $news->tags()->detach($news->tags);

        foreach ($tags as $tag) {
            $item = new Tag();
            $item->name = $tag;
            $item->language = $news->language;
            $item->save();

            $tagIds[] = $item->id;
        }

        $news->tags()->attach($tagIds);

        toast('Cập nhật bài viết thành công', 'success');
        return redirect()->route('admin.new.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $news = News::findOrFail($id);
        $this->deleteFile($news->image);
        $news->tags()->delete();
        $news->delete();

        toast('Xóa bài viết thành công', 'success');
        return response(['status' => 'success',]);
    }

    function fetchNewsCategory(Request $request)
    {
        $categories = Category::where('language', $request->lang)->get();
        return $categories;
    }

    public function toggleNewsStatus(Request $request)
    {
        try {
            $news = News::findOrFail($request->id);
            $news->{$request->name} = $request->status;
            $news->save();

            return response(['status' => 'success', 'message' => 'Cập nhật trạng thái thành công']);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function newsCopy(string $id)
    {
        $news = News::findOrFail($id);
        $copyNews = $news->replicate();

        $copyNews->title = $news->title . ' - Copy';
        $copyNews->save();

        toast('Sao chép bài viết thành công', 'success');
        return redirect()->route('admin.new.index');
    }
}