<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $breakingNews = News::where([
            "is_breaking_news" => 1,
        ])->activeEntries()->withLocalize()->orderBy('created_at', 'desc')->take(10)->get();
        return view('frontend.home', compact('breakingNews'));
    }
}