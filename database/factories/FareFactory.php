<?php
declare(strict_types=1);

namespace Database\Factories;

use App\Models\Fare;
use Illuminate\Database\Eloquent\Factories\Factory;

class FareFactory extends Factory
{
    /**
     * モデルと対応するファクトリの名前
     *
     * @var string
     */
    protected $model = Fare::class;

    /**
     * モデルのデフォルト状態の定義
     *
     * @return array
     */
    public function definition()
    {
        return [
            'erp_id' => fake()->word(),
            'target_month' => fake()->year() . '-' . fake()->month(),
            'confirm_status' => 1,
        ];
    }
}
