<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function getNews()
    {
        $news = News::where(["is_breaking_news" => 1,])
            ->activeEntries()
            ->withLocalize()
            ->orderBy('created_at', 'desc')
            ->take(6)->get();

        return response()->json($news);
    }
}