<?php
declare(strict_types=1);

namespace Common\App\Models;

use Common\Infrastructure\Base\Model\BaseModel;

/**
 * 所属部門マスタ
 *
 * @property int $affiliationDeptId
 * @property string $name
 * @property string $description
 * @method array toArray()
 */
final class AffiliationDeptMst extends BaseModel
{
    /** @var int 識別番号 */
    protected $affiliationDeptId;
    /** @var string 名称 */
    protected $name;
    /** @var string 説明 */
    protected $description;
}
