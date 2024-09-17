<?php
declare(strict_types=1);

namespace Common\App\Models;

use Common\Infrastructure\Base\Model\BaseModel;

/**
 * csvファイルモデル
 *
 * @property string $filename
 * @property string[] $csv
 * @method array toArray()
 */
final class Csv extends BaseModel
{
    /** @var string ファイル名 */
    protected $filename;
    /** @var string[] CSVデータ */
    protected $csv;
}
