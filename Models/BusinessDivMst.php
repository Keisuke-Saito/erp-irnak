<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Ramsey\Uuid\Uuid;

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
final class BusinessDivMst extends Model
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
     * 登録情報情報
     */
    public function profile()
    {
        return $this->belongsTo('App\Models\Profile', 'business_div_id', 'business_div_id');
    }
}
