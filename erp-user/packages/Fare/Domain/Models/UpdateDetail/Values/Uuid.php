<?php
declare(strict_types=1);

namespace Fare\Domain\Models\UpdateDetail\Values;

use Fare\Infrastructure\Bass\Model\BaseValue;

final class Uuid extends BaseValue
{
    /** @var string カラム名 */
    protected $column = 'ID';

    /**
     * Store a new controller instance.
     *
     * @param $value
     * @return void
     */
    public function __construct($value)
    {
        parent::__construct($value);
    }

    /**
     * uuidとして正しいか
     * @param mixed $value
     * @return bool
     */
    protected function isValidValue($value): bool
    {
        return parent::isUuid($value);
    }
}
