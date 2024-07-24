<?php
use App\Models\Language;
use App\Models\Setting;

function formatTags(array $tags): string
{
    return implode(',', $tags);
}

function getLanguage()
{
    if (session()->has('language')) {
        return session('language');
    } else {
        try {
            $language = Language::where('default', 1)->first();
            setLanguage($language->lang);
            return $language->lang;
        } catch (\Exception $e) {
            setLanguage('vi');
            return $language->lang;
        }
    }
}

function setLanguage($code)
{
    session(['language' => $code]);
}

function truncate(string $text, int $limit = 100)
{
    return \Str::limit($text, $limit, '...');
}

function convertToKFormat(int $num)
{
    if ($num < 1000) {
        return $num;
    } else if ($num < 1000000) {
        return round($num / 1000, 1) . 'K';
    } else {
        return round($num / 1000000, 1) . 'M';
    }
}

function setSidebarActive(array $routes)
{
    foreach ($routes as $route) {
        if (request()->routeIs($route)) {
            return 'active';
        }
    }
}

function getSetting($key)
{
    $data = Setting::where('key', $key)->first();
    return $data->value;
}

function canAccess(array $permissions)
{
    $permission = auth()->guard('admin')->user()->hasAnyPermission([$permissions]);
    $isAdmin = auth()->guard('admin')->user()->hasRole('Admin');

    if ($permission || $isAdmin) {
        return true;
    } else {
        return false;
    }
}

function getRole()
{
    $role = auth()->guard('admin')->user()->getRoleNames();
    return $role->first();
}

function checkPermission(string $permission)
{
    return auth()->guard('admin')->user()->hasPermissionTo($permission);
}