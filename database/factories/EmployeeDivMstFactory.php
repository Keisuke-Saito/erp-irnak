<?php
declare(strict_types=1);

namespace Database\Factories;

use App\Models\EmployeeDivMst;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeDivMstFactory extends Factory
{
    /**
     * モデルと対応するファクトリの名前
     *
     * @var string
     */
    protected $model = EmployeeDivMst::class;

    /**
     * モデルのデフォルト状態の定義
     *
     * @return array
     */
    public function definition()
    {
        return [
            'employee_div_id' => fake()->unique()->numberBetween(1, 200),
            'name' => fake()->unique()->name(),
        ];
    }
}