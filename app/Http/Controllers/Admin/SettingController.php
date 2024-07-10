<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;


class SettingController extends Controller
{
    use FileUploadTrait;
    public function index()
    {
        return view('admin.setting.index');
    }

    function updateGeneralSetting(Request $request)
    {

        $logoPath = $this->handleFileUpload($request, 'site_logo');
        $faviconPath = $this->handleFileUpload($request, 'site_favicon');

        Setting::updateOrCreate(
            ['key' => 'site_name'],
            ['value' => $request->site_name]
        );

        if (!empty($logoPath)) {
            Setting::updateOrCreate(
                ['key' => 'site_logo'],
                ['value' => $logoPath]
            );
        }

        if (!empty($faviconPath)) {
            Setting::updateOrCreate(
                ['key' => 'site_favicon'],
                ['value' => $faviconPath]
            );
        }

        toast('Cập nhật thành công', 'success');

        return redirect()->back();
    }

    public function updateSeoSetting(Request $request)
    {
        Setting::updateOrCreate(
            ['key' => 'site_seo_title'],
            ['value' => $request->site_seo_title]
        );


        Setting::updateOrCreate(
            ['key' => 'site_seo_description'],
            ['value' => $request->site_seo_description]
        );


        Setting::updateOrCreate(
            ['key' => 'site_seo_keywords'],
            ['value' => $request->site_seo_keywords]
        );


        toast(__('Cập nhật thành công'), 'success');

        return redirect()->back();
    }

    function updateAppearanceSetting(Request $request)
    {
        $request->validate([
            'site_color' => ['required', 'max:200']
        ]);

        Setting::updateOrCreate(
            ['key' => 'site_color'],
            ['value' => $request->site_color]
        );

        toast('Cập nhật thành công', 'success');

        return redirect()->back();
    }
}