<?php
declare(strict_types=1);

namespace Employee\Infrastructure\Notification;

use App\Mail\Employee\App\Create\NotificationPasswordSetting;
use App\Mail\Employee\App\Create\NotificationPasswordSettingMail;

use Mail;

use Employee\Infrastructure\Base\Model\BaseDomainModel;
use Employee\Domain\Notification\EmployeeNotificationInterface;

/**
 * 従業員宛メール
 */
final class MailEmployeeNotification implements EmployeeNotificationInterface
{
    /**
     * パスワード設定の通知メール
     *
     * @param BaseDomainModel $domainModel
     * @return void
     */
    public function passwordSetting(BaseDomainModel $domainModel)
    {
        $email = $domainModel->getEmail()->getValue();
        $value = new NotificationPasswordSetting();
        $value
            ->setErpId($domainModel->getErpId()->getValue())
            ->setToken($domainModel->getToken()->getValue());
        Mail::to($email)->send(new NotificationPasswordSettingMail($value));
    }
}
