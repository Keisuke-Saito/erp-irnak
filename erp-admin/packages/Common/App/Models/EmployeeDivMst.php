<?php
declare(strict_types=1);

namespace Common\App\Models;

use Common\Infrastructure\Base\Model\BaseModel;

/**
 * 従業員区分マスタ
 *
 * @property int $employeeDivId
 * @property string $name
 * @property string $description
 * @method array toArray()
 */
final class EmployeeDivMst extends BaseModel
{
    /** @var int 識別番号 */
    protected $employeeDivId;
    /** @var string 名称 */
    protected $name;
    /** @var string 説明 */
    protected $description;
}
