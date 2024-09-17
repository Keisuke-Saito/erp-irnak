<?php
declare(strict_types=1);

namespace Database\Factories;

use App\Models\PositionMst;
use Illuminate\Database\Eloquent\Factories\Factory;

class PositionMstFactory extends Factory
{
    /**
     * モデルと対応するファクトリの名前
     *
     * @var string
     */
    protected $model = PositionMst::class;

    /**
     * モデルのデフォルト状態の定義
     *
     * @return array
     */
    public function definition()
    {
        return [
            'position_id' => fake()->unique()->numberBetween(1, 200),
            'name' => fake()->unique()->name(),
        ];
    }
}