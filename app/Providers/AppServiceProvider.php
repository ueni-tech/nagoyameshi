<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        Validator::extend('custom_email', function ($attribute, $value, $parameters, $validator) {
            return filter_var($value, FILTER_VALIDATE_EMAIL) && preg_match('/@.+\./', $value);
        });

        Validator::replacer('custom_email', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, 'メールアドレスは正しい形式で入力してください。');
        });

        if (App::environment(['production'])) {
            URL::forceScheme('https');
        }
    }
}
