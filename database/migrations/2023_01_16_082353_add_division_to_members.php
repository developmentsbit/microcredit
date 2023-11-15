<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDivisionToMembers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('members', function (Blueprint $table) {
            $table->bigInteger('division')->unsigned()->nullable();
            $table->foreign('division')->references('id')->on('division_informations');
            $table->bigInteger('district')->unsigned()->nullable();
            $table->foreign('district')->references('id')->on('district_informations');
            $table->bigInteger('upazila')->unsigned()->nullable();
            $table->foreign('upazila')->references('id')->on('upazila_informations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('members', function (Blueprint $table) {
            $table->bigInteger('division')->unsigned()->nullable();
            $table->foreign('division')->references('id')->on('division_informations');
            $table->bigInteger('district')->unsigned()->nullable();
            $table->foreign('district')->references('id')->on('district_informations');
            $table->bigInteger('upazila')->unsigned()->nullable();
            $table->foreign('upazila')->references('id')->on('upazila_informations');
        });
    }
}
