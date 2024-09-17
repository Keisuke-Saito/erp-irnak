<?php
declare(strict_types=1);

namespace Base\Exceptions;

class ConflictException extends PackagesBaseException
{
    protected $code = 409;
}
