<?php
declare(strict_types=1);

namespace Auth\Domain\Models\Login;

use Auth\Domain\Services\String\StringInterface;

/**
 * ApiToken生成
 * @property StringInterface $str
 */
final class GenerateApiToken
{
    /** @var StringInterface 文字列関連 */
    private $str;

    /**
     * Store a new controller instance.
     *
     * @param StringInterface $str
     * @return void
     */
    public function __construct(
        StringInterface $str
    ){
        $this->str = $str;
    }

    /**
     * Store a new controller instance.
     *
     * @return string
     */
    public function __invoke(): string
    {
        return hash(config('app.API_HASH'), $this->str->random60());
    }
}
