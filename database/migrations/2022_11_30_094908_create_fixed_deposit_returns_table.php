<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFixedDepositReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fixed_deposit_returns', function (Blueprint $table) {
            $table->id();
            $table->date('return_date');
            $table->bigInteger('branch_id')->unsigned()->nullable();
            $table->foreign('branch_id')->references('id')->on('branch_infos');
            $table->bigInteger('area_id')->unsigned()->nullable();
            $table->foreign('area_id')->references('id')->on('area_infos');
            $table->string('member_id')->references('id')->on('members');
            $table->double('deposit_return_ammount',10,2);
            $table->double('profit_ammount',10,2);
            $table->double('total',10,2);
            $table->string('comment');
            $table->integer('status');
            $table->bigInteger('admin_id')->unsigned();
            $table->foreign('admin_id')->references('id')->on('users');
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
        Schema::dropIfExists('fixed_deposit_returns');
    }
}
