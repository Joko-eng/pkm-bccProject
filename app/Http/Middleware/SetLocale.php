<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
{
    $locale = session('locale', config('app.locale'));
    \Log::info('Locale in session: ' . $locale); // Tambahkan logging untuk debug
    App::setLocale($locale);

    return $next($request);
}

}
