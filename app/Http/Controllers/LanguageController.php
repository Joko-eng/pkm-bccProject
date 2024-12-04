<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function switchLanguage($locale)
{
    $availableLocales = ['en', 'id', 'zh', 'fr', 'ja'];

    if (in_array($locale, $availableLocales)) {
        session(['locale' => $locale]);
        \Log::info('Locale switched to: ' . $locale);
    }

    \Log::info('Current session: ', session()->all()); // Menampilkan seluruh sesi

    return redirect()->back(); // Atau ke rute yang diinginkan
}

}
