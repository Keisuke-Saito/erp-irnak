<?php
declare(strict_types=1);

namespace App\Http\Api\Base\Responder;

use App\Http\Api\Base\Connector\BaseResponseValue;

interface ResponderInterface
{
    const STATUS_LIST = [
        'ok' => 200,
        'created' => 201,
        'badRequest' => 400,
        'unauthorized' => 401,
        'forbidden' => 403,
        'notFound' => 404,
    ];

    public function response();
    public function status();
    public function setValue(BaseResponseValue $value);
}
