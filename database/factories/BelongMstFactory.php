<?php
declare(strict_types=1);

namespace Database\Factories;

use App\Models\BelongMst;
use Illuminate\Database\Eloquent\Factories\Factory;

class BelongMstFactory extends Factory
{
    /**
     * モデルと対応するファクトリの名前
     *
     * @var string
     */
    protected $model = BelongMst::class;

    /**
     * モデルのデフォルト状態の定義
     *
     * @return array
     */
    public function definition()
    {
        return [
            'belong_id' => fake()->unique()->numberBetween(1, 200),
            'name' => fake()->unique()->name(),
        ];
    }
}
