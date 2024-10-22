<?php
declare(strict_types=1);

namespace App\Mail\Employee\Batch\Fare;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

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
final class FareConfirmMail extends Mailable
{
    use Queueable, SerializesModels;

    /** @var string 対象月 */
    public $month;
    /** @var int 対象件数 */
    public $countAll;
    /** @var int 成功した件数 */
    public $successCount;
    /** @var Collection 成功した従業員情報 */
    public $successProfiles;
    /** @var int 失敗した件数 */
    public $failCount;
    /** @var Collection 失敗した交通費情報 */
    public $failFares;

    /**
     * Create a new message instance.
     *
     * @param FareConfirm $message
     * @return void
     */
    public function __construct(FareConfirm $message)
    {
        $this->month = $message->getMonth();
        $this->countAll = $message->getCountAll();
        $this->successCount = $message->getSuccessCount();
        $this->successProfiles = $message->getSuccessProfiles();
        $this->failCount = $message->getFailCount();
        $this->failFares = $message->getFailFares();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('交通費確定処理の結果です')
            ->view('mails.employee.batch.fare.fare_confirm')
            ->text('mails.employee.batch.fare.fare_confirm_text')
            ->with([
                'month' => $this->month,
                'countAll' => $this->countAll,
                'successCount' => $this->successCount,
                'successProfiles' => $this->successProfiles,
                'failCount' => $this->failCount,
                'failFares' => $this->failFares
            ]);
    }
}
