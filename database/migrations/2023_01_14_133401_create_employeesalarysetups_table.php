<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesalarysetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employeesalarysetups', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->bigInteger('branch_id')->unsigned()->nullable();
            $table->foreign('branch_id')->references('id')->on('branch_infos');
            $table->bigInteger('employee_id')->unsigned()->nullable();
            $table->foreign('employee_id')->references('id')->on('employee_infos');
            $table->string('salary_scale')->nullable();
            $table->string('home_rent')->nullable();
            $table->string('travel_bill')->nullable();
            $table->string('mobile_bill')->nullable();
            $table->string('treatment_bill')->nullable();
            $table->string('others')->nullable();
            $table->string('entry_date')->nullable();
            $table->string('gpper')->nullable();
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
        Schema::dropIfExists('employeesalarysetups');
    }
}
