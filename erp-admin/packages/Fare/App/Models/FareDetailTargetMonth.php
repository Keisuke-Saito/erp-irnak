<?php
declare(strict_types=1);

namespace Fare\App\Models;

use Fare\Infrastructure\Base\Model\BaseModel;

/**
 * 交通費と合計金額情報
 *
 * @property string $erpId
 * @property string $name
 * @property string $kana
 * @property string $nearestStation
 * @property int $belongId
 * @property string|null $retirementAt
 * @property string $targetMonth
 * @property int $confirmStatus
 * @property FareDetailCollection $details
 * @method mixed|null get($name)
 * @method array toArray()
 * @method self fill(array $attributes)
 */
final class FareDetailTargetMonth extends BaseModel
{
    /** @var string 管理番号 */
    protected $erpId;
    /** @var string 従業員名 */
    protected $name;
    /** @var string 従業員名（カナ） */
    protected $kana;
    /** @var string 最寄駅 */
    protected $nearestStation;
    /** @var int 所属 */
    protected $belongId;
    /** @var int 退職日 */
    protected $retirementAt;
    /** @var string 対象月 */
    protected $targetMonth;
    /** @var int 確定ステータス */
    protected $confirmStatus;
    /** @var FareDetailCollection 交通費詳細 */
    protected $details;

    /**
     * 完全配列で返却
     *
     * @return array
     */
    public function toResponse(): array
    {
        $all = $this->toArray();
        $all['details'] = $this->details->toArray();
        return $all;
    }
}
