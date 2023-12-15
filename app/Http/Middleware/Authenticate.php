<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            // 特定のパス'/dashboard'へのアクセス時に、'/dashboard/login'へリダイレクトさせ
            if($request->is('dashboard') || $request->is('dashboard/*')){
                return url('dashboard/login');
            }

            // それ以外のパスへのアクセス時に、'/login'へリダイレクトさせる
            return route('login');
        }
    }
}
