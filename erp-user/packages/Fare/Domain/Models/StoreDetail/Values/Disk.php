<?php
declare(strict_types=1);

namespace Fare\Domain\Models\StoreDetail\Values;

use Fare\Infrastructure\Bass\Model\BaseValue;

final class Disk extends BaseValue
{
    /** @var string カラム名 */
    protected $column = 'ストレージディスク';
    /** @var string 設定可能な値 */
    protected $configurableValue = ['receipt'];

    /**
     * Store a new controller instance.
     *
     * @param $value
     * @return void
     */
    public function __construct($value = 'receipt')
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
