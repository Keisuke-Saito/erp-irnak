<?php
declare(strict_types=1);

namespace Employee\Domain\Models\UpdateDetail\Values;

use Employee\Infrastructure\Bass\Model\BaseValue;

final class PositionId extends BaseValue
{
    /** @var string カラム名 */
    protected $column = '役職ID';

    /**
     * Store a new controller instance.
     *
     * @param mixed $value
     * @return void
     */
    public function __construct($value)
    {
        parent::__construct($value ?? 99);
    }

    /**
     * 正の整数かチェック
     *
     * @param mixed $value
     * @return bool
     */
    protected function isValidValue($value): bool
    {
        return parent::isId($value);
    }
}
