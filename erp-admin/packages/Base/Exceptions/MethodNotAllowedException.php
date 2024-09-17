<?php
declare(strict_types=1);

namespace Base\Exceptions;

class MethodNotAllowedException extends PackagesBaseException
{
    protected $code = 405;
}
