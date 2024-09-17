<?php
declare(strict_types=1);

namespace Fare\Domain\Models\StoreDetail\Values;

use Fare\Infrastructure\Bass\Model\BaseValue;
use Carbon\Carbon;

final class TargetDate extends BaseValue
{
    /** @var string カラム名 */
    protected $column = '対象日';

    /**
     * Store a new controller instance.
     *
     * @param Carbon $value
     * @return void
     */
    public function __construct(Carbon $value)
    {
        parent::__construct($value);
    }

    /**
     * 交通費申請可能日付チェック
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
     * @return string
     */
    public function getValue(): string
    {
        return $this->value->toDateString();
    }

    /**
     * Carbonで取得
     *
     * @return Carbon
     */
    public function carbon(): Carbon
    {
        return $this->value;
    }
}
