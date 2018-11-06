<?php

namespace App\Http\Middleware;

use Closure;
use config;
use Illuminate\Support\Facades\App;
use Session;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $lang = Session::get('website_language', config('app.locale'));
        // Lấy dữ liệu lưu trong Session, không có thì trả về default lấy trong config
        App::setLocale($lang);
        // Chuyển ứng dụng sang ngôn ngữ được chọn

        return $next($request);
    }
}
