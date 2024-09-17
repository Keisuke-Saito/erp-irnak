<?php
declare(strict_types=1);

namespace Base\Exceptions;

class NotFoundException extends PackagesBaseException
{
    protected $code = 404;
}
