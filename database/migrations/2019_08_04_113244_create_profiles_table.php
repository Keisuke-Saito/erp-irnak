<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->string('uuid', 36)->primary();
            $table->string('erp_id')->unique()->nullable($value = true);
            $table->string('name');
            $table->string('kana');
            $table->date('birthday');
            $table->tinyInteger('birthplace')->nullable($value = true)->unsigned();
            $table->tinyInteger('gender')->unsigned();
            $table->boolean('spouse')->nullable($value = true);
            $table->tinyInteger('enducational_background')->nullable($value = true)->unsigned();
            $table->string('postal_code');
            $table->tinyInteger('prefectural')->unsigned();
            $table->text('address');
            $table->string('nearest_station')->nullable($value = true);
            $table->text('email');
            $table->string('contact_number');
            $table->string('emergency_contact_number')->nullable($value = true);
            $table->tinyInteger('recruitment_classification')->nullable($value = true)->unsigned();
            $table->tinyInteger('belong_id')->default(99)->unsigned();
            $table->tinyInteger('affiliation_dept_id')->default(99)->unsigned();
            $table->tinyInteger('position_id')->default(99)->unsigned();
            $table->tinyInteger('employee_div_id')->default(99)->unsigned();
            $table->tinyInteger('business_div_id')->default(99)->unsigned();
            $table->date('joined_at')->nullable($value = true);
            $table->date('retirement_at')->nullable($value = true);
            $table->string('operation_destination_name')->nullable($value = true);
            $table->string('operation_destination')->nullable($value = true);
            $table->text('business_content')->nullable($value = true);
            $table->json('possession_qualification')->nullable($value = true);
            $table->text('note')->nullable($value = true);
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
        Schema::dropIfExists('profiles');
    }
}
