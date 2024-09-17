<?php
declare(strict_types=1);

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    /**
     * モデルと対応するファクトリの名前
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * モデルのデフォルト状態の定義
     *
     * @return array
     */
    public function definition()
    {
        return [
            'erp_id' => fake()->unique()->word(),
            'hash_email' => hash('sha256', fake()->unique()->safeEmail()),
            'password' => Hash::make(Str::random(10)),
        ];
    }
}
