<?php
declare(strict_types=1);

namespace App\Console\Batch\Example;

use App\Console\Base\BaseBatch;
use App\Console\Base\Exceptions\BatchEndException;
use App\Mail\Employee\Batch\Example\ExampleMessage;
use App\Mail\Employee\Batch\Example\ExampleMessageMail;
use App\Models\Profile;
use Illuminate\Support\Collection;

/**
 * 従業員へのメッセージバッチ
 *
 * @property string $signature
 * @property string $description
 * @property string $message
 * @property Collection $profile
 */
final class MessageBatch extends BaseBatch
{
    /** @var string コマンド */
    protected $signature = 'batch:message { message? : 表示文言}';
    /** @var string コマンド詳細 */
    protected $description = '毎日ランダムに選んだ従業員にメッセージを送ります';
    /** @var string|null メッセージ */
    private $message = null;
    /** @var Collection 従業員情報 */
    private $profile;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->profile = collect();
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
        $this->log('debug', 'メッセージは' . $this->message);

        $this->log('info', '従業員情報全件取得処理');
        $this->fetch();

        $this->log('info', 'メール送信処理');
        $resultModel = new ExampleMessage();
        $resultModel
            ->setTarget($this->profile)
            ->setMessage($this->message);
        $this->send(
            new ExampleMessageMail($resultModel),
            $this->profile->email
        );
    }

    /**
     * メッセージ取得処理
     *
     * @return void
     */
    private function init(): void
    {
        if (is_null($this->argument('message'))) {
            $this->message = 'お疲れ様です！';
        } else {
            $message = $this->argument('message');
            if (!is_string($message) || empty($message)) throw new BatchEndException('メッセージを指定してください。');
            $this->message = $message;
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
        if ($profiles->count() === 0) throw new BatchEndException('従業員がいませんでした');
        $this->profile = $profiles->random();
    }
}
