<?php
declare(strict_types=1);

namespace Database\Seeders\Login;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Database\Seeder;

class LoginSeeder extends Seeder
{
    /**
     * ログインユーザー作成
     *
     * @return void
     */
    public function run()
    {
        // ユーザー認証情報
        User::factory()->create([
            'erp_id' => 'login',
            'hash_email' => hash('sha256', 'test@test.com'),
            'password' => \Hash::make('password')
        ]);
        // 登録情報
        Profile::factory()->create([
            'erp_id' => 'login',
            'email' => 'test@test.com'
        ]);
    }
}
