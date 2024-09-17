<?php
declare(strict_types=1);

namespace App\Http\Api\Employee\Store;

use App\Http\Api\Base\Connector\BaseRequestValue;

use Carbon\Carbon;

/**
 * 従業員新規追加リクエスト
 * @method array toArray()
 */
final class RequestValue extends BaseRequestValue
{
    protected $lastname;
    protected $firstname;
    protected $lastnameKana;
    protected $firstnameKana;
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
    /**
     * Store a new controller instance.
     *
     * @param RequestValidation $request
     * @return void
     */
    public function __construct(
        RequestValidation $request
    ){
        $this->lastname = $request['lastname'] ;
        $this->firstname = $request['firstname'];
        $this->lastnameKana = $request['lastnameKana'];
        $this->firstnameKana = $request['firstnameKana'];
        $this->birthday = new Carbon($request['birthday']);
        $this->gender = (int)$request['gender'];
        $this->postalCode = $request['postalCode'];
        $this->prefectural = (int)$request['prefectural'];
        $this->address = $request['address'];
        $this->nearestStation = $request['nearestStation'] ?? null;
        $this->birthplace = $request['birthplace'] ? (int)$request['birthplace'] : null;
        $this->spouse = $request['spouse'] ? (boolean)$request['spouse'] : null;
        $this->enducationalBackground = $request['enducationalBackground'] ? (int)$request['enducationalBackground'] : null;
        $this->email = $request['email'];
        $this->contactNumber = $request['contactNumber'];
        $this->emergencyContactNumber = $request['emergencyContactNumber'] ?? null;
        $possessionQualificationList = json_decode($request['possessionQualification'], true);
        $possessionQualification = [];
        foreach ($possessionQualificationList as $possessionQualificationDetail) {
            if (!array_key_exists('value' , $possessionQualificationDetail)) continue;
            $value = $possessionQualificationDetail['value'];
            if (strlen($value) === 0) continue;
            $possessionQualification[] = $value;
        }
        $this->possessionQualification = empty($possessionQualification) ? null : $possessionQualification;
        $this->recruitmentClassification = $request['recruitmentClassification'] ? (int)$request['recruitmentClassification'] : null;
        $this->belongId = $request['belongId'] ? (int)$request['belongId'] : null;
        $this->affiliationDeptId = $request['affiliationDeptId'] ? (int)$request['affiliationDeptId'] : null;
        $this->positionId = $request['positionId'] ? (int)$request['positionId'] : null;
        $this->employeeDivId = $request['employeeDivId'] ? (int)$request['employeeDivId'] : null;
        $this->businessDivId = $request['businessDivId'] ? (int)$request['businessDivId'] : null;
        $this->joinedAt = is_null($request['joinedAt']) ? null : new Carbon($request['joinedAt']);
        $this->operationDestinationName = $request['operationDestinationName'] ?? null;
        $this->operationDestination = $request['operationDestination'] ?? null;
        $this->businessContent = $request['businessContent'] ?? null;
        $this->note = $request['note'] ?? '';
    }
}
