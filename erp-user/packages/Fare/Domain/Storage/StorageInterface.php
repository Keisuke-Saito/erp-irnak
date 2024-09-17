<?php
declare(strict_types=1);

namespace Fare\Domain\Storage;

use Fare\Infrastructure\Base\Model\BaseDomainModel;

/**
 * ストレージ
 */
interface StorageInterface
{
    /**
     * 登録
     *
     * @param BaseDomainModel $domainModel
     * @return BaseDomainModel
     */
    public function store(BaseDomainModel $domainModel): BaseDomainModel;
    /**
     * 更新
     *
     * @param BaseDomainModel $domainModel
     * @return BaseDomainModel
     */
    public function update(BaseDomainModel $domainModel): BaseDomainModel;
    /**
     * 削除
     *
     * @param BaseDomainModel $domainModel
     * @return void
     */
    public function delete(BaseDomainModel $domainModel): void;
}
