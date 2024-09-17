<?php
declare(strict_types=1);

namespace App\Http\Api\Base\Connector;

interface BaseConnecter
{
    public function toArray(): array;
}
