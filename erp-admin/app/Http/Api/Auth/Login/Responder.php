<?php
declare(strict_types=1);

namespace App\Http\Api\Auth\Login;

use App\Http\Api\Base\Responder\CommonResponder;

final class Responder extends CommonResponder
{
    protected $badStatus = 'unauthorized';
}
