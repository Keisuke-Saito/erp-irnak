<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Crypt;
use Ramsey\Uuid\Uuid;

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
final class Profile extends Model
{
    use HasFactory, SoftDeletes;
    /** @var array 削除日時 */
    protected $dates = ['deleted_at'];
    /** @var array ガード */
    protected $guarded = ['uuid'];
    /** @var array ネイティブなタイプへキャストする属性 */
    protected $casts = [
        'spouse' => 'boolean',
        'possession_qualification' => 'array'
    ];
    /** @var string プライマリーキーのカラム名 */
    protected $primaryKey = 'uuid';
    /** @var string プライマリーキーの型 */
    protected $keyType = 'string';
    /** @var string プライマリーキー自動連番 */
    public $incrementing = false;

    /**
     * @param array $attributes = []
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        // newした時に自動的にuuidを設定する。
        $this->attributes['uuid'] = Uuid::uuid4()->toString();
    }

    /**
     * このプロフィール情報を所有するUserを取得
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'erp_id', 'erp_id')->withTrashed();
    }

    /**
     * ワンタイムトークンを取得
     */
    public function onetimeToken()
    {
        return $this->hasOne('App\Models\OnetimeToken', 'erp_id', 'erp_id');
    }

    /**
     * 所属情報を取得
     */
    public function belongMst()
    {
        return $this->hasOne('App\Models\BelongMst', 'belong_id', 'belong_id');
    }

    /**
     * 所属部門情報を取得
     */
    public function affiliationDeptMst()
    {
        return $this->hasOne('App\Models\AffiliationDeptMst', 'affiliation_dept_id', 'affiliation_dept_id');
    }

    /**
     * 役職情報を取得
     */
    public function positionMst()
    {
        return $this->hasOne('App\Models\PositionMst', 'position_id', 'position_id');
    }

    /**
     * 役職情報を取得
     */
    public function employeeDivMst()
    {
        return $this->hasOne('App\Models\EmployeeDivMst', 'employee_div_id', 'employee_div_id');
    }

    /**
     * 事業区分情報を取得
     */
    public function businessDivMst()
    {
        return $this->hasOne('App\Models\BusinessDivMst', 'business_div_id', 'business_div_id');
    }

    /**
     * 名前を暗号化
     *
     * @param string $value
     * @return void
     */
    public function setNameAttribute(string $value)
    {
        $this->attributes['name'] = Crypt::encryptString($value);
    }

    /**
     * 名前を復号
     *
     * @param string $value
     * @return string
     */
    public function getNameAttribute(string $value): string
    {
        return Crypt::decryptString($value);
    }

    /**
     * 名前（カナ）を暗号化
     *
     * @param string $value
     * @return void
     */
    public function setKanaAttribute(string $value)
    {
        $this->attributes['kana'] = Crypt::encryptString($value);
    }

    /**
     * 名前（カナ）を復号
     *
     * @param string $value
     * @return string
     */
    public function getKanaAttribute(string $value): string
    {
        return Crypt::decryptString($value);
    }

    /**
     * 郵便番号を暗号化
     *
     * @param string $value
     * @return void
     */
    public function setPostalCodeAttribute(string $value)
    {
        $this->attributes['postal_code'] = Crypt::encryptString($value);
    }

    /**
     * 郵便番号を復号
     *
     * @param string $value
     * @return string
     */
    public function getPostalCodeAttribute(string $value): string
    {
        return Crypt::decryptString($value);
    }

    /**
     * 住所を暗号化
     *
     * @param string $value
     * @return void
     */
    public function setAddressAttribute(string $value)
    {
        $this->attributes['address'] = Crypt::encryptString($value);
    }

    /**
     * 住所を復号
     *
     * @param string $value
     * @return string
     */
    public function getAddressAttribute(string $value): string
    {
        return Crypt::decryptString($value);
    }

    /**
     * 最寄駅を暗号化
     *
     * @param string|null $value
     * @return void
     */
    public function setNearestStationAttribute(?string $value)
    {
        $this->attributes['nearest_station'] = is_null($value) ? $value : Crypt::encryptString($value);
    }

    /**
     * 最寄駅を復号
     *
     * @param string|null $value
     * @return string|null
     */
    public function getNearestStationAttribute(?string $value): ?string
    {
        return is_null($value) ? $value : Crypt::decryptString($value);
    }

    /**
     * メールアドレスを暗号化
     *
     * @param string $value
     * @return void
     */
    public function setEmailAttribute(string $value)
    {
        $this->attributes['email'] = Crypt::encryptString($value);
    }

    /**
     * メールアドレスを復号
     *
     * @param string $value
     * @return string
     */
    public function getEmailAttribute(string $value): string
    {
        return Crypt::decryptString($value);
    }

    /**
     * 連絡先を暗号化
     *
     * @param string $value
     * @return void
     */
    public function setContactNumberAttribute(string $value)
    {
        $this->attributes['contact_number'] = Crypt::encryptString($value);
    }

    /**
     * 連絡先を復号
     *
     * @param string $value
     * @return string
     */
    public function getContactNumberAttribute(string $value): string
    {
        return Crypt::decryptString($value);
    }

    /**
     * 緊急連絡先を暗号化
     *
     * @param string|null $value
     * @return void
     */
    public function setEmergencyContactNumberAttribute(?string $value)
    {
        $this->attributes['emergency_contact_number'] = is_null($value) ? $value : Crypt::encryptString($value);
    }

    /**
     * 緊急連絡先を復号
     *
     * @param string|null $value
     * @return string|null
     */
    public function getEmergencyContactNumberAttribute(?string $value): ?string
    {
        return is_null($value) ? $value : Crypt::decryptString($value);
    }
}
