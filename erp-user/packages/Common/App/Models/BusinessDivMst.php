<?php
declare(strict_types=1);

namespace Common\App\Models;

use Common\Infrastructure\Base\Model\BaseModel;

/**
 * 業務区分マスタ
 *
 * @property int $businessDivId
 * @property string $name
 * @property string $description
 * @method array toArray()
 */
final class BusinessDivMst extends BaseModel
{
    /** @var int 識別番号 */
    protected $businessDivId;
    /** @var string 名称 */
    protected $name;
    /** @var string 説明 */
    protected $description;
}
