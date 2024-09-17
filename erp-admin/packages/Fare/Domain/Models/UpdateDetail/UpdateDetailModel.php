<?php
declare(strict_types=1);

namespace Fare\Domain\Models\UpdateDetail;

use Fare\Infrastructure\Base\Model\BaseDomainModel;

/**
 * 交通費詳細更新モデル
 */
final class UpdateDetailModel extends BaseDomainModel
{
    /** @var Uuid ID */
    protected $uuid;
    /** @var FareId 交通費ID */
    protected $fareId;
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
    /** @var AdminRemarks 管理者備考 */
    protected $adminRemarks;
    /** @var Receipt 領収書パス */
    protected $receipt;
    /** @var ImgObj 領収書画像情報 */
    protected $imgObj;
    /** @var Disk ストレージディスク */
    protected $disk;
    /** @var FilePath ファイルパス */
    protected $filePath;

    /**
     * Store a new controller instance.
     *
     * @param Uuid $uuid
     * @param FareId $fareId
     * @param TargetDate $targetDate
     * @param Destination $destination
     * @param PointOfDeparture $pointOfDeparture
     * @param Arrival $arrival
     * @param RouteDiv $routeDiv
     * @param Transportation $transportation
     * @param AmountOfMoney $amountOfMoney
     * @param AdminRemarks $adminRemarks
     * @param Receipt $receipt
     * @param ImgObj $imgObj
     * @return Disk $disk
     */
    public function __construct(
        Values\Uuid $uuid,
        Values\FareId $fareId,
        Values\TargetDate $targetDate,
        Values\Destination $destination,
        Values\PointOfDeparture $pointOfDeparture,
        Values\Arrival $arrival,
        Values\RouteDiv $routeDiv,
        Values\Transportation $transportation,
        Values\AmountOfMoney $amountOfMoney,
        Values\AdminRemarks $adminRemarks,
        Values\Receipt $receipt,
        Values\ImgObj $imgObj,
        Values\Disk $disk
    ){
        $this->uuid = $uuid;
        $this->fareId = $fareId;
        $this->targetDate = $targetDate;
        $this->destination = $destination;
        $this->pointOfDeparture = $pointOfDeparture;
        $this->arrival = $arrival;
        $this->routeDiv = $routeDiv;
        $this->transportation = $transportation;
        $this->amountOfMoney = $amountOfMoney;
        $this->adminRemarks = $adminRemarks;
        $this->receipt = $receipt;
        $this->imgObj = $imgObj;
        $this->disk = $disk;
    }

    /**
     * ファイルパスセット
     *
     * @param string|null $path
     * @return void
     */
    public function setFilePath(?string $path): void
    {
        $this->filePath = new Values\FilePath($path);
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
            'filePath' => $this->receipt->getValue(),
            'oldFilePath' => $this->filePath->getValue(),
            'basename' => $this->filePath->getBasename(),
            'disk' => $this->disk->getValue()
        ];
    }
}
