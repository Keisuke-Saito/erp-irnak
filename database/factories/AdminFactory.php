<?php
declare(strict_types=1);

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class AdminFactory extends Factory
{
    /**
     * モデルと対応するファクトリの名前
     *
     * @var string
     */
    protected $model = Admin::class;

    /**
     * モデルのデフォルト状態の定義
     *
     * @return array
     */
    public function definition()
    {
        return [
            'login_id' => fake()->unique()->name(),
            'password' => Hash::make(Str::random(60)),
        ];
    }
}
