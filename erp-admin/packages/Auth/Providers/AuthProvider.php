<?php
declare(strict_types=1);

namespace Auth\Providers;

use Auth\Infrastructure\Repositories\Eloquent\LoginRepository;
use Auth\Domain\Repositories\LoginRepositoryInterface;
use Auth\Infrastructure\String\StrGenerater;
use Auth\Domain\Services\String\StringInterface;
use Illuminate\Support\ServiceProvider;

class AuthProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register services.
     *
     * @return void
     */
    public function register() {}

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Repository
        app()->bind(LoginRepositoryInterface::class, LoginRepository::class);
        // String
        app()->bind(StringInterface::class, StrGenerater::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            // Repository
            LoginRepositoryInterface::class,
            // String
            StringInterface::class
        ];
    }
}
