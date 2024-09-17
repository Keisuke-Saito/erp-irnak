<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Ramsey\Uuid\Uuid;

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
final class BelongMst extends Model
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
        return $this->belongsTo('App\Models\Profile', 'belong_id', 'belong_id');
    }
}
