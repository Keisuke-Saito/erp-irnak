<?php
declare(strict_types=1);

namespace Employee\Domain\Models\UpdateDetail\Values;

use Employee\Infrastructure\Bass\Model\BaseValue;
// use Employee\Domain\Models\UpdateDetail\ErpIdGenerator;

final class ErpId extends BaseValue
{
    /** @var string カラム名 */
    protected $column = 'スタッフコード';

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
