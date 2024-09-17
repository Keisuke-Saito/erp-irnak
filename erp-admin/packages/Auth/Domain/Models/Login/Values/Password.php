<?php
declare(strict_types=1);

namespace Auth\Domain\Models\Login\Values;

use Auth\Infrastructure\Bass\Model\BaseValue;

final class Password extends BaseValue
{
    /** @var string カラム名 */
    protected $column = 'パスワード';

    /**
     * Store a new controller instance.
     *
     * @param string $value
     * @return void
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }
}
