<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcceptemployeesalarysetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acceptemployeesalarysetups', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->bigInteger('employee_id')->unsigned()->nullable();
            $table->foreign('employee_id')->references('id')->on('employee_infos');
            $table->string('salary_scale')->nullable();
            $table->string('increment')->nullable();
            $table->string('total_salary')->nullable();
            
            $table->string('home_rent')->nullable();
            $table->string('travel_bill')->nullable();
            $table->string('mobile_bill')->nullable();
            $table->string('treatment_bill')->nullable();
            $table->string('others')->nullable();
            $table->string('totalsalaryforothers')->nullable();
            
            $table->string('gp')->nullable();
            $table->string('totalgp')->nullable();
            $table->string('monthkorton')->nullable();
            $table->string('revinew')->nullable();
            $table->string('totalkorton')->nullable();
            $table->string('netsalary')->nullable();
            $table->string('year')->nullable();
            $table->string('month')->nullable();
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
        Schema::dropIfExists('acceptemployeesalarysetups');
    }
}
