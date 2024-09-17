<?php
declare(strict_types=1);

namespace Database\Factories;

use App\Models\AffiliationDeptMst;
use Illuminate\Database\Eloquent\Factories\Factory;

class AffiliationDeptMstFactory extends Factory
{
    /**
     * モデルと対応するファクトリの名前
     *
     * @var string
     */
    protected $model = AffiliationDeptMst::class;

    /**
     * モデルのデフォルト状態の定義
     *
     * @return array
     */
    public function definition()
    {
        return [
            'affiliation_dept_id' => fake()->unique()->numberBetween(1, 200),
            'name' => fake()->unique()->name(),
        ];
    }
}
