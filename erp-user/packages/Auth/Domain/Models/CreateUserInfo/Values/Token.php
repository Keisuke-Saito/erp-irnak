<?php
declare(strict_types=1);

namespace Auth\Domain\Models\CreateUserInfo\Values;

use Auth\Infrastructure\Bass\Model\BaseValue;

final class Token extends BaseValue
{
    /** @var string カラム名 */
    protected $column = 'トークン';
    /** @var int トークンタイプ・ユーザー作成 */
    private const CREATE_USER = 1;

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
     * ハッシュされたトークンを返す
     *
     * @return string
     */
    public function getHashedValue(): string
    {
        return hash('sha256', $this->value);
    }

    /**
     * トークンタイプ
     *
     * @return int
     */
    public function getTypeDiv(): int
    {
        return self::CREATE_USER;
    }
}
