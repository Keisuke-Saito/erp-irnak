<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

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
final class OnetimeToken extends Model
{
    /** @var string プライマリーキーのカラム名 */
    protected $primaryKey = 'uuid';
    /** @var string プライマリーキーの型 */
    protected $keyType = 'string';
    /** @var string プライマリーキー自動連番 */
    public $incrementing = false;
    /** @var array ガード */
    protected $guarded = ['uuid'];

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
     * プロフィール情報を取得
     */
    public function profile()
    {
        return $this->hasOne('App\Models\Profile', 'erp_id', 'erp_id');
    }
}
