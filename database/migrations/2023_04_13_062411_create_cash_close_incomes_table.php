<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashCloseIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_close_incomes', function (Blueprint $table) {
            $table->id();
            $table->date('cash_close_date');
            $table->bigInteger('branch_id')->unsigned();
            $table->foreign('branch_id')->references('id')->on('branch_infos');
            $table->double('collection_service_charge',10,2)->nullable();
            $table->double('one_time_service_charge',10,2)->nullable();
            $table->double('admission_fee',10,2)->nullable();
            $table->double('form_fee',10,2)->nullable();
            $table->double('ho_income',10,2)->nullable();
            $table->double('third_party',10,2)->nullable();
            $table->double('savings_collection',10,2)->nullable();
            $table->double('monthly_saving_collection',10,2)->nullable();
            $table->double('onetime_saving',10,2)->nullable();
            $table->double('saving_accumulation',10,2)->nullable();
            $table->double('loan_accumulation',10,2)->nullable();
            $table->double('loan_collection',10,2)->nullable();
            $table->double('vehicle_income',10,2)->nullable();
            $table->double('stationary_income',10,2)->nullable();
            $table->double('venture_funds',10,2)->nullable();
            $table->double('future_funds',10,2)->nullable();
            $table->double('house_rent_advance',10,2)->nullable();
            $table->double('sundry_income',10,2)->nullable();
            $table->double('employee_income',10,2)->nullable();
            $table->double('office_collection',10,2)->nullable();
            $table->double('others',10,2)->nullable();
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
        Schema::dropIfExists('cash_close_incomes');
    }
}
