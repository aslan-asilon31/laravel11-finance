<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class LanguageController extends Controller
{
    public function setLanguage($lang)
    {
        if (in_array($lang, ['en', 'id', 'jp'])) {
            Session::put('locale', $lang);
            App::setLocale($lang);
        }
        $currentUrl = $request->url();
        $currentParams = $request->all();
        unset($currentParams['lang']);
        $currentParams['lang'] = $lang;
        $newUrl = $currentUrl . '?' . http_build_query($currentParams);
        return Redirect::to($newUrl);
        // return Redirect::back();
    }
}
