<?php
declare(strict_types=1);

namespace App\Mail\Employee\Batch\Fare;

use App\Mail\Base\Models\BaseMailModel;
use Illuminate\Support\Collection;

/**
 * 交通費確定処理の結果報告バッチ
 *
 * @property string $month
 * @property int $countAll
 * @property int $successCount
 * @property Collection $successProfiles
 * @property int $failCount
 * @property Collection $failFares
 */
final class FareConfirm extends BaseMailModel
{
    /** @var string 対象月 */
    protected $month;
    /** @var int 対象件数 */
    protected $countAll;
    /** @var int 成功した件数 */
    protected $successCount;
    /** @var Collection 成功した従業員情報 */
    protected $successProfiles;
    /** @var int 失敗した件数 */
    protected $failCount;
    /** @var Collection 失敗した交通費情報 */
    protected $failFares;
}
