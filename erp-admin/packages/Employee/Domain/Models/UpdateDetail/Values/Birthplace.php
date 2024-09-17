<?php
declare(strict_types=1);

namespace Employee\Domain\Models\UpdateDetail\Values;

use Employee\Infrastructure\Bass\Model\BaseValue;

final class Birthplace extends BaseValue
{
    /** @var string カラム名 */
    protected $column = '出身都道府県';

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
     * null許可
     *
     * @return bool
     */
    protected function nullable(): bool
    {
        return true;
    }

    /**
     * 設定可能な値かチェック
     *
     * @param mixed $value
     * @return bool
     */
    protected function isValidValue($value): bool
    {
        return parent::isPrefectural($value);
    }
}
