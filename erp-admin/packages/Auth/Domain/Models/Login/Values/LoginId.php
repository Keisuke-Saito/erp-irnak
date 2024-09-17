<?php
declare(strict_types=1);

namespace Auth\Domain\Models\Login\Values;

use Auth\Infrastructure\Bass\Model\BaseValue;

final class LoginId extends BaseValue
{
    /** @var string カラム名 */
    protected $column = 'ログインID';

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
