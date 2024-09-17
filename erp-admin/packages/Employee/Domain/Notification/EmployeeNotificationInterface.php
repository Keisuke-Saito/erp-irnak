<?php
declare(strict_types=1);

namespace Employee\Domain\Notification;

use Employee\Infrastructure\Base\Model\BaseDomainModel;

/**
 * mail
 */
interface EmployeeNotificationInterface
{
    /**
     * パスワード設定の通知メール
     *
     * @param BaseDomainModel $domainModel
     * @return void
     */
    public function passwordSetting(BaseDomainModel $domainModel);
}
