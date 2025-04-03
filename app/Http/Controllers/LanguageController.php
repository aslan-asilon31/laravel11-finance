<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class LanguageController extends Controller
{
    public function setLanguage(Request $request,$locale)
    {
        if (in_array($locale, ['en', 'id', 'jp'])) {
            Session::put('locale', $locale);
            App::setLocale($locale);
        }
        $previousUrl = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';

        if (empty($previousUrl)) {
            return Redirect::to('/')->with('error', 'Tidak ada URL sebelumnya.');
        }

        // Parse URL sebelumnya
        $parsedUrl = parse_url($previousUrl);

        // Mendapatkan path dari URL sebelumnya
        $path = $parsedUrl['path'] ?? '/';

        // Mendapatkan query dari URL sebelumnya
        $query = $parsedUrl['query'] ?? '';

        // Pisahkan path menjadi array
        $pathParts = explode('/', trim($path, '/'));

        // Periksa apakah path pertama adalah prefix bahasa lama
        if (in_array($pathParts[0], ['en', 'id', 'jp'])) {
            // Ganti prefix bahasa dengan yang baru
            $pathParts[0] = $locale;
        } else {
            // Jika tidak ada prefix bahasa, tambahkan prefix bahasa baru di awal
            array_unshift($pathParts, $locale);
        }

        // Gabungkan kembali path
        $newPath = '/' . implode('/', $pathParts);

        // Bangun kembali URL dengan prefix bahasa yang baru
        $newUrl = URL::to($newPath) . ($query ? '?' . $query : '');

        // Redirect ke URL yang baru
        return Redirect::to($newUrl);
        // return Redirect::back();
    }
}
