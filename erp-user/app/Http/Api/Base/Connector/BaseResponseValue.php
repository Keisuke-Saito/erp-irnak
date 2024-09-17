<?php
declare(strict_types=1);

namespace App\Http\Api\Base\Connector;

use App\Http\Api\Base\Exceptions\MethodNotAllowedException;

abstract class BaseResponseValue implements BaseConnecter
{
    protected $value;
    public function toArray(): array
    {
        return $this->value->toArray();
    }
}
