<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\HomeSectionSettingRequest;
use App\Models\HomeSectionSetting;
use App\Models\Language;
use Illuminate\Http\Request;

class HomeSectionSettingController extends Controller
{
    public function index()
    {
        $languages = Language::all();
        return view('admin.home-section-setting.index', compact('languages'));
    }

    public function update(HomeSectionSettingRequest $request)
    {
        HomeSectionSetting::updateOrCreate(
            ['language' => $request->language],
            [
                'category_section_1' => $request->category_section_1,
                'category_section_2' => $request->category_section_2,
                'category_section_3' => $request->category_section_3,
                'category_section_4' => $request->category_section_4,
            ]
        );

        toast('Đã lưu cài đặt thành công', 'success');
        return redirect()->back();
    }
}