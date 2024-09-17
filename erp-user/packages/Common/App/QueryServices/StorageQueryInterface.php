<?php
declare(strict_types=1);

namespace Common\App\QueryServices;

use Common\App\Port\InputAdapter;
use Common\App\Models\ImageFile;

/**
 * Storageリポジトリ
 */
interface StorageQueryInterface
{
    /**
     * 画像取得
     *
     * @param InputAdapter $request
     * @return ImageFile
     */
    public function getImageFile(InputAdapter $request): ImageFile;
}
