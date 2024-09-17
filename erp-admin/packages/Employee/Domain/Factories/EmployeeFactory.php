<?php
declare(strict_types=1);

namespace Employee\Domain\Factories;

use Employee\App\Port\InputAdapter;
use Employee\Domain\Models\Delete\Values as DeleteValues;
use Employee\Domain\Models\Delete\DeleteModel;
use Employee\Domain\Models\Store\Values as StoreValues;
use Employee\Domain\Models\Store\StoreModel;
use Employee\Domain\Models\Store\ErpIdGenerator;
use Employee\Domain\Models\Store\TokenType;
use Employee\Domain\Models\UpdateDetail\Values as UpdateDetailValues;
use Employee\Domain\Models\UpdateDetail\UpdateDetailModel;

/**
 * 従業員モデル生成
 */
final class EmployeeFactory
{
    /**
     * リクエスト情報から従業員登録モデル生成
     *
     * @param InputAdapter $request
     * @return StoreModel
     */
    public function createStoreModelFromRequest(InputAdapter $request): StoreModel
    {
        $list = $request->all();
        $birthday = new StoreValues\Birthday($list['birthday']);
        return new StoreModel(
            new StoreValues\ErpId(new ErpIdGenerator($birthday)),
            new StoreValues\Name($list['lastname'], $list['firstname']),
            new StoreValues\Kana($list['lastnameKana'], $list['firstnameKana']),
            $birthday,
            new StoreValues\Gender($list['gender']),
            new StoreValues\PostalCode($list['postalCode']),
            new StoreValues\Prefectural($list['prefectural']),
            new StoreValues\Address($list['address']),
            new StoreValues\NearestStation($list['nearestStation']),
            new StoreValues\Birthplace($list['birthplace']),
            new StoreValues\Spouse($list['spouse']),
            new StoreValues\EnducationalBackground($list['enducationalBackground']),
            new StoreValues\Email($list['email']),
            new StoreValues\ContactNumber($list['contactNumber']),
            new StoreValues\EmergencyContactNumber($list['emergencyContactNumber']),
            new StoreValues\PossessionQualification($list['possessionQualification']),
            new StoreValues\RecruitmentClassification($list['recruitmentClassification']),
            new StoreValues\BelongId($list['belongId']),
            new StoreValues\AffiliationDeptId($list['affiliationDeptId']),
            new StoreValues\PositionId($list['positionId']),
            new StoreValues\JoinedAt($list['joinedAt']),
            new StoreValues\RetirementAt(null),
            new StoreValues\EmployeeDivId($list['employeeDivId']),
            new StoreValues\BusinessDivId($list['businessDivId']),
            new StoreValues\OperationDestinationName($list['operationDestinationName']),
            new StoreValues\OperationDestination($list['operationDestination']),
            new StoreValues\BusinessContent($list['businessContent']),
            new StoreValues\Note($list['note']),
            new StoreValues\Token(),
            new StoreValues\TypeDiv(new TokenType('CREATE_EMPLOYEE'))
        );
    }

    /**
     * リクエスト情報から従業員詳細更新情報モデル生成
     *
     * @param InputAdapter $request
     * @return UpdateDetailModel
     */
    public function createUpdateModelFromRequest(InputAdapter $request): UpdateDetailModel
    {
        $list = $request->all();
        return new UpdateDetailModel(
            new UpdateDetailValues\Uuid($list['uuid']),
            new UpdateDetailValues\ErpId($list['erpId']),
            new UpdateDetailValues\Name($list['lastname'], $list['firstname']),
            new UpdateDetailValues\Kana($list['lastnameKana'], $list['firstnameKana']),
            new UpdateDetailValues\Birthday($list['birthday']),
            new UpdateDetailValues\Gender($list['gender']),
            new UpdateDetailValues\PostalCode($list['postalCode']),
            new UpdateDetailValues\Prefectural($list['prefectural']),
            new UpdateDetailValues\Address($list['address']),
            new UpdateDetailValues\NearestStation($list['nearestStation']),
            new UpdateDetailValues\Birthplace($list['birthplace']),
            new UpdateDetailValues\Spouse($list['spouse']),
            new UpdateDetailValues\EnducationalBackground($list['enducationalBackground']),
            new UpdateDetailValues\Email($list['email']),
            new UpdateDetailValues\ContactNumber($list['contactNumber']),
            new UpdateDetailValues\EmergencyContactNumber($list['emergencyContactNumber']),
            new UpdateDetailValues\PossessionQualification($list['possessionQualification']),
            new UpdateDetailValues\RecruitmentClassification($list['recruitmentClassification']),
            new UpdateDetailValues\BelongId($list['belongId']),
            new UpdateDetailValues\AffiliationDeptId($list['affiliationDeptId']),
            new UpdateDetailValues\PositionId($list['positionId']),
            new UpdateDetailValues\JoinedAt($list['joinedAt']),
            new UpdateDetailValues\RetirementAt($list['retirementAt']),
            new UpdateDetailValues\EmployeeDivId($list['employeeDivId']),
            new UpdateDetailValues\BusinessDivId($list['businessDivId']),
            new UpdateDetailValues\OperationDestinationName($list['operationDestinationName']),
            new UpdateDetailValues\OperationDestination($list['operationDestination']),
            new UpdateDetailValues\BusinessContent($list['businessContent']),
            new UpdateDetailValues\Note($list['note'])
        );
    }

    /**
     * リクエスト情報から従業員ログイン削除情報モデル生成
     *
     * @param InputAdapter $request
     * @return DeleteModel
     */
    public function createDeleteModelFromRequest(InputAdapter $request): DeleteModel
    {
        $list = $request->all();
        return new DeleteModel(
            new DeleteValues\ErpId($list['erpId'])
        );
    }
}
