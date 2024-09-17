<?php
declare(strict_types=1);

namespace Fare\Domain\Models\DeleteDetail;

use Fare\Infrastructure\Base\Model\BaseDomainModel;

/**
 * 交通費詳細削除モデル
 */
final class DeleteDetailModel extends BaseDomainModel
{
    /** @var FareId 交通費ID */
    protected $fareId;
    /** @var Uuid ID */
    protected $uuid;
    /** @var Disk ストレージディスク */
    protected $disk;
    /** @var FilePath ファイルパス */
    protected $filePath;

    /**
     * Store a new controller instance.
     *
     * @param Uuid $uuid
     * @return Disk $disk
     */
    public function __construct(
        Values\Uuid $uuid,
        Values\Disk $disk
    ){
        $this->uuid = $uuid;
        $this->disk = $disk;
    }

    /**
     * ファイルパスセット
     *
     * @param string|null $path
     * @return void
     */
    public function setFilePath(?string $path): void
    {
        $this->filePath = new Values\FilePath($path);
    }

    /**
     * 交通費IDセット
     *
     * @param string $fareId
     * @return void
     */
    public function setFareId(string $fareId): void
    {
        $this->fareId = new Values\FareId($fareId);
    }

    /**
     * ストレージ用
     *
     * @return array
     */
    public function toStorage(): array
    {
        return [
            'filePath' => $this->filePath->getValue(),
            'basename' => $this->filePath->getBasename(),
            'disk' => $this->disk->getValue()
        ];
    }
}
