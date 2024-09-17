<?php
declare(strict_types=1);

namespace App\Logging;

use Monolog\Formatter\LineFormatter;
use Monolog\Processor\IntrospectionProcessor;
use Monolog\Processor\MemoryUsageProcessor;
use Monolog\Logger;

class  BatchLogFormatter
{
    private $dateFormat = 'Y-m-d H:i:s.v';

    public function __invoke($logger)
    {
        $format = '%level_name%[%datetime%] ';
        $format.= '%extra.class%::%extra.function%(%extra.line%) ';
        $format.= '%message%, ';
        $format.= 'memory: %extra.memory_usage% '.PHP_EOL;

        $lineFormatter = new LineFormatter($format, $this->dateFormat, true, true);
        $lineFormatter->includeStacktraces(true);
        $ip = new IntrospectionProcessor(Logger::DEBUG, ['Illuminate\\']);
        $mup = new MemoryUsageProcessor();

        foreach ($logger->getHandlers() as $handler) {
            $handler->setFormatter($lineFormatter);
            $handler->pushProcessor($ip);
            $handler->pushProcessor($mup);
        }
    }
}