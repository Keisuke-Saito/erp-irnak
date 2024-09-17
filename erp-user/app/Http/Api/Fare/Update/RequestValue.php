<?php
declare(strict_types=1);

namespace App\Http\Api\Fare\Update;

use App\Http\Api\Base\Connector\BaseRequestValue;

use Carbon\Carbon;

/**
 * 交通費更新リクエスト
 * @property string $uuid
 * @property string $fareId
 * @property Carbon $targetDate
 * @property string $destination
 * @property string $pointOfDeparture
 * @property string $arrival
 * @property int $routeDiv
 * @property int $transportation
 * @property int $amountOfMoney
 * @property string|null $remarks
 * @property string|null $receipt
 * @property object|null $imgObj
 * @method array toArray()
 */
final class RequestValue extends BaseRequestValue
{
    /** @var string 交通費詳細ID */
    protected $uuid;
    /** @var string 交通費ID */
    protected $fareId;
    /** @var Carbon 日付 */
    protected $targetDate;
    /** @var string 行先 */
    protected $destination;
    /** @var string 出発地 */
    protected $pointOfDeparture;
    /** @var string 到着地 */
    protected $arrival;
    /** @var int 片道・往復・定期 */
    protected $routeDiv;
    /** @var int 交通手段 */
    protected $transportation;
    /** @var int 金額 */
    protected $amountOfMoney;
    /** @var string|null 備考欄 */
    protected $remarks;
    /** @var string|null 領収書パス */
    protected $receipt;
    /** @var object|null 領収書画像 */
    protected $imgObj;
    /**
     * Store a new controller instance.
     *
     * @param App\Http\Api\Fare\Update\RequestValidation $request
     * @return void
     */
    public function __construct(
        RequestValidation $request
    ){
        $this->uuid = $request->uuid;
        $this->fareId = $request->fareId;
        $this->targetDate = new Carbon($request->targetDate);
        $this->destination = $request->destination;
        $this->pointOfDeparture = $request->pointOfDeparture;
        $this->arrival = $request->arrival;
        $this->routeDiv = intval($request->routeDiv);
        $this->transportation = intval($request->transportation);
        $this->amountOfMoney = intval($request->amountOfMoney);
        $this->remarks = $request->remarks;
        $this->receipt = $request->receipt;
        $this->imgObj = $request->imgObj;
    }
}
