<?php
declare(strict_types=1);

namespace Employee\Domain\Models\Store\Values;

use Employee\Infrastructure\Bass\Model\BaseValue;

final class Spouse extends BaseValue
{
    /** @var string カラム名 */
    protected $column = '配偶者';

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
     * 論理値かチェック
     *
     * @param mixed $value
     * @return bool
     */
    protected function isValidValue($value): bool
    {
        return is_bool($value);
    }
}
