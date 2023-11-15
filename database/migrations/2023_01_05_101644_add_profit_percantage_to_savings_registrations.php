<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProfitPercantageToSavingsRegistrations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('saving_registrations', function (Blueprint $table) {
            $table->string('profit_percantage',100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('saving_registrations', function (Blueprint $table) {
            $table->string('profit_percantage',100)->nullable();
        });
    }
}
