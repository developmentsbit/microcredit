<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashCloseExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_close_expenses', function (Blueprint $table) {
            $table->id();
            $table->date('cash_close_date');
            $table->bigInteger('branch_id')->unsigned();
            $table->foreign('branch_id')->references('id')->on('branch_infos');
            $table->double('salary_expense',10,2)->nullable();
            $table->double('office_rent',10,2)->nullable();
            $table->double('transport',10,2)->nullable();
            $table->double('general_expense',10,2)->nullable();
            $table->double('electricity_bill',10,2)->nullable();
            $table->double('saving_accumulation_expense',10,2)->nullable();
            $table->double('loan_accumulation_expense',10,2)->nullable();
            $table->double('hospitality',10,2)->nullable();
            $table->double('bonus',10,2)->nullable();
            $table->double('saving_return',10,2)->nullable();
            $table->double('monthly_saving_return',10,2)->nullable();
            $table->double('onetime_saving_return',10,2)->nullable();
            $table->double('ho_expense',10,2)->nullable();
            $table->double('third_pary_expense',10,2)->nullable();
            $table->double('saving_accumulation_return',10,2)->nullable();
            $table->double('loan_accumulation_return',10,2)->nullable();
            $table->double('loan_distribution',10,2)->nullable();
            $table->double('loan_service_charge',10,2)->nullable();
            $table->double('vehicle_expense',10,2)->nullable();
            $table->double('advance_house_rent',10,2)->nullable();
            $table->double('future_fund_return',10,2)->nullable();
            $table->double('sundry_expense',10,2)->nullable();
            $table->double('risk_fund_withdraw',10,2)->nullable();
            $table->double('case_expense',10,2)->nullable();
            $table->double('security_expense',10,2)->nullable();
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
        Schema::dropIfExists('cash_close_expenses');
    }
}
