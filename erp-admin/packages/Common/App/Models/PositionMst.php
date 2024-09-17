<?php
declare(strict_types=1);

namespace Common\App\Models;

use Common\Infrastructure\Base\Model\BaseModel;

/**
 * 役職マスタ
 *
 * @property int $positionId
 * @property string $name
 * @property string $description
 * @method array toArray()
 */
final class PositionMst extends BaseModel
{
    /** @var int 識別番号 */
    protected $positionId;
    /** @var string 名称 */
    protected $name;
    /** @var string 説明 */
    protected $description;
}
