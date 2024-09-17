<?php
declare(strict_types=1);

namespace Common\Providers;

use Common\Infrastructure\Query\File\CsvQuery;
use Common\App\QueryServices\CsvQueryInterface;
use Common\Infrastructure\Query\Eloquent\CommonMstQuery;
use Common\App\QueryServices\CommonMstQueryInterface;
use Common\Infrastructure\Query\File\StorageQuery;
use Common\App\QueryServices\StorageQueryInterface;
use Illuminate\Support\ServiceProvider;

class CommonProvider extends ServiceProvider
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
        app()->bind(CsvQueryInterface::class, CsvQuery::class);
        app()->bind(CommonMstQueryInterface::class, CommonMstQuery::class);
        app()->bind(StorageQueryInterface::class, StorageQuery::class);
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
            CsvQueryInterface::class,
            CommonMstQueryInterface::class,
            StorageQueryInterface::class
        ];
    }
}
