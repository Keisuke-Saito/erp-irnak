<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Foundation\Auth\User as AuthenticatableUser;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Ramsey\Uuid\Uuid;

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
final class User extends AuthenticatableUser
{
    use HasFactory, SoftDeletes;

    /** @var string プライマリーキーのカラム名 */
    protected $primaryKey = 'uuid';
    /** @var string プライマリーキーの型 */
    protected $keyType = 'string';
    /** @var string プライマリーキー自動連番 */
    public $incrementing = false;
    /** @var array 削除日時 */
    protected $dates = ['deleted_at'];
    /** @var array ガード */
    protected $guarded = ['uuid'];
    /** @var array The attributes that should be hidden for arrays. */
    protected $hidden = ['password', 'api_token'];

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
     * ユーザーに関連するプロフィール情報を取得
     */
    public function profile()
    {
        return $this->hasOne('App\Models\Profile', 'erp_id', 'erp_id')->latest();
    }

    /**
     * ユーザーに関連するプロフィール情報を取得
     */
    public function allProfile()
    {
        return $this->hasMany('App\Models\Profile', 'erp_id', 'erp_id')->withTrashed()->orderBy('created_at', 'desc');
    }

    /**
     * 交通費情報を取得
     */
    public function fare()
    {
        return $this->belongsTo('App\Models\Fare', 'erp_id', 'erp_id');
    }
}
