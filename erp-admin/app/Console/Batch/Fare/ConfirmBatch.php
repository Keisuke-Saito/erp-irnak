<?php
declare(strict_types=1);

namespace App\Console\Batch\Fare;

use App\Console\Base\BaseBatch;
use App\Console\Base\Exceptions\BatchEndException;
use App\Mail\Employee\Batch\Fare\FareConfirm;
use App\Mail\Employee\Batch\Fare\FareConfirmMail;
use App\Models\Profile;
use App\Models\Fare;
use Illuminate\Support\Collection;
use Carbon\Carbon;

/**
 * 交通費確定バッチ
 *
 * @property string $signature
 * @property string $description
 * @property string $targetMonth
 * @property Collection $profiles
 * @property int $countAll
 * @property int $successCount
 * @property Collection $successProfiles
 * @property int $failCount
 * @property Collection $targetMonthFailFares
 */
final class ConfirmBatch extends BaseBatch
{
    /** @var string コマンド */
    protected $signature = 'batch:confirm { targetMonth? : 対象月}';
    /** @var string コマンド詳細 */
    protected $description = '毎月1日13時に交通費を確定させます';
    /** @var string|null 対象月 */
    private $targetMonth = null;
    /** @var Collection 従業員情報 */
    private $profiles;
    /** @var int 対象件数 */
    private $countAll = 0;
    /** @var int 成功件数 */
    private $successCount = 0;
    /** @var Collection 成功した従業員情報 */
    private $successProfiles;
    /** @var int 失敗件数 */
    private $failCount = 0;
    /** @var Collection 失敗した交通費情報 */
    private $targetMonthFailFares;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->profiles = collect();
        $this->successProfiles = collect();
        $this->targetMonthFailFares = collect();
        parent::__construct();
    }

    /**
     * バッチメイン処理
     *
     * @return mixed
     */
    protected function main()
    {
        $this->init();
        $this->log('debug', '対象月は' . $this->targetMonth);

        $this->log('info', '従業員情報取得処理');
        $this->fetch();

        $this->log('info', '交通費情報取得・確定処理');
        $this->updateFares();

        $this->log('info', 'メール送信処理');
        $resultModel = new FareConfirm();
        $resultModel
            ->setMonth($this->targetMonth)
            ->setCountAll($this->countAll)
            ->setSuccessCount($this->successCount)
            ->setSuccessProfiles($this->successProfiles)
            ->setFailCount($this->failCount)
            ->setFailFares($this->targetMonthFailFares);
        $this->send(
            new FareConfirmMail($resultModel)
        );
    }

    /**
     * 対象月取得処理
     *
     * @return void
     */
    private function init(): void
    {
        if (is_null($this->argument('targetMonth'))) {
            $thisMonth = $this->batchStartTime;
            $this->targetMonth = $thisMonth->copy()->subMonthNoOverflow(1)->format('Y-m');
        } else {
            $target = $this->argument('targetMonth');
            if (!preg_match('/^(19|20)[0-9]{2}\-(0[1-9]|1[0-2])$/', $target) || empty($target)) throw new BatchEndException('有効な年月をYYYY-mmで指定してください。');
            $targetMonth = new Carbon($target);
            $this->targetMonth = $targetMonth->copy()->format('Y-m');
        }
    }

    /**
     * 従業員情報取得処理
     *
     * @return void
     */
    private function fetch(): void
    {
        $targetDateTime = $this->batchStartTime;
        $profiles = Profile::whereNotNull('joined_at')
            ->where(function ($query) use ($targetDateTime) {
                $target = $targetDateTime->copy()->endOfMonth()->toDateString();
                $query->whereDate('joined_at', '<=', $target);
            })
            ->where(function ($query) use ($targetDateTime) {
                $target = $targetDateTime->copy()->startOfMonth()->toDateString();
                $query->whereDate('retirement_at', '>=', $target)
                        ->orWhereNull('retirement_at');
            })
            ->get();
        if ($profiles->count() === 0) throw new BatchEndException('従業員がいませんでした。');
        $this->profiles = $profiles;
    }

    /**
     * 交通費情報取得・確定処理
     *
     * @return void
     */
    private function updateFares(): void
    {
        $targetMonth = $this->targetMonth;
        $idList = $this->profiles->pluck('erp_id');

        $targetMonthFaresAll = Fare::whereIn('erp_id', $idList)
            ->where('target_month', $targetMonth)
            ->get();
        if ($targetMonthFaresAll->count() === 0) throw new BatchEndException('対象月の交通費情報がありませんでした');
        $targetMonthSuccessFares = Fare::whereIn('erp_id', $idList)
            ->where([
                ['target_month', $targetMonth],
                ['confirm_status', 0],
            ])->get();
        $targetMonthFailFares = Fare::whereIn('erp_id', $idList)
            ->where([
                ['target_month', $targetMonth],
                ['confirm_status', '>=', 1],
                ['confirm_status', '<=', 4],
            ])->get();

        foreach ($targetMonthSuccessFares as $fare) {
            $fare->confirm_status = Fare::CONFIRM_STATUS_AUTO_FIXED;
            $fare->save();
        }

        $successIdList = $targetMonthSuccessFares->pluck('erp_id');
        $successProfiles = $this->profiles->whereIn('erp_id', $successIdList);

        $this->countAll = $targetMonthFaresAll->count();
        $this->successCount = $targetMonthSuccessFares->count();
        $this->successProfiles = $successProfiles;
        $this->failCount = $targetMonthFailFares->count();
        $this->targetMonthFailFares = $targetMonthFailFares;
    }
}
