<?php
declare(strict_types=1);

namespace Database\Seeders\Login;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * ログインユーザー作成
     *
     * @return void
     */
    public function run()
    {
        Admin::factory()->create([
            'login_id' => 'admin',
            'password' => \Hash::make('password')
        ]);
    }
}
