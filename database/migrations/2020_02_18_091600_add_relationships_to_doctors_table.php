<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipsToDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->BigInteger('specialist_id')->change()->unsigned();
            $table->foreign('specialist_id')->references('id')->on('specialists')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->dropForeign('doctors_specialist_id_foreign');
        });
        Schema::table('doctors', function (Blueprint $table) {
            $table->dropIndex('doctors_specialist_id_foreign');
        });
        Schema::table('doctors', function (Blueprint $table) {
            $table->integer('specialist_id')->change();
        });
    }
}
