<?php
declare(strict_types=1);

namespace App\Mail\Employee\App\Create;

use App\Mail\Base\Models\BaseMailModel;

/**
 * パスワード設定の通知メール用
 *
 * @property string $erpId
 * @property string $token
 */
final class NotificationPasswordSetting extends BaseMailModel
{
    /** @var string スタッフコード */
    protected $erpId;
    /** @var string トークン */
    protected $token;
}
