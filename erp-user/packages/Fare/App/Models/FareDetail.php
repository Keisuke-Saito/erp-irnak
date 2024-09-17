<?php
declare(strict_types=1);

namespace Fare\App\Models;

use Fare\Infrastructure\Base\Model\BaseModel;

/**
 * 交通費と合計金額情報
 *
 * @property string $fareId
 * @property string $targetDate
 * @property string $destination
 * @property string $pointOfDeparture
 * @property string $arrival
 * @property int $routeDiv
 * @property int $transportation
 * @property int $amountOfMoney
 * @property string|null $remarks
 * @property string|null $adminRemarks
 * @property string|null $receipt
 * @method mixed|null get($name)
 * @method array toArray()
 * @method self fill(array $attributes)
 */
final class FareDetail extends BaseModel
{
    /** @var string 管理番号 */
    protected $fareId;
    /** @var string 対象年月日 */
    protected $targetDate;
    /** @var string 行き先 */
    protected $destination;
    /** @var string 出発 */
    protected $pointOfDeparture;
    /** @var string 到着 */
    protected $arrival;
    /** @var int 経路区分 */
    protected $routeDiv;
    /** @var int 交通手段 */
    protected $transportation;
    /** @var int 金額 */
    protected $amountOfMoney;
    /** @var string|null 備考 */
    protected $remarks;
    /** @var string|null 管理者備考 */
    protected $adminRemarks;
    /** @var string|null 領収書パス */
    protected $receipt;
}
