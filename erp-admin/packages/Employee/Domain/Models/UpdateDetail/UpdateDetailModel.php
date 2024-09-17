<?php
declare(strict_types=1);

namespace Employee\Domain\Models\UpdateDetail;

use Employee\Infrastructure\Base\Model\BaseDomainModel;

/**
 * 従業員詳細更新モデル
 *
 * @property Values\Uuid $uuid
 * @property Values\ErpId $erpId
 * @property Values\Name $name
 * @property Values\Kana $kana
 * @property Values\Birthday $birthday
 * @property Values\Gender $gender
 * @property Values\PostalCode $postalCode
 * @property Values\Prefectural $prefectural
 * @property Values\Address $address
 * @property Values\NearestStation $nearestStation
 * @property Values\Birthplace $birthplace
 * @property Values\Spouse $spouse
 * @property Values\EnducationalBackground $enducationalBackground
 * @property Values\Email $email
 * @property Values\ContactNumber $contactNumber
 * @property Values\EmergencyContactNumber $emergencyContactNumber
 * @property Values\PossessionQualification $possessionQualification
 * @property Values\RecruitmentClassification $recruitmentClassification
 * @property Values\BelongId $belongId
 * @property Values\AffiliationDeptId $affiliationDeptId
 * @property Values\PositionId $positionId
 * @property Values\JoinedAt $joinedAt
 * @property Values\RetirementAt $retirementAt
 * @property Values\EmployeeDivId $employeeDivId
 * @property Values\BusinessDivId $businessDivId
 * @property Values\OperationDestinationName $operationDestinationName
 * @property Values\OperationDestination $operationDestination
 * @property Values\BusinessContent $businessContent
 * @property Values\Note $note
 * @method array toArray()
 * @method string convSnake(string $key)
 */
final class UpdateDetailModel extends BaseDomainModel
{
    protected $uuid;
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

    private const PROFILE = [
        'erpId',
        'name',
        'kana',
        'birthday',
        'gender',
        'postalCode',
        'prefectural',
        'address',
        'nearestStation',
        'birthplace',
        'spouse',
        'enducationalBackground',
        'email',
        'contactNumber',
        'emergencyContactNumber',
        'possessionQualification',
        'recruitmentClassification',
        'belongId',
        'affiliationDeptId',
        'positionId',
        'joinedAt',
        'retirementAt',
        'employeeDivId',
        'businessDivId',
        'operationDestinationName',
        'operationDestination',
        'businessContent',
        'note'
    ];
    /**
     * Store a new controller instance.
     *
     * @param Uuid $uuid
     * @param ErpId $erpId
     * @param Name $name
     * @param Kana $kana
     * @param Birthday $birthday
     * @param Gender $gender
     * @param PostalCode $postalCode
     * @param Prefectural $prefectural
     * @param Address $address
     * @param NearestStation $nearestStation
     * @param Birthplace $birthplace
     * @param Spouse $spouse
     * @param EnducationalBackground $enducationalBackground
     * @param Email $email
     * @param ContactNumber $contactNumber
     * @param EmergencyContactNumber $emergencyContactNumber
     * @param PossessionQualification $possessionQualification
     * @param RecruitmentClassification $recruitmentClassification
     * @param BelongId $belongId
     * @param AffiliationDeptId $affiliationDeptId
     * @param PositionId $positionId
     * @param JoinedAt $joinedAt
     * @param RetirementAt $retirementAt
     * @param EmployeeDivId $employeeDivId
     * @param BusinessDivId $businessDivId
     * @param Note $note
     */
    public function __construct(
        Values\Uuid $uuid,
        Values\ErpId $erpId,
        Values\Name $name,
        Values\Kana $kana,
        Values\Birthday $birthday,
        Values\Gender $gender,
        Values\PostalCode $postalCode,
        Values\Prefectural $prefectural,
        Values\Address $address,
        Values\NearestStation $nearestStation,
        Values\Birthplace $birthplace,
        Values\Spouse $spouse,
        Values\EnducationalBackground $enducationalBackground,
        Values\Email $email,
        Values\ContactNumber $contactNumber,
        Values\EmergencyContactNumber $emergencyContactNumber,
        Values\PossessionQualification $possessionQualification,
        Values\RecruitmentClassification $recruitmentClassification,
        Values\BelongId $belongId,
        Values\AffiliationDeptId $affiliationDeptId,
        Values\PositionId $positionId,
        Values\JoinedAt $joinedAt,
        Values\RetirementAt $retirementAt,
        Values\EmployeeDivId $employeeDivId,
        Values\BusinessDivId $businessDivId,
        Values\OperationDestinationName $operationDestinationName,
        Values\OperationDestination $operationDestination,
        Values\BusinessContent $businessContent,
        Values\Note $note
    ){
        $this->uuid = $uuid;
        $this->erpId = $erpId;
        $this->name = $name;
        $this->kana = $kana;
        $this->birthday = $birthday;
        $this->gender = $gender;
        $this->postalCode = $postalCode;
        $this->prefectural = $prefectural;
        $this->address = $address;
        $this->nearestStation = $nearestStation;
        $this->birthplace = $birthplace;
        $this->spouse = $spouse;
        $this->enducationalBackground = $enducationalBackground;
        $this->email = $email;
        $this->contactNumber = $contactNumber;
        $this->emergencyContactNumber = $emergencyContactNumber;
        $this->possessionQualification = $possessionQualification;
        $this->recruitmentClassification = $recruitmentClassification;
        $this->belongId = $belongId;
        $this->affiliationDeptId = $affiliationDeptId;
        $this->positionId = $positionId;
        $this->joinedAt = $joinedAt;
        $this->retirementAt = $retirementAt;
        $this->employeeDivId = $employeeDivId;
        $this->businessDivId = $businessDivId;
        $this->operationDestinationName = $operationDestinationName;
        $this->operationDestination = $operationDestination;
        $this->businessContent = $businessContent;
        $this->note = $note;
    }

    /**
     * profileに関するプロパティを返す
     *
     * @return array
     */
    public function toProfile(): array
    {
        $propatyList = $this->toArray();
        $toProfile = [];
        foreach ($propatyList as $key => $value) {
            if (!in_array($key, self::PROFILE, true)) continue;
            $toProfile[$this->convSnake($key)] = $value;
        }
        return $toProfile;
    }

    /**
     * マスター取得に関するメソッド名を返す
     *
     * @return array
     */
    public function toRelationMstMethod(): array
    {
        return [
            'belongMst' => $this->belongId->getValue(),
            'affiliationDeptMst' => $this->affiliationDeptId->getValue(),
            'positionMst' => $this->positionId->getValue(),
            'employeeDivMst' => $this->employeeDivId->getValue(),
            'businessDivMst' => $this->businessDivId->getValue()
        ];
    }

}
