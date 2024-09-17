<?php
declare(strict_types=1);

namespace Database\Factories;

use App\Models\FareDetail;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;

class FareDetailFactory extends Factory
{
    /**
     * モデルと対応するファクトリの名前
     *
     * @var string
     */
    protected $model = FareDetail::class;

    /**
     * モデルのデフォルト状態の定義
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fare_id' => Uuid::uuid4()->toString(),
            'target_date' => fake()->date(),
            'destination' => fake()->company(),
            'point_of_departure' => fake()->city(),
            'arrival' => fake()->city(),
            'route_div' => fake()->boolean(),
            'transportation' => fake()->numberBetween(1,5),
            'amount_of_money' => fake()->numberBetween(1, 90) * 100,
            'remarks' => null,
            'admin_remarks' => null,
            'receipt' => null,
        ];
    }
}