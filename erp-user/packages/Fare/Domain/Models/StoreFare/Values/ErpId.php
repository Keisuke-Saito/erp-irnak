<?php
declare(strict_types=1);

namespace Fare\Domain\Models\StoreFare\Values;

use Fare\Infrastructure\Bass\Model\BaseValue;

final class ErpId extends BaseValue
{
    /** @var string カラム名 */
    protected $column = '管理番号';

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
     * 管理番号として正しいか
     * @param mixed $value
     * @return bool
     */
    protected function isValidValue($value): bool
    {
        return parent::isStringId($value);
    }
}
