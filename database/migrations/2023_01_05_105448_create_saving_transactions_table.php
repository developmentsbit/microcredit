<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSavingTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saving_transactions', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('transaction_type')->nullable();
            $table->bigInteger('branch_id')->unsigned()->nullable();
            $table->foreign('branch_id')->references('id')->on('branch_infos');
            $table->bigInteger('area_id')->unsigned()->nullable();
            $table->foreign('area_id')->references('id')->on('area_infos');
            $table->string('member_id')->references('registration_id')->on('saving_registrations');
            $table->double('deposit_ammount',10,2)->nullable();
            $table->double('return_ammount',10,2)->nullable();
            $table->double('profit_ammount',10,2)->nullable();
            $table->double('total',10,2)->nullable();
            $table->string('comment')->nullable();
            $table->bigInteger('admin_id')->unsigned();
            $table->integer('approval')->default(0);
            $table->date('entry_date')->nullable();
            $table->bigInteger('approved_by')->unsigned()->nullable();
            $table->foreign('approved_by')->references('id')->on('users');
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
        Schema::dropIfExists('saving_transactions');
    }
}
