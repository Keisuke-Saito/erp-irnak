<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFareDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fare_details', function (Blueprint $table) {
            $table->string('uuid', 36)->primary();
            $table->string('fare_id', 36);
            $table->date('target_date');
            $table->string('destination');
            $table->string('point_of_departure');
            $table->string('arrival');
            $table->tinyInteger('route_div')->unsigned();
            $table->tinyInteger('transportation')->unsigned();
            $table->unsignedInteger('amount_of_money');
            $table->text('remarks')->nullable($value = true);
            $table->text('admin_remarks')->nullable($value = true);
            $table->string('receipt')->nullable($value = true);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('fare_id')->references('uuid')->on('fares')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fare_details');
    }
}
