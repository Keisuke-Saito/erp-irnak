<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Ramsey\Uuid\Uuid;

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
final class FareDetail extends Model
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
     * 交通費
     */
    public function Fare() {
        return $this->belongsTo('App\Models\Fare', 'fare_id', 'uuid');
    }
}
