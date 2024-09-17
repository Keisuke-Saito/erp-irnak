<?php
declare(strict_types=1);

namespace Common\Infrastructure\Query\File;

use Common\App\Port\InputAdapter;
use Common\App\Models\ImageFile;
use Common\App\QueryServices\StorageQueryInterface;


/**
 * Storageリポジトリ
 */
class StorageQuery implements StorageQueryInterface
{
    /**
     * 画像取得
     *
     * @param InputAdapter $request
     * @return ImageFile
     */
    public function getImageFile(InputAdapter $request): ImageFile
    {
        $storage = \Storage::disk($request->get('disks'));
        $imageFile = new ImageFile();
        return $imageFile->fill([
            'fullPath' => $storage->path($request->get('filePath')),
            'mimeType' => $storage->mimeType($request->get('filePath'))
        ]);
    }
}
