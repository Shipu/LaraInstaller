<?php

namespace Shipu\Installer\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class NotInstallMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->checkInstall()) {
            return redirect('/');
        }

        return $next($request);
    }

    public function checkInstall()
    {
        return env('APP_INSTALL');
    }
}