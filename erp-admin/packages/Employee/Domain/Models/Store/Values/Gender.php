<?php
declare(strict_types=1);

namespace Employee\Domain\Models\Store\Values;

use Employee\Infrastructure\Bass\Model\BaseValue;

final class Gender extends BaseValue
{
    /** @var string カラム名 */
    protected $column = '性別';
    /** @var array<string> 設定可能な値 */
    protected $configurableValue = ['1','2','3','99'];

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
