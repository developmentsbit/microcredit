<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestorRiskamountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investor_riskamount', function (Blueprint $table) {
            $table->id();
            $table->string('date',100)->nullable();
            $table->string('member_id')->nullable();
            // $table->foreign('member_id')->references('id')->on('members');
            $table->string('registration_id')->nullable();
            // $table->foreign('registration_id')->references('id')->on('investor_registrations');
            $table->string('risk_amount',100)->nullable();
            $table->string('withdraw',100)->nullable();

            $table->string('branch_id')->nullable();
            $table->string('area_id')->nullable();
            $table->string('comment')->nullable();
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
        Schema::dropIfExists('investor_riskamount');
    }
}
