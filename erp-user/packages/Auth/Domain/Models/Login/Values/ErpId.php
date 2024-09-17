<?php
declare(strict_types=1);

namespace Auth\Domain\Models\Login\Values;

use Auth\App\Models\Login;
use Auth\Infrastructure\Bass\Model\BaseValue;

final class ErpId extends BaseValue
{
    /** @var string カラム名 */
    protected $column = '従業員管理番号';

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
     * 文字列
     *
     * @param $value
     * @return bool
     */
    protected function isValidValue($value): bool
    {
        return is_string($value);
    }
}
