<?php
declare(strict_types=1);

namespace Employee\Domain\Models\Store\Values;

use Employee\Infrastructure\Bass\Model\BaseValue;
use Carbon\Carbon;

/**
 * @property Carbon $value
 */
final class Birthday extends BaseValue
{
    /** @var string カラム名 */
    protected $column = '誕生日';

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
     * 過去日付かチェック
     *
     * @param mixed $value
     * @return bool
     */
    protected function isValidValue($value): bool
    {
        return $value->isPast();
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
