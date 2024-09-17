<?php
declare(strict_types=1);

namespace App\Http\Api\Auth\Logout;

use App\Http\Api\Base\Responder\EmptyContentResponder;

final class Responder extends EmptyContentResponder
{
    protected $status = 'created';
}
