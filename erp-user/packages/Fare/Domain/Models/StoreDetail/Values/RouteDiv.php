<?php
declare(strict_types=1);

namespace Fare\Domain\Models\StoreDetail\Values;

use Fare\Infrastructure\Bass\Model\BaseValue;

final class RouteDiv extends BaseValue
{
    /** @var string カラム名 */
    protected $column = '片道・往復・定期';
    /** @var string 設定可能な値 */
    protected $configurableValue = ['1','2','3'];

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
