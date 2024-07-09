<?php
use App\Models\Language;

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