<?php
declare(strict_types=1);

namespace Fare\Domain\Models\UpdateDetail\Values;

use Fare\Infrastructure\Bass\Model\BaseValue;

final class Remarks extends BaseValue
{
    /** @var string カラム名 */
    protected $column = '備考';

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
     * @param mixed $value
     * @return bool
     */
    protected function isValidValue($value): bool
    {
        return is_string($value);
    }
}
