<?php
declare(strict_types=1);

namespace Employee\Domain\Models\Store;

use Employee\Domain\Models\Request\RequestAdapter;
use Carbon\Carbon;

/**
 * 社員管理番号生成
 * @property string $value
 * @property const ETO
 */
final class ErpIdGenerator
{
    /** @var string カラム名 */
    protected $value;
    /** @var string[] 記号 */
    private const ETO = [
        0 => 'NE',
        1 => 'SI',
        2 => 'RA',
        3 => 'UU',
        4 => 'TU',
        5 => 'MI',
        6 => 'MA',
        7 => 'JI',
        8 => 'RU',
        9 => 'RI',
        10 => 'NU',
        11 => 'II'
    ];

    /**
     * Store a new controller instance.
     *
     * @param Values\Birthday $birthday
     * @return void
     */
    public function __construct(Values\Birthday $birthday)
    {
        $this->value = $birthday;
    }

    /**
     * 社員管理番号生成
     *
     * @return string
     */
    public function __invoke(): string
    {
        $carbon = new Carbon();
        $pre = self::ETO[substr($this->value->getValue(), 0, 4) % 12];
        $end = self::ETO[$carbon->year % 12];
        $var = substr($carbon->copy()->toDateString(), 5);
        $mid = $carbon->minute;
        return $pre . $var . $mid . $end;
    }
}
