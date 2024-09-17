<?php
declare(strict_types=1);

namespace Fare\Domain\Models\StoreFare\Values;

use Fare\Infrastructure\Bass\Model\BaseValue;

use Carbon\Carbon;

final class TargetMonth extends BaseValue
{
    /** @var string カラム名 */
    protected $column = '対象月';

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
     * @param $value
     * @return bool
     */
    protected function isValidValue($value): bool
    {
        // 比較用日付用意
        $now = new Carbon();
        $year = $now->copy()->year;
        $month = $now->copy()->month;
        $targetMonth = $value;

        // 入力対象日が今月
        if ($targetMonth->isCurrentMonth()) return true;

        // 来月以降分は入力できない
        if ($now->copy()->endOfMonth() < $targetMonth) return false;

        // 入力対象日が先月
        if ($targetMonth->isLastMonth()) return true;

        return false;
    }

    /**
     * 文字列で取得
     *
     * @return string
     */
    public function getValue(): string
    {
        return $this->value->format('Y-m');
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
