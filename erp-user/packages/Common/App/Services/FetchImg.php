<?php
declare(strict_types=1);

namespace Common\App\Services;

use Common\App\Port\InputAdapter;
use Common\App\QueryServices\StorageQueryInterface;
use Common\Infrastructure\Port\Output\Response\FetchImgResponse;

/**
 * 画像情報取得処理
 * @property StorageSystemInterface $storageSystem
 */
final class FetchImg
{
    /** @var StorageQueryInterface ストレージ */
    private $storage;

    /**
     * Store a new controller instance.
     *
     * @param StorageQueryInterface $storage
     * @return void
     */
    public function __construct(
        StorageQueryInterface $storage
    ){
        $this->storage = $storage;
    }

    /**
     * 画像情報取得処理
     *
     * @param InputAdapter $request
     * @return FetchImgResponse
     */
    public function execute(InputAdapter $request)
    {
        return new FetchImgResponse($this->storage->getImageFile($request));
    }
}
