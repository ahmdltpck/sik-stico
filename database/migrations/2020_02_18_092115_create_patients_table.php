<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('patient_type');
            $table->string('name');
            $table->string('gender');
            $table->string('birthDate');
            $table->string('bloodGroup');
            $table->string('symptoms');
            $table->string('mobile');
            $table->string('email');
            $table->string('address');
            $table->string('photo');
            $table->string('size');
            $table->string('type');
            $table->integer('employee_id');
            $table->integer('seat_id');
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
        Schema::dropIfExists('patients');
    }
}
