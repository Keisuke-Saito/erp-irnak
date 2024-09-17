<?php

namespace App\Providers;

use App\Http\Api\Base\Validator\CustomValidator;
use Illuminate\Support\ServiceProvider;

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
        \Validator::resolver(function($translator, $data, $rules, $messages, $customAttributes) {
            return new CustomValidator($translator, $data, $rules, $messages, $customAttributes);
        });
    }
}
