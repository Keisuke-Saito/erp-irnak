<?php
declare(strict_types=1);

namespace App\Logging;

use Monolog\Formatter\LineFormatter;
use Monolog\Processor\IntrospectionProcessor;
use Monolog\Processor\WebProcessor;
use Monolog\Processor\MemoryUsageProcessor;
use Monolog\Logger;
use Illuminate\Support\Facades\Auth;

class  ActionLogFormatter
{
    private $dateFormat = 'Y-m-d H:i:s.v';

    public function __invoke($logger)
    {
        $format = '%level_name%[%datetime%] ';
        $format.= '%extra.ip% ';
        $format.= '%extra.userid%, ';
        $format.= '%extra.url%, ';
        $format.= '%extra.http_method%, ';
        $format.= '%message%, ';
        $format.= '%context%, ';
        $format.= 'memory: %extra.memory_usage% '.PHP_EOL;

        $lineFormatter = new LineFormatter($format, $this->dateFormat, true, true);
        $ip = new IntrospectionProcessor(Logger::DEBUG, ['Illuminate\\']);
        $wp = new WebProcessor();
        $mup = new MemoryUsageProcessor();

        foreach ($logger->getHandlers() as $handler) {
            $handler->setFormatter($lineFormatter);
            $handler->pushProcessor($ip);
            $handler->pushProcessor($wp);
            $handler->pushProcessor($mup);
            $handler->pushProcessor([$this, 'addExtraFields']);
        }
    }

    public function addExtraFields(array $record): array
    {
        $user = Auth::user();
        $record['extra']['userid'] = $user->erp_id ?? null;
        return $record;
    }
}