<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipsToPatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->BigInteger('employee_id')->change()->unsigned();
            $table->foreign('employee_id')->references('id')->on('employees')->onUpdate('cascade')->onDelete('cascade');
            $table->BigInteger('seat_id')->change()->unsigned();
            $table->foreign('seat_id')->references('id')->on('seats')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->dropForeign('patients_employee_id_foreign');
        });
        Schema::table('patients', function (Blueprint $table) {
            $table->dropIndex('patients_employee_id_foreign');
        });
        Schema::table('patients', function (Blueprint $table) {
            $table->integer('employee_id')->change();
        });

        Schema::table('patients', function (Blueprint $table) {
            $table->dropForeign('patients_seat_id_foreign');
        });
        Schema::table('patients', function (Blueprint $table) {
            $table->dropIndex('patients_seat_id_foreign');
        });
        Schema::table('patients', function (Blueprint $table) {
            $table->integer('seat_id')->change();
        });
    }
}
