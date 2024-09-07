<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLanguageApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $langauge = array_keys(config('app.langauges'));


        if($request->hasHeader('lang') && in_array($request->header('lang') ,$langauge))
        {

            app()->setLocale($request->header('lang'));
        }
        return $next($request);
    }
}