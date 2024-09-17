<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOnetimeTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('onetime_tokens', function (Blueprint $table) {
            $table->string('uuid', 36)->primary();
            $table->string('erp_id');
            $table->string('token')->unique();
            $table->integer('type_div');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('onetime_tokens');
    }
}
