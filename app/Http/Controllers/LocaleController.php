<?php

namespace App\Http\Controllers;

use App\Enums\SupportedLocale;
use Illuminate\Support\Facades\Session;

class LocaleController extends Controller
{
    public function update(string $locale)
    {
        if (!in_array($locale, SupportedLocale::values())){
            abort(400);
        }

        Session::put('locale', $locale);

        return redirect()->back();
    }
}