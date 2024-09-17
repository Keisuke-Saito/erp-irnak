<?php
declare(strict_types=1);

namespace Employee\Providers;

use Employee\Infrastructure\Query\Package\CsvQuery;
use Employee\App\QueryServices\CsvQueryInterface;
use Employee\Infrastructure\Query\Eloquent\EmployeeQuery;
use Employee\App\QueryServices\EmployeeQueryInterface;
use Employee\Infrastructure\Notification\MailEmployeeNotification;
use Employee\Domain\Notification\EmployeeNotificationInterface;
use Employee\Infrastructure\Repositories\Eloquent\EmployeeRepository;
use Employee\Domain\Repositories\EmployeeRepositoryInterface;
use Employee\Infrastructure\Repositories\Eloquent\OnetimeTokenRepository;
use Employee\Domain\Repositories\OnetimeTokenRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class EmployeeProvider extends ServiceProvider
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
        app()->bind(EmployeeQueryInterface::class, EmployeeQuery::class);
        // Mail
        app()->bind(EmployeeNotificationInterface::class, MailEmployeeNotification::class);
        // Repository
        app()->bind(EmployeeRepositoryInterface::class, EmployeeRepository::class);
        app()->bind(OnetimeTokenRepositoryInterface::class, OnetimeTokenRepository::class);
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
            EmployeeQueryInterface::class,
            // Mail
            EmployeeNotificationInterface::class,
            // Repository
            EmployeeRepositoryInterface::class,
            OnetimeTokenRepositoryInterface::class
        ];
    }
}
