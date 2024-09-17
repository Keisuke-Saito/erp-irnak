<?php
declare(strict_types=1);

namespace Employee\Domain\Models\Store\Values;

use Employee\Infrastructure\Bass\Model\BaseValue;

final class Name extends BaseValue
{
    /** @var string カラム名 */
    protected $column = '氏名(漢字)';

    /**
     * Store a new controller instance.
     *
     * @param mixed $lastname
     * @param mixed $firstname
     * @return void
     */
    public function __construct($lastname, $firstname)
    {
        $name = $lastname . ' ' . $firstname;
        parent::__construct($name);
    }

    /**
     * 漢字もしくは平仮名＋半角スペース＋漢字もしくは平仮名のフォーマット
     *
     * @param mixed $value
     * @return bool
     */
    protected function isValidValue($value): bool
    {
        return (bool)preg_match("/^[a-zA-Zあ-ん-々一ア-ヶー-龠々]+ [a-zA-Zあ-ん-々一ア-ヶー-龠々]+$/u", $value);
    }
}
