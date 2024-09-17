<?php
declare(strict_types=1);

namespace Fare\Domain\Models\StoreFare;

use Fare\Infrastructure\Base\Model\BaseDomainModel;

/**
 * 交通費新規登録モデル
 */
final class StoreFareModel extends BaseDomainModel
{
    /** @var ErpId 管理番号 */
    protected $erpId;
    /** @var TargetMonth 対象月 */
    protected $targetMonth;
    /** @var Detail 交通費詳細 */
    protected $detail;

    /**
     * Store a new controller instance.
     *
     * @param ErpId $erpId
     * @param TargetMonth $targetMonth
     * @param Detail $detail
     * @return void
     */
    public function __construct(
        Values\ErpId $erpId,
        Values\TargetMonth $targetMonth,
        Values\Detail $detail
    ){
        $this->erpId = $erpId;
        $this->targetMonth = $targetMonth;
        $this->detail = $detail;
    }

    /**
     * 交通費情報用
     *
     * @return array
     */
    public function toFare(): array
    {
        return [
            'erp_id' => $this->erpId->getValue(),
            'target_month' => $this->targetMonth->getValue()
        ];
    }
}
