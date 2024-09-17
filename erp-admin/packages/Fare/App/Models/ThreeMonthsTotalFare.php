<?php
declare(strict_types=1);

namespace Fare\App\Models;

use Fare\Infrastructure\Base\Model\BaseModel;

/**
 * ３ヶ月分の交通費合計金額情報
 *
 * @property string $erpId
 * @property string $name
 * @property int $belongId
 * @property string $targetMonth
 * @property int $confirmStatus
 * @property int $thisMonthCount
 * @property int $lastMonthCount
 * @property int $twoMonthsAgoCount
 * @method mixed|null get($name)
 * @method array toArray()
 * @method self fill(array $attributes)
 */
final class ThreeMonthsTotalFare extends BaseModel
{
    /** @var string 管理番号 */
    protected $erpId;
    /** @var string 従業員名 */
    protected $name;
    /** @var int 所属 */
    protected $belongId;
    /** @var string 対象月 */
    protected $targetMonth;
    /** @var int 確定ステータス */
    protected $confirmStatus;
    /** @var int 対象月の交通費合計 */
    protected $thisMonthCount;
    /** @var int 対象月の前月の交通費合計 */
    protected $lastMonthCount;
    /** @var int 対象月の前々月の交通費合計 */
    protected $twoMonthsAgoCount;
}
