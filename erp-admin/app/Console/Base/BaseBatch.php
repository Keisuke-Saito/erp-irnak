<?php
declare(strict_types=1);

namespace App\Console\Base;

use App\Console\Base\Exceptions\BatchEndException;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Exception;
use Illuminate\Mail\Mailable;
use Illuminate\Database\QueryException;

/**
 * バッチの基底クラス
 *
 * @property integer $count
 * @property integer $repeatCount
 * @property bool $repeatSetting
 * @property Carbon $batchStartTime
 * @method void handle() このクラスの基底メソッド繰り返し処理等を制御
 * @method void main() 継承先でバッチのメイン処理を記述する。handle()から呼ばれる。
 * @method void send(array $params, string $class, string $to = 'batch@test.com') メール送信処理
 */
abstract class BaseBatch extends Command
{
    /** @var integer 現在の繰り返し回数 */
    protected $count = 0;
    /** @var integer 繰り返し回数 */
    protected $repeatCount = 3;
    /** @var bool 繰り返し設定 */
    protected $repeatSetting = true;
    /** @var Carbon バッチ実行時間 */
    protected $batchStartTime;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
    ) {
        parent::__construct();
    }

    /**
     * もし、実行中にエラーがあった場合、設定された回数リトライ実行する
     * BatchEndExceptionの場合は、リトライをおこなわずに終了する
     *
     * @uses main()
     * @return void
     */
    public function handle()
    {
        Log::setDefaultDriver('batch');
        $this->log('info', "$this->name 処理開始");
        $this->batchStartTime = new Carbon();

        do {
            try {
                DB::beginTransaction();
                $this->log('info', ($this->count + 1) . '回目の実行');
                $this->main();
                DB::commit();
                break;
            } catch (BatchEndException $e) {
                DB::rollBack();
                $this->log('warning', 'バッチは停止されました。' . $e->getMessage());
                break;
            } catch (QueryException $e) {
                DB::rollBack();
                $this->log('error', $e);

                if (!$this->repeatSetting) break;
                sleep(30);
                $this->count++;
            } catch (Exception $e) {
                DB::rollBack();
                $this->log('error', $e);
                break;
            }
        } while ($this->count < $this->repeatCount);

        $this->log('info', "$this->name 処理終了");
    }

    /**
     * 継承先でバッチのメイン処理を記述する。handle()から呼ばれる。
     *
     * @used-by handle()
     * @return void
     */
    abstract protected function main();

    /**
     * ログ処理
     *
     * @param string $level
     * @param $message
     * @return void
     */
    protected function log(string $level, $message): void
    {
        switch ($level) {
            case 'error' :
                $this->error('errorが発生しました。'.$message->getMessage());
                Log::channel('batch_error')->error($message);
                Log::channel('batch')->error($message);
                break;
            case 'warning' :
                $this->warn($message);
                Log::warning($message);
                break;
            default :
                $this->info($message);
                Log::info($message);
        }
    }

    /**
     * メール送信処理
     *
     * @param Mailable $mail
     * @param string $to
     * @return void
     */
    protected function send(Mailable $mail, string $to = 'erp-batch@test.com')
    {
        Mail::to($to)->send($mail);
    }
}