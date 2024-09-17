<?php
declare(strict_types=1);

namespace App\Mail\Employee\Batch\Example;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * 従業員へのメッセージバッチメール
 *
 * @property Collection $target
 * @property string $messageText
 */
final class ExampleMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    /** @var Collection 従業員情報 */
    public $target;
    /** @var string メッセージ */
    public $messageText;

    /**
     * Create a new message instance.
     *
     * @param ExampleMessage $message
     * @return void
     */
    public function __construct(ExampleMessage $message)
    {
        $this->target = $message->getTarget();
        $this->messageText = $message->getMessage();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('ランダム配信です')
            ->view('mails.employee.batch.example.to_employee.example_message')
            ->text('mails.employee.batch.example.to_employee.example_message_text')
            ->with([
                'name' => $this->target->name,
                'messageText' => $this->messageText
            ]);
    }
}
