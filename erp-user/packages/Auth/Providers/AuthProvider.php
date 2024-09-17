<?php
declare(strict_types=1);

namespace Auth\Providers;

use Auth\Infrastructure\Query\Eloquent\UserInfoQuery;
use Auth\App\QueryServices\UserInfoQueryInterface;
use Auth\Infrastructure\Query\Eloquent\OnetimeTokenQuery;
use Auth\App\QueryServices\OnetimeTokenQueryInterface;
use Auth\Infrastructure\Repositories\Eloquent\LoginRepository;
use Auth\Domain\Repositories\LoginRepositoryInterface;
use Auth\Infrastructure\Repositories\Eloquent\OnetimeTokenRepository;
use Auth\Domain\Repositories\OnetimeTokenRepositoryInterface;
use Auth\Infrastructure\Repositories\Eloquent\UserInfoRepository;
use Auth\Domain\Repositories\UserInfoRepositoryInterface;
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
        // Query
        app()->bind(UserInfoQueryInterface::class, UserInfoQuery::class);
        app()->bind(OnetimeTokenQueryInterface::class, OnetimeTokenQuery::class);
        // Repository
        app()->bind(LoginRepositoryInterface::class, LoginRepository::class);
        app()->bind(OnetimeTokenRepositoryInterface::class, OnetimeTokenRepository::class);
        app()->bind(UserInfoRepositoryInterface::class, UserInfoRepository::class);
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
            // Query
            UserInfoQueryInterface::class,
            OnetimeTokenQueryInterface::class,
            // Repository
            LoginRepositoryInterface::class,
            OnetimeTokenRepositoryInterface::class,
            UserInfoRepositoryInterface::class,
            // String
            StringInterface::class
        ];
    }
}
