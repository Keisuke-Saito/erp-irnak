<?php
declare(strict_types=1);

namespace Fare\Providers;

use Fare\Infrastructure\Repositories\Eloquent\FareRepository;
use Fare\Domain\Repositories\FareRepositoryInterface;
use Fare\Infrastructure\Query\Eloquent\FareQuery;
use Fare\App\QueryServices\FareQueryInterface;
use Fare\Infrastructure\Query\Auth\AuthQuery;
use Fare\App\QueryServices\AuthQueryInterface;
use Fare\Infrastructure\Storage\Laravel\Storage;
use Fare\Domain\Storage\StorageInterface;
use Illuminate\Support\ServiceProvider;

class FareProvider extends ServiceProvider
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
        app()->bind(FareRepositoryInterface::class, FareRepository::class);
        // Query
        app()->bind(FareQueryInterface::class, FareQuery::class);
        app()->bind(AuthQueryInterface::class, AuthQuery::class);
        // Storage
        app()->bind(StorageInterface::class, Storage::class);
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
            FareRepositoryInterface::class,
            // Query
            FareQueryInterface::class,
            AuthQueryInterface::class,
            // Storage
            StorageInterface::class
        ];
    }
}
