<?php
declare(strict_types=1);

namespace Fare\Domain\Models\StoreDetail;

use Fare\Infrastructure\Base\Model\BaseDomainModel;

/**
 * 交通費新規登録詳細モデル
 */
final class StoreDetailModel extends BaseDomainModel
{
    /** @var TargetDate 対象日 */
    protected $targetDate;
    /** @var Destination 目的地 */
    protected $destination;
    /** @var PointOfDeparture 出発 */
    protected $pointOfDeparture;
    /** @var Arrival 到着 */
    protected $arrival;
    /** @var RouteDiv 片道・往復・定期 */
    protected $routeDiv;
    /** @var Transportation 交通手段 */
    protected $transportation;
    /** @var AmountOfMoney 金額 */
    protected $amountOfMoney;
    /** @var Remarks 備考 */
    protected $remarks;
    /** @var AdminRemarks 管理者備考 */
    protected $adminRemarks;
    /** @var Receipt 領収書画像パス */
    protected $receipt;
    /** @var ImgObj 領収書画像情報 */
    protected $imgObj;
    /** @var Disk ストレージディスク */
    protected $disk;

    /**
     * Store a new controller instance.
     *
     * @param TargetDate $targetDate
     * @param Destination $destination
     * @param PointOfDeparture $pointOfDeparture
     * @param Arrival $arrival
     * @param RouteDiv $routeDiv
     * @param Transportation $transportation
     * @param AmountOfMoney $amountOfMoney
     * @param Remarks $remarks
     * @param AdminRemarks $AdminRemarks
     * @param ImgObj $imgOb
     * @return Disk $disk
     */
    public function __construct(
        Values\TargetDate $targetDate,
        Values\Destination $destination,
        Values\PointOfDeparture $pointOfDeparture,
        Values\Arrival $arrival,
        Values\RouteDiv $routeDiv,
        Values\Transportation $transportation,
        Values\AmountOfMoney $amountOfMoney,
        Values\Remarks $remarks,
        Values\AdminRemarks $adminRemarks,
        Values\ImgObj $imgObj,
        Values\Disk $disk
    ){
        $this->targetDate = $targetDate;
        $this->destination = $destination;
        $this->pointOfDeparture = $pointOfDeparture;
        $this->arrival = $arrival;
        $this->routeDiv = $routeDiv;
        $this->transportation = $transportation;
        $this->amountOfMoney = $amountOfMoney;
        $this->remarks = $remarks;
        $this->AdminRemarks = $adminRemarks;
        $this->imgObj = $imgObj;
        $this->disk = $disk;
    }

    /**
     * ファイルパスセット
     *
     * @param string|null $path
     * @return void
     */
    public function setReceipt(?string $path): void
    {
        $this->receipt = new Values\Receipt($path);
    }

    /**
     * ストレージ用
     *
     * @return array
     */
    public function toStorage(): array
    {
        return [
            'imgObj' => $this->imgObj->getValue(),
            'disk' => $this->disk->getValue()
        ];
    }

    /**
     * 交通費詳細用
     *
     * @return array
     */
    public function toFareDetail(): array
    {
        return [
            'target_date' => $this->targetDate->getValue(),
            'destination' => $this->destination->getValue(),
            'point_of_departure' => $this->pointOfDeparture->getValue(),
            'arrival' => $this->arrival->getValue(),
            'route_div' => $this->routeDiv->getValue(),
            'transportation' => $this->transportation->getValue(),
            'amount_of_money' => $this->amountOfMoney->getValue(),
            'remarks' => $this->remarks->getValue(),
            'admin_remarks' => null,
            // 'admin_remarks' => $this->adminRemarks->getValue(),
            'receipt' => $this->receipt->getValue(),
        ];
    }
}
