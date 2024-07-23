<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;

class LocalizationController extends Controller
{
    public function index()
    {
        $languages = Language::all();
        return view('admin.localization.admin-index', compact('languages'));
    }
}