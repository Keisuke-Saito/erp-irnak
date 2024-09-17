<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Admin
 *
 * @property string $uuid
 * @property string $login_id
 * @property string $password
 * @property string|null $api_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereApiToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereLoginId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Admin withoutTrashed()
 * @mixin \Eloquent
 */
	final class Admin extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AffiliationDeptMst
 *
 * @property string $uuid
 * @property int $affiliation_dept_id
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Profile $profile
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AffiliationDeptMst newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AffiliationDeptMst newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AffiliationDeptMst onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AffiliationDeptMst query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AffiliationDeptMst whereAffiliationDeptId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AffiliationDeptMst whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AffiliationDeptMst whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AffiliationDeptMst whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AffiliationDeptMst whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AffiliationDeptMst whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AffiliationDeptMst whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AffiliationDeptMst withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AffiliationDeptMst withoutTrashed()
 * @mixin \Eloquent
 */
	final class AffiliationDeptMst extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BelongMst
 *
 * @property string $uuid
 * @property int $belong_id
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Profile $profile
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BelongMst newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BelongMst newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BelongMst onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BelongMst query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BelongMst whereBelongId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BelongMst whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BelongMst whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BelongMst whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BelongMst whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BelongMst whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BelongMst whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BelongMst withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BelongMst withoutTrashed()
 * @mixin \Eloquent
 */
	final class BelongMst extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BusinessDivMst
 *
 * @property string $uuid
 * @property int $business_div_id
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Profile $profile
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BusinessDivMst newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BusinessDivMst newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BusinessDivMst onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BusinessDivMst query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BusinessDivMst whereBusinessDivId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BusinessDivMst whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BusinessDivMst whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BusinessDivMst whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BusinessDivMst whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BusinessDivMst whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BusinessDivMst whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BusinessDivMst withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BusinessDivMst withoutTrashed()
 * @mixin \Eloquent
 */
	final class BusinessDivMst extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EmployeeDivMst
 *
 * @property string $uuid
 * @property int $employee_div_id
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Profile $profile
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmployeeDivMst newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmployeeDivMst newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EmployeeDivMst onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmployeeDivMst query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmployeeDivMst whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmployeeDivMst whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmployeeDivMst whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmployeeDivMst whereEmployeeDivId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmployeeDivMst whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmployeeDivMst whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmployeeDivMst whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EmployeeDivMst withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EmployeeDivMst withoutTrashed()
 * @mixin \Eloquent
 */
	final class EmployeeDivMst extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Fare
 *
 * @property string $uuid
 * @property string $erp_id
 * @property string $target_month
 * @property int $confirm_status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\FareDetail[] $fareDetail
 * @property-read int|null $fare_detail_count
 * @property-read \App\Models\Profile $profile
 * @method static \Illuminate\Database\Eloquent\Builder|Fare newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Fare newQuery()
 * @method static \Illuminate\Database\Query\Builder|Fare onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Fare query()
 * @method static \Illuminate\Database\Eloquent\Builder|Fare whereConfirmStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fare whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fare whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fare whereErpId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fare whereTargetMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fare whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fare whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|Fare withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Fare withoutTrashed()
 * @mixin \Eloquent
 * @property-read \App\Models\User $user
 */
	final class Fare extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\FareDetail
 *
 * @property string $uuid
 * @property string $fare_id
 * @property string $target_date
 * @property string $destination
 * @property string $point_of_departure
 * @property string $arrival
 * @property int $route_div
 * @property int $transportation
 * @property int $amount_of_money
 * @property string|null $remarks
 * @property string|null $receipt
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Fare $Fare
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FareDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FareDetail newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FareDetail onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FareDetail query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FareDetail whereAmountOfMoney($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FareDetail whereArrival($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FareDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FareDetail whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FareDetail whereDestination($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FareDetail whereFareId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FareDetail wherePointOfDeparture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FareDetail whereReceipt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FareDetail whereRemarks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FareDetail whereRouteDiv($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FareDetail whereTargetDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FareDetail whereTransportation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FareDetail whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FareDetail whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FareDetail withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FareDetail withoutTrashed()
 * @mixin \Eloquent
 * @property string|null $admin_remarks
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FareDetail whereAdminRemarks($value)
 */
	final class FareDetail extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OnetimeToken
 *
 * @property string $uuid
 * @property string $erp_id
 * @property string $token
 * @property int $type_div
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Profile $profile
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OnetimeToken newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OnetimeToken newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OnetimeToken query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OnetimeToken whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OnetimeToken whereErpId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OnetimeToken whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OnetimeToken whereTypeDiv($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OnetimeToken whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OnetimeToken whereUuid($value)
 * @mixin \Eloquent
 */
	final class OnetimeToken extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PositionMst
 *
 * @property string $uuid
 * @property int $position_id
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Profile $profile
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PositionMst newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PositionMst newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PositionMst onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PositionMst query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PositionMst whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PositionMst whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PositionMst whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PositionMst whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PositionMst wherePositionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PositionMst whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PositionMst whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PositionMst withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PositionMst withoutTrashed()
 * @mixin \Eloquent
 */
	final class PositionMst extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Profile
 *
 * @property string $uuid
 * @property string|null $erp_id
 * @property string $name
 * @property string $kana
 * @property string $birthday
 * @property int|null $birthplace
 * @property int $gender
 * @property bool|null $spouse
 * @property int|null $enducational_background
 * @property string $postal_code
 * @property int $prefectural
 * @property string $address
 * @property string|null $nearest_station
 * @property string $email
 * @property string $contact_number
 * @property string|null $emergency_contact_number
 * @property int|null $recruitment_classification
 * @property int $belong_id
 * @property int $affiliation_dept_id
 * @property int $position_id
 * @property int $employee_div_id
 * @property int $business_div_id
 * @property string|null $joined_at
 * @property string|null $retirement_at
 * @property string|null $operation_destination_name
 * @property string|null $operation_destination
 * @property string|null $business_content
 * @property array|null $possession_qualification
 * @property string|null $note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\AffiliationDeptMst $affiliationDeptMst
 * @property-read \App\Models\BelongMst $belongMst
 * @property-read \App\Models\BusinessDivMst $businessDivMst
 * @property-read \App\Models\EmployeeDivMst $employeeDivMst
 * @property-read \App\Models\Fare|null $fare
 * @property-read \App\Models\OnetimeToken $onetimeToken
 * @property-read \App\Models\PositionMst $positionMst
 * @property-read \App\Models\User|null $user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereAffiliationDeptId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereBelongId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereBirthplace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereBusinessContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereBusinessDivId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereContactNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereEmergencyContactNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereEmployeeDivId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereEnducationalBackground($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereErpId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereJoinedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereKana($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereNearestStation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereOperationDestination($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereOperationDestinationName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile wherePositionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile wherePossessionQualification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile wherePrefectural($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereRecruitmentClassification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereRetirementAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereSpouse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile withoutTrashed()
 * @mixin \Eloquent
 */
	final class Profile extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property string $uuid
 * @property string $erp_id
 * @property string $hash_email
 * @property string $password
 * @property string|null $api_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Profile $profile
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereApiToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereErpId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereHashEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User withoutTrashed()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Profile[] $allProfile
 * @property-read int|null $all_profile_count
 * @property-read \App\Models\Fare $fare
 */
	final class User extends \Eloquent {}
}

