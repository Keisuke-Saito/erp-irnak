<?php
declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProfileFactory extends Factory
{
    /**
     * モデルのデフォルト状態の定義
     *
     * @return array
     */
    public function definition()
    {
        return [
            'erp_id' => fake()->word(),
            'name' => fake()->name(),
            'kana' => fake()->kanaName(),
            'birthday' => fake()->date(),
            'gender' => fake()->randomElement([1, 2, 3, 99]),
            'postal_code' => fake()->numberBetween(111, 999) . '-' . sprintf('%04d', fake()->numberBetween(1, 9999)),
            'prefectural' => fake()->numberBetween(1, 47),
            'address' => explode('  ', fake()->address())[1],
            'nearest_station' => fake()->city() . '駅',
            'birthplace' => fake()->numberBetween(1, 47),
            'spouse' => fake()->boolean(),
            'enducational_background' => fake()->numberBetween(1, 6),
            'email' => fake()->unique()->safeEmail(),
            'contact_number' => fake()->phoneNumber(),
            'emergency_contact_number' => fake()->phoneNumber(),
            'possession_qualification' => ['英検１級', 'Oracle'],
            'recruitment_classification' => fake()->randomElement([1, 2, 99]),
            'belong_id' => fake()->numberBetween(1, 2),
            'affiliation_dept_id' => fake()->numberBetween(1, 3),
            'position_id' => 99,
            'joined_at' => fake()->date(),
            'retirement_at' => null,
            'employee_div_id' => fake()->numberBetween(1, 3),
            'business_div_id' => fake()->numberBetween(1, 3),
            'operation_destination_name' => fake()->company(),
            'operation_destination' => fake()->city() . '駅',
            'business_content' => null,
            'note' => null,
        ];
    }
}