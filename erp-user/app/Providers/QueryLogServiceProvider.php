<?php
declare(strict_types=1);

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Events\TransactionBeginning;
use Illuminate\Database\Events\TransactionCommitted;
use Illuminate\Database\Events\TransactionRolledBack;

class QueryLogServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        \DB::listen(function ($query): void {
            $sql = $query->sql;

            foreach ($query->bindings as $binding) {
                if (is_string($binding)) {
                    $binding = "'{$binding}'";
                } elseif (is_bool($binding)) {
                    $binding = $binding ? '1' : '0';
                } elseif (is_int($binding)) {
                    $binding = (string) $binding;
                } elseif (is_float($binding)) {
                    $binding = (string) $binding;
                } elseif ($binding === null) {
                    $binding = 'NULL';
                } elseif ($binding instanceof Carbon) {
                    $binding = "'{$binding->toDateTimeString()}'";
                } elseif ($binding instanceof \DateTime) {
                    $binding = "'{$binding->format('Y-m-d H:i:s')}'";
                }

                $sql = preg_replace('/\\?/', $binding, $sql, 1);
            }

            $context = [
                'sql' => $sql,
                'time' => "{$query->time} ms"
            ];

            \Log::channel('sqllog')->info('SQL', $context);
            \Log::channel('action')->debug('SQL', $context);
        });

        \Event::listen(TransactionBeginning::class, function (TransactionBeginning $event): void {
            \Log::channel('sqllog')->info('START TRANSACTION');
            \Log::channel('action')->debug('START TRANSACTION');
        });

        \Event::listen(TransactionCommitted::class, function (TransactionCommitted $event): void {
            \Log::channel('sqllog')->info('COMMIT');
            \Log::channel('action')->debug('COMMIT');
        });

        \Event::listen(TransactionRolledBack::class, function (TransactionRolledBack $event): void {
            \Log::channel('sqllog')->info('ROLLBACK');
            \Log::channel('action')->debug('ROLLBACK');
        });
    }
}