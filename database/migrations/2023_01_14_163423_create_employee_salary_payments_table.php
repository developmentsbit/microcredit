<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeSalaryPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_salary_payments', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->string('employee_id')->nullable();
            $table->string('transaction_type')->nullable();
            $table->string('salary_deposit')->nullable();
            $table->string('salary_withdraw')->nullable();
            $table->string('note')->nullable();
            $table->string('month')->nullable();
            $table->string('year')->nullable();
            $table->string('admin_id')->nullable();
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
        Schema::dropIfExists('employee_salary_payments');
    }
}
