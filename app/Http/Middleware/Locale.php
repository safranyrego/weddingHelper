<?php

namespace App\Http\Middleware;

use App\Enums\SupportedLocale;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class Locale
{
    public function handle(Request $request, Closure $next)
    {
        if (Session::has('locale') AND in_array(Session::get('locale'), SupportedLocale::values())) {
            App::setLocale(Session::get('locale'));
        }

        return $next($request);
    }
}
