<?php
declare(strict_types=1);

namespace Employee\Domain\Models\UpdateDetail\Values;

use Employee\Infrastructure\Bass\Model\BaseValue;

final class EnducationalBackground extends BaseValue
{
    /** @var string カラム名 */
    protected $column = '最終学歴';
    /** @param string 設定可能な値 */
    private const CONFIGURABLE_VALUE = ['1','2','3','4','5','6'];

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
        return in_array((string)$value, self::CONFIGURABLE_VALUE, true);
    }
}
