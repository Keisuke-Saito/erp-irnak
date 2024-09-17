<?php
declare(strict_types=1);

namespace App\Logging;

use Monolog\Formatter\LineFormatter;
use Monolog\Processor\IntrospectionProcessor;
use Monolog\Processor\WebProcessor;
use Monolog\Logger;
use Illuminate\Support\Facades\Auth;

class  QueryLogFormatter
{
    private $dateFormat = 'Y-m-d H:i:s.v';

    public function __invoke($logger)
    {
        $format = '[%datetime%] ';
        $format.= '%extra.ip% ';
        $format.= '%extra.userid%, ';
        $format.= '%extra.url%, ';
        $format.= '%message% : %context% '.PHP_EOL;

        $lineFormatter = new LineFormatter($format, $this->dateFormat, true, true);
        $ip = new IntrospectionProcessor(Logger::DEBUG, ['Illuminate\\']);
        $wp = new WebProcessor();

        foreach ($logger->getHandlers() as $handler) {
            $handler->setFormatter($lineFormatter);
            $handler->pushProcessor($ip);
            $handler->pushProcessor($wp);
            $handler->pushProcessor([$this, 'addExtraFields']);
        }
    }

    public function addExtraFields(array $record): array
    {
        $user = Auth::user();
        $record['extra']['userid'] = $user->login_id ?? null;
        return $record;
    }
}