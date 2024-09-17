<?php
declare(strict_types=1);

namespace Common\App\Models;

use Common\Infrastructure\Base\Model\BaseModel;

/**
 * 画像ファイルモデル
 *
 * @property string $fullPath
 * @property string $mimeType
 * @method array toArray()
 */
final class ImageFile extends BaseModel
{
    /** @var string ファイルパス */
    protected $fullPath;
    /** @var string ファイルタイプ */
    protected $mimeType;
}
