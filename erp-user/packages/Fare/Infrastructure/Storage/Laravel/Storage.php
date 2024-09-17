<?php
declare(strict_types=1);

namespace Fare\Infrastructure\Storage\Laravel;

use Fare\Infrastructure\Base\Model\BaseDomainModel;
use Fare\Domain\Storage\StorageInterface;

/**
 * Laravel ストレージ
 */
final class Storage implements StorageInterface
{
    /**
     * 登録
     *
     * @param BaseDomainModel $domainModel
     * @return BaseDomainModel
     */
    public function store(BaseDomainModel $domainModel): BaseDomainModel
    {
        $values = $domainModel->toStorage();
        $fileObject = $values['imgObj'];
        $path = null;
        if (!is_null($fileObject)) {
            $path = \Storage::disk($values['disk'])->putFile('/', $fileObject);
        }
        $domainModel->setReceipt($path);
        return $domainModel;
    }
    /**
     * 更新
     *
     * @param BaseDomainModel $domainModel
     * @return BaseDomainModel
     */
    public function update(BaseDomainModel $domainModel): BaseDomainModel
    {
        $values = $domainModel->toStorage();
        $fileObject = $values['imgObj'];
        $filePath = $values['filePath'];
        $oldFilePath = $values['oldFilePath'];
        if ((is_null($fileObject) && is_null($filePath)) && !is_null($oldFilePath)) {
            $domainModel->setFilePath($oldFilePath);
            $this->delete($domainModel);
        } elseif (!is_null($fileObject)) {
            $newFilePath = \Storage::disk($values['disk'])->putFile('/', $fileObject);
            if (!is_null($oldFilePath)) {
                $domainModel->setFilePath($oldFilePath);
                $this->delete($domainModel);
            }
            $domainModel->setFilePath($newFilePath);
        }
        return $domainModel;
    }
    /**
     * 削除
     *
     * @param BaseDomainModel $domainModel
     * @return void
     */
    public function delete(BaseDomainModel $domainModel): void
    {
        $values = $domainModel->toStorage();
        $disk = \Storage::disk($values['disk']);
        if ($disk->exists($values['basename'])) $disk->delete($values['basename']);
    }
}
