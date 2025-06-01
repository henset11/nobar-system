<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Settings\GeneralSettings;
use Symfony\Component\HttpFoundation\Response;

class ResetPasswordEnabled
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!app(GeneralSettings::class)->password_reset_enabled) {
            abort(404);
        }

        return $next($request);
    }
}
