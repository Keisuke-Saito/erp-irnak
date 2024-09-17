<?php
declare(strict_types=1);

namespace Base\Exceptions;

class ValidationException extends PackagesBaseException
{
    protected $code = 422;
}
