<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Ramsey\Uuid\Uuid;

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
final class Fare extends Model
{
    use HasFactory, SoftDeletes;
    /** @var array 削除日時 */
    protected $dates = ['deleted_at'];
    /** @var array ガード */
    protected $guarded = ['uuid'];
    /** @var string プライマリーキーのカラム名 */
    protected $primaryKey = 'uuid';
    /** @var string プライマリーキーの型 */
    protected $keyType = 'string';
    /** @var string プライマリーキー自動連番 */
    public $incrementing = false;
    /** @var array 確定ステータス */
    const CONFIRM_STATUS_LIST = [
        self::CONFIRM_STATUS_UNSUBMITTED => '未提出',
        self::CONFIRM_STATUS_UNFIXED     => '未確定',
        self::CONFIRM_STATUS_FIXED       => '確定',
        self::CONFIRM_STATUS_AUTO_FIXED  => '自動確定',
        self::CONFIRM_STATUS_MODIFYING   => '修正中',
        self::CONFIRM_STATUS_VERIFID     => '確認済み'
    ];
    /** @var null 確定ステータス未提出 */
    const CONFIRM_STATUS_UNSUBMITTED = null;
    /** @var int 確定ステータス未確定 */
    const CONFIRM_STATUS_UNFIXED = 0;
    /** @var int 確定ステータス確定 */
    const CONFIRM_STATUS_FIXED = 1;
    /** @var int 確定ステータス自動確定 */
    const CONFIRM_STATUS_AUTO_FIXED = 2;
    /** @var int 確定ステータス修正中 */
    const CONFIRM_STATUS_MODIFYING = 3;
    /** @var int 確定ステータス確認済み */
    const CONFIRM_STATUS_VERIFID = 4;

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
     * 確定ステータス表示用
     */
    public function getConfirmStatus(?int $status = null) {
        $status = $status ?? $this->confirm_status;
        return self::CONFIRM_STATUS_LIST[$status] ?? '';
    }

    /**
     * 交通費詳細
     */
    public function fareDetail() {
        return $this->hasMany('App\Models\FareDetail', 'fare_id', 'uuid');
    }

    /**
     * ユーザー情報を取得
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'erp_id', 'erp_id');
    }
}
