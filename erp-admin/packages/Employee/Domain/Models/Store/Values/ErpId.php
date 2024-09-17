<?php
declare(strict_types=1);

namespace Employee\Domain\Models\Store\Values;

use Employee\Infrastructure\Bass\Model\BaseValue;
use Employee\Domain\Models\Store\ErpIdGenerator;

final class ErpId extends BaseValue
{
    /** @var string カラム名 */
    protected $column = 'スタッフコード';

    /**
     * Store a new controller instance.
     *
     * @param mixed $value
     * @return void
     */
    public function __construct(?ErpIdGenerator $value)
    {
        $this->value = is_null($value) ? null : $value();
    }
}
