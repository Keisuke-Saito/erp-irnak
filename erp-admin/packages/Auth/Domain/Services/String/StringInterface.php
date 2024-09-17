<?php
declare(strict_types=1);

namespace Auth\Domain\Services\String;

/**
 * トークン
 */
interface StringInterface
{
    /**
     * トークン
     *
     * @return string
     */
    public function random60(): string;
}
