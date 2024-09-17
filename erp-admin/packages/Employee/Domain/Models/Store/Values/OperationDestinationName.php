<?php
declare(strict_types=1);

namespace Employee\Domain\Models\Store\Values;

use Employee\Infrastructure\Bass\Model\BaseValue;

final class OperationDestinationName extends BaseValue
{
    /** @var string カラム名 */
    protected $column = '稼働先名称';

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
     * 文字列
     *
     * @param mixed $value
     * @return bool
     */
    protected function isValidValue($value): bool
    {
        return is_string($value);
    }
}
