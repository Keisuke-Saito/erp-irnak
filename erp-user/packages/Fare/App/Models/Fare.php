<?php
declare(strict_types=1);

namespace Fare\App\Models;

use Fare\Infrastructure\Base\Model\BaseModel;

/**
 * 交通費と合計金額情報
 *
 * @property string $erpId
 * @property string $targetMonth
 * @property int $confirmStatus
 * @method mixed|null get($name)
 * @method array toArray()
 * @method self fill(array $attributes)
 */
final class Fare extends BaseModel
{
    /** @var string 管理番号 */
    protected $erpId;
    /** @var string 対象月 */
    protected $targetMonth;
    /** @var int ステータス */
    protected $confirmStatus;
}
