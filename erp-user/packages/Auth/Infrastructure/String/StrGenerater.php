<?php
declare(strict_types=1);

namespace Auth\Infrastructure\String;

use Auth\Domain\Services\String\StringInterface;

use Illuminate\Support\Str;

/**
 * 文字列関連
 */
class StrGenerater implements StringInterface
{
    /**
     * 文字列関連
     *
     * @return string
     */
    public function random60(): string
    {
        return Str::random(60);
    }
}
