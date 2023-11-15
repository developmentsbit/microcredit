<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSavingsMemberRegidToSavingsRegistrationNominees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('savings_registration_nominees', function (Blueprint $table) {
            $table->string('savings_member_regid',100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('savings_registration_nominees', function (Blueprint $table) {
            $table->string('savings_member_regid',100)->nullable();
        });
    }
}
