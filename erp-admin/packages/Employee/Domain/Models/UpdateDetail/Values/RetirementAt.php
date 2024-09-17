<?php
declare(strict_types=1);

namespace Employee\Domain\Models\UpdateDetail\Values;

use Employee\Infrastructure\Bass\Model\BaseValue;
use Carbon\Carbon;

/**
 * @property Carbon $value
 */
final class RetirementAt extends BaseValue
{
    /** @var string カラム名 */
    protected $column = '退社年月日';

    /**
     * Store a new controller instance.
     *
     * @param Carbon|null $value
     * @return void
     */
    public function __construct(?Carbon $value)
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
     * 日付が正しいかチェック
     *
     * @param mixed $value
     * @return bool
     */
    protected function isValidValue($value): bool
    {
        return true;
    }

    /**
     * 文字列で取得
     *
     * @return string|null
     */
    public function getValue(): ?string
    {
        return $this->value ? $this->value->toDateString() : null;
    }

    /**
     * Carbonで取得
     *
     * @return Carbon|null
     */
    public function carbon(): ?Carbon
    {
        return $this->value;
    }
}
