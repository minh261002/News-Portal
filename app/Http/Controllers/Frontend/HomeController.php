<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\HomeSectionSetting;
use App\Models\News;
use App\Models\Tag;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $breakingNews = News::where(["is_breaking_news" => 1,])
            ->activeEntries()
            ->withLocalize()
            ->orderBy('created_at', 'desc')
            ->take(10)->get();

        $heroSlider = News::where(["show_at_slider" => 1,])
            ->activeEntries()
            ->withLocalize()
            ->orderBy('created_at', 'desc')
            ->take(6)->get();

        $recentNews = News::with(['category', 'author'])
            ->activeEntries()
            ->withLocalize()
            ->orderBy('created_at', 'desc')
            ->take(6)->get();

        $popularNews = News::activeEntries()
            ->withLocalize()
            ->orderBy('views', 'desc')
            ->take(4)->get();

        $homeSectionSetting = HomeSectionSetting::where('language', getLanguage())->first();
        $homeSection1 = News::where('category_id', $homeSectionSetting->category_section_1)
            ->activeEntries()
            ->withLocalize()
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();
        $homeSection2 = News::where('category_id', $homeSectionSetting->category_section_2)
            ->activeEntries()
            ->withLocalize()
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();
        $homeSection3 = News::where('category_id', $homeSectionSetting->category_section_3)
            ->activeEntries()
            ->withLocalize()
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();
        $homeSection4 = News::where('category_id', $homeSectionSetting->category_section_4)
            ->activeEntries()
            ->withLocalize()
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        $homeSection5 = News::where('category_id', $homeSectionSetting->category_section_5)
            ->activeEntries()
            ->withLocalize()
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        $tags = Tag::select('name', \DB::raw('COUNT(*) as count'))
            ->where('language', getLanguage())
            ->groupBy('name')
            ->orderByDesc('count')
            ->take(10)
            ->get();

        return view(
            'frontend.home',
            compact(
                'breakingNews',
                'heroSlider',
                'recentNews',
                'popularNews',
                'homeSection1',
                'homeSection2',
                'homeSection3',
                'homeSection4',
                'homeSection5',
                'tags'
            )
        );
    }
    public function news(Request $request)
    {

        $news = News::query();

        $news->when($request->has('tag'), function ($query) use ($request) {
            $query->whereHas('tags', function ($query) use ($request) {
                $query->where('name', $request->tag);
            });
        });

        $news->when($request->has('category') && !empty($request->category), function ($query) use ($request) {
            $query->whereHas('category', function ($query) use ($request) {
                $query->where('slug', $request->category);
            });
        });

        $news->when($request->has('search'), function ($query) use ($request) {
            $query->where(function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('content', 'like', '%' . $request->search . '%');
            })->orWhereHas('category', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            });
        });

        $news = $news->activeEntries()->withLocalize()->paginate(20);


        $recentNews = News::with(['category', 'author'])
            ->activeEntries()->withLocalize()->orderBy('id', 'DESC')->take(4)->get();
        $mostCommonTags = $this->mostCommonTags();

        $categories = Category::where(['status' => 1, 'language' => getLanguage()])->get();

        return view('frontend.news', compact('news', 'recentNews', 'mostCommonTags', 'categories'));
    }

    public function detail(string $slug)
    {
        $shareUrl = url()->current();

        $news = News::with(['author', 'tags', 'comments'])->where('slug', $slug)->activeEntries()->withLocalize()->first();

        $recentNews = News::with(['category', 'author'])
            ->where('category_id', $news->category_id)
            ->where('slug', '!=', $news->slug)
            ->activeEntries()
            ->withLocalize()
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $mostCommonTags = $this->mostCommonTags();

        $nextNews = News::where('id', '>', $news->id)->activeEntries()->withLocalize()->orderBy('id', 'asc')->first();
        $previousNews = News::where('id', '<', $news->id)->activeEntries()->withLocalize()->orderBy('id', 'desc')->first();
        $relatedNews = News::where('category_id', $news->category_id)->where('slug', '!=', $news->slug)->activeEntries()->withLocalize()->orderBy('created_at', 'desc')->take(5)->get();
        $this->countView($news);
        return view('frontend.news-detail', compact('news', 'recentNews', 'mostCommonTags', 'nextNews', 'previousNews', 'relatedNews', 'shareUrl'));
    }

    public function countView($news)
    {
        if (session()->has('viewed_posts')) {
            $postIds = session('viewed_posts');

            if (!in_array($news->id, $postIds)) {
                $postIds[] = $news->id;
                $news->increment('views');
            }
            session(['viewed_posts' => $postIds]);

        } else {
            session(['viewed_posts' => [$news->id]]);

            $news->increment('views');

        }
    }

    public function mostCommonTags()
    {
        return Tag::select('name', \DB::raw('COUNT(*) as count'))
            ->where('language', getLanguage())
            ->groupBy('name')
            ->orderByDesc('count')
            ->take(10)
            ->get();
    }

    public function handleComment(Request $request)
    {
        $request->validate([
            'comment' => 'required|string',
        ]);

        $comment = new Comment();
        $comment->news_id = $request->news_id;
        $comment->user_id = auth()->id();
        $comment->comment = $request->comment;
        $comment->parent_id = $request->parent_id;
        $comment->save();

        toast('Đã thêm bình luận thành công', 'success');
        return redirect()->back();
    }

    public function deleteComment(Request $request, $id)
    {
        try {
            $comment = Comment::findOrFail($id);

            if ($comment->children()->count() > 0) {
                foreach ($comment->children as $child) {
                    $child->delete();
                }
            }
            $comment->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Đã xóa bình luận'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Không thể xóa bình luận'
            ]);
        }
    }
}