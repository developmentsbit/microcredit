<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_transaction', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('account_id')->unsigned()->nullable();
            $table->foreign('account_id')->references('id')->on('bank_information');
            $table->string('transaction_type')->nullable();
            $table->string('vouchar_cheque_no')->nullable();
            $table->string('deposit_withdraw_amount')->nullable();
            $table->string('deposit_withdraw_date')->nullable();
            $table->string('deposit_withdraw_entryDate')->nullable();
            $table->string('note')->nullable();
            $table->string('admin_id')->nullable();
            $table->string('branch_id')->nullable();
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
        Schema::dropIfExists('bank_transaction');
    }
}
