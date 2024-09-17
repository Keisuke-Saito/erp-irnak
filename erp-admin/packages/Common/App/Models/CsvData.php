<?php
declare(strict_types=1);

namespace Common\App\Models;

use Common\Infrastructure\Base\Model\BaseModel;

/**
 * csv情報
 *
 * @property BaseCollection $csvData
 * @property string $header
 * @property string $csvChara
 * @property string $dataChara
 * @property int $filename
 * @method mixed|null get($name)
 * @method array toArray()
 * @method self fill(array $attributes)
 */
final class CsvData extends BaseModel
{
    /** @var BaseCollection csv情報 */
    protected $csvData;
    /** @var string ヘッダー */
    protected $header;
    /** @var string csv用文字コード */
    protected $csvChara;
    /** @var string データ用文字コード */
    protected $dataChara;
    /** @var string ファイル名 */
    protected $filename;
}
