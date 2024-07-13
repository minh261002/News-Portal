<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateLanguageRequest;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class LanguageController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('permission:Language Index,admin', only: ['index']),
            new Middleware('permission:Language Create,admin', only: ['create', 'store']),
            new Middleware('permission:Language Update,admin', only: ['edit', 'update']),
            new Middleware('permission:Language Delete,admin', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = Language::orderBy('id', 'desc')->get();
        return view('admin.languages.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.languages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateLanguageRequest $request)
    {
        $language = new Language();

        $language->lang = $request->lang;
        $language->name = $request->name;
        $language->slug = $request->slug;
        $language->default = $request->default;
        $language->status = $request->status;

        $language->save();

        toast('Ngôn ngữ đã được tạo thành công!', 'success');
        return redirect()->route('admin.languages.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $language = Language::findOrFail($id);
        return view('admin.languages.edit', compact('language'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $language = Language::findOrFail($id);

        $language->lang = $request->lang;
        $language->name = $request->name;
        $language->slug = $request->slug;
        $language->default = $request->default;
        $language->status = $request->status;

        $language->save();

        toast('Ngôn ngữ đã được cập nhật thành công!', 'success');
        return redirect()->route('admin.languages.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $language = Language::findOrFail($id);
        $language->delete();

        toast('Ngôn ngữ đã được xóa thành công!', 'success');
        return response(['status' => 'success']);
    }
}