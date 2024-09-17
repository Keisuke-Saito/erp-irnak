<?php
declare(strict_types=1);

namespace Auth\Domain\Models\CreateUserInfo\Values;

use Auth\Infrastructure\Bass\Model\BaseValue;

final class Password extends BaseValue
{
    /** @var string カラム名 */
    protected $column = 'パスワード';

    /**
     * Store a new controller instance.
     *
     * @param mixed $value
     * @return void
     */
    public function __construct($value)
    {
        parent::__construct($value);
    }

    /**
     * @param mixed $value
     * @return bool
     */
    protected function isValidValue($value): bool
    {
        return is_string($value);
    }

    /**
     * ハッシュされたパスワードを返す
     * laravelのfacade使用
     *
     * @return string
     */
    public function getHashedValue(): string
    {
        return \Hash::make($this->value);
    }
}
