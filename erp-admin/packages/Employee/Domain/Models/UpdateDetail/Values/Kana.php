<?php
declare(strict_types=1);

namespace Employee\Domain\Models\UpdateDetail\Values;

use Employee\Infrastructure\Bass\Model\BaseValue;

final class Kana extends BaseValue
{
    /** @var string カラム名 */
    protected $column = '氏名(カナ)';

    /**
     * Store a new controller instance.
     *
     * @param mixed $lastnameKana
     * @param mixed $firstnameKana
     * @return void
     */
    public function __construct($lastnameKana, $firstnameKana)
    {
        $kana = $lastnameKana . ' ' . $firstnameKana;
        parent::__construct($kana);
    }

    /**
     * 全角カタカナ＋半角スペース＋全角カタカナのフォーマット
     *
     * @param mixed $value
     * @return bool
     */
    protected function isValidValue($value): bool
    {
        return (bool)preg_match("/^[ア-ヶー]+ [ア-ヶー]+$/u", $value);
    }
}
