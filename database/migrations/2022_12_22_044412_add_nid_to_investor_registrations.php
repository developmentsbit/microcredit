<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNidToInvestorRegistrations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('investor_registrations', function (Blueprint $table) {
            $table->string('nid',100)->nullable();
            $table->string('nominee_nid',100)->nullable();
            $table->string('go_nid',100)->nullable();
            $table->string('gt_nid',100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('investor_registrations', function (Blueprint $table) {
            $table->string('nid',100)->nullable();
            $table->string('nominee_nid',100)->nullable();
            $table->string('go_nid',100)->nullable();
            $table->string('gt_nid',100)->nullable();
        });
    }
}
