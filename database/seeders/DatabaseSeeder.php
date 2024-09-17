<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 既存データ削除
        Schema::disableForeignKeyConstraints(); //外部キーチェックを無効にする
        Models\Admin::truncate();
        Models\User::truncate();
        Models\Profile::truncate();
        Models\Fare::truncate();
        Models\FareDetail::truncate();
        Models\AffiliationDeptMst::truncate();
        Models\BelongMst::truncate();
        Models\BusinessDivMst::truncate();
        Models\EmployeeDivMst::truncate();
        Models\PositionMst::truncate();
        Schema::enableForeignKeyConstraints(); //外部キーチェックを有効にする

        // ユーザー登録
        $this->call([
            Login\LoginSeeder::class,                 // ユーザー登録
            Login\AdminSeeder::class,                 // 管理者ユーザー認証情報作成
            Master\BelongMstSeeder::class,            // 所属情報作成
            Master\AffiliationDeptMstSeeder::class,   // 所属部門情報作成
            Master\EmployeeDivMstSeeder::class,       // 従業員区分情報作成
            Master\BusinessDivMstSeeder::class,       // 業務区分情報作成
            Master\PositionMstSeeder::class,          // 役職情報作成
        ]);
    }
}
