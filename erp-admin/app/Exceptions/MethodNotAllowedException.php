<?php
declare(strict_types=1);

namespace App\Exceptions;

final class MethodNotAllowedException extends BaseException
{
    protected $code = 405;
}
