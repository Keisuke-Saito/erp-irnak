<?php

namespace App\Mail\Employee\App\Create;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * パスワード設定の通知メール
 *
 * @property string $erpId
 * @property string $token
 * @property const SUBJECT
 * @property const VIEW
 * @property const TEXT
 * @property const URL
 */
final class NotificationPasswordSettingMail extends Mailable
{
    use Queueable, SerializesModels;

    /** @var string $erpId 従業員管理番号 */
    private $erpId;
    /** @var string $token ワンタイムトークン */
    private $token;
    /** @var URL パスワード設定通知メールのタイトル */
    const SUBJECT = '【イルナック】パスワード設定のお願い';
    /** @var URL パスワード設定通知メールのビューテンプレートファイル */
    const VIEW = 'mails.employee.app.create.to_employee.notification_password_setting';
    /** @var URL パスワード設定通知メールのテキストファイル */
    const TEXT = 'mails.employee.app.create.to_employee.notification_password_setting_text';
    // /** @var URL パスワード設定画面のurl */
    // const URL = [
    //     'local' => 'http://staff.irnak.local/password/generate?token=',
    //     'stg' => 'http://user.webeerp.tech/password/generate?token=',
    //     'prod' => ''
    // ];
    /**
     * Create a new message instance.
     *
     * @param NotificationPasswordSetting $value
     * @return void
     */
    public function __construct(NotificationPasswordSetting $value)
    {
        $this->erpId = $value->getErpId();
        $this->token = $value->getToken();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $url = config('frontend.frontend_staff_domain') .
        config('frontend.staff_password_generate');
        return $this
            ->subject(self::SUBJECT)
            ->view(self::VIEW)
            ->text(self::TEXT)
            ->with([
                'erpId' => $this->erpId,
                'url' => $url . $this->token
            ]);
    }
}
