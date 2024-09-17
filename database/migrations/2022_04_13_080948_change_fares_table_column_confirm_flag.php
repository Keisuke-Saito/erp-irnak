<?php

use App\Models\Fare;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class ChangeFaresTableColumnConfirmFlag extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fares', function (Blueprint $table) {
            $table->renameColumn('confirm_flag', 'confirm_status');
        });

        // 型を変更
        Schema::table('fares', function (Blueprint $table) {
            $table->integer('confirm_status')->default(0)->unsigned()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fares', function (Blueprint $table) {
            $table->renameColumn('confirm_status', 'confirm_flag');
        });

        // 型を変更
        Schema::table('fares', function (Blueprint $table) {
            $table->boolean('confirm_flag')->default(false)->change();
        });

        DB::table('fares')
            ->where('confirm_flag', Fare::CONFIRM_STATUS_UNFIXED)
            ->orWhere('confirm_flag', Fare::CONFIRM_STATUS_MODIFYING)
            ->update(['confirm_flag' => Fare::CONFIRM_STATUS_UNFIXED]);

        DB::table('fares')
            ->where('confirm_flag', '!=', Fare::CONFIRM_STATUS_UNFIXED)
            ->update(['confirm_flag' => Fare::CONFIRM_STATUS_FIXED]);
    }
}
