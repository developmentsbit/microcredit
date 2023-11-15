<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddApprovalToHoHandovers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ho_handovers', function (Blueprint $table) {
            $table->integer('approval')->default(0);
            $table->bigInteger('approved_by')->unsigned()->nullable();
            $table->foreign('approved_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ho_handovers', function (Blueprint $table) {
            $table->integer('approval')->default(0);
            $table->bigInteger('approved_by')->unsigned()->nullable();
            $table->foreign('approved_by')->references('id')->on('users');
        });
    }
}
