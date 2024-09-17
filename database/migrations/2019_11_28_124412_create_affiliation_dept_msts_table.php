<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAffiliationDeptMstsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affiliation_dept_msts', function (Blueprint $table) {
            $table->string('uuid', 36)->primary();
            $table->smallInteger('affiliation_dept_id')->unique()->unsigned();
            $table->string('name')->unique();
            $table->text('description')->nullable($value = true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('affiliation_dept_msts');
    }
}
