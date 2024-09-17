<?php
declare(strict_types=1);

namespace Base\Exceptions;

class UnauthorizedException extends PackagesBaseException
{
    protected $code = 401;
}
