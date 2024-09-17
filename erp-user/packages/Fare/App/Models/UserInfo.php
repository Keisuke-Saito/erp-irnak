<?php
declare(strict_types=1);

namespace Fare\App\Models;

use Fare\Infrastructure\Base\Model\BaseModel;

/**
 * 従業員
 *
 * @property string $erpId
 * @property string $name
 * @property string $kana
 * @property string $birthday
 * @property int $gender
 * @property string $postalCode
 * @property int $prefectural
 * @property string $address
 * @property string|null $nearestStation
 * @property int|null $birthplace
 * @property bool $spouse
 * @property int|null $enducationalBackground
 * @property string $email
 * @property string $contactNumber
 * @property string|null $emergencyContactNumber
 * @property array $possessionQualification
 * @property int|null $recruitmentClassification
 * @property int|null $belongId
 * @property int|null $affiliationDeptId
 * @property int|null $positionId
 * @property string|null $joinedAt
 * @property string|null $retirementAt
 * @property int|null $employeeDivId
 * @property int|null $businessDivId
 * @property string|null $operationDestinationName
 * @property string|null $operationDestination
 * @property string|null $businessContent
 * @property string|null $note
 * @method array toArray()
 */
final class UserInfo extends BaseModel
{
    protected $erpId;
    protected $name;
    protected $kana;
    protected $birthday;
    protected $gender;
    protected $postalCode;
    protected $prefectural;
    protected $address;
    protected $nearestStation;
    protected $birthplace;
    protected $spouse;
    protected $enducationalBackground;
    protected $email;
    protected $contactNumber;
    protected $emergencyContactNumber;
    protected $possessionQualification;
    protected $recruitmentClassification;
    protected $belongId;
    protected $affiliationDeptId;
    protected $positionId;
    protected $joinedAt;
    protected $retirementAt;
    protected $employeeDivId;
    protected $businessDivId;
    protected $operationDestinationName;
    protected $operationDestination;
    protected $businessContent;
    protected $note;
}
