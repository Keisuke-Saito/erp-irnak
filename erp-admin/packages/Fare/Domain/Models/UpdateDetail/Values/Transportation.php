<?php
declare(strict_types=1);

namespace Fare\Domain\Models\UpdateDetail\Values;

use Fare\Infrastructure\Bass\Model\BaseValue;

final class Transportation extends BaseValue
{
    /** @var string カラム名 */
    protected $column = '交通手段';
    /** @var string 設定可能な値 */
    protected $configurableValue = ['0','1','2','3','4','5','6'];

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
     * 設定可能な値かチェック
     *
     * @param mixed $value
     * @return bool
     */
    protected function isValidValue($value): bool
    {
        return in_array((string)$value, $this->configurableValue, true);
    }
}
