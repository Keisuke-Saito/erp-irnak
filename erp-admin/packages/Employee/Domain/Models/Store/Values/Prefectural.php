<?php
declare(strict_types=1);

namespace Employee\Domain\Models\Store\Values;

use Employee\Infrastructure\Bass\Model\BaseValue;

final class Prefectural extends BaseValue
{
    /** @var string カラム名 */
    protected $column = '都道府県';

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
    public function isValidValue($value): bool
    {
        return array_key_exists($value, config('const.COMMON.PREFECTURAL'));
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string)config('const.COMMON.PREFECTURAL')[$this->value];
    }
}
