<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoryRequest;
use App\Models\Category;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;


class CategoryController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:Category Index,admin', only: ['index']),
            new Middleware('permission:Category Create,admin', only: ['create', 'store']),
            new Middleware('permission:Category Update,admin', only: ['edit', 'update']),
            new Middleware('permission:Category Delete,admin', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = Language::all();
        return view('admin.categories.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $languages = Language::where('status', 1)->get();
        return view('admin.categories.create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCategoryRequest $request)
    {
        $category = new Category();

        $category->language = $request->language;
        $category->name = $request->name;
        $category->show_at_nav = $request->show_at_nav;
        $category->status = $request->status;
        $category->save();

        toast('Thêm danh mục thành công!', 'success');
        return redirect()->route('admin.categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        $languages = Language::where('status', 1)->get();

        return view('admin.categories.edit', compact('category', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);

        $category->language = $request->language;
        $category->name = $request->name;
        $category->show_at_nav = $request->show_at_nav;
        $category->status = $request->status;
        $category->save();

        toast('Cập nhật danh mục thành công!', 'success');
        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        toast('Xóa danh mục thành công!', 'success');
        return response()->json([
            'status' => 'success',
        ]);
    }
}