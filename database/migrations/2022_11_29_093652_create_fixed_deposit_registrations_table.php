<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFixedDepositRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fixed_deposit_registrations', function (Blueprint $table) {
            $table->id();
            $table->date('application_date');
            $table->string('registration_id',100);
            $table->bigInteger('branch_id')->unsigned()->nullable();
            $table->foreign('branch_id')->references('id')->on('branch_infos');
            $table->bigInteger('area_id')->unsigned()->nullable();
            $table->foreign('area_id')->references('id')->on('area_infos');
            $table->string('member_id')->references('id')->on('members');
            $table->string('phone',50)->nullable();
            $table->bigInteger('schema_id')->unsigned();
            $table->foreign('schema_id')->references('id')->on('fixed_deposit_schemas');
            $table->integer('approval')->default('0');
            $table->bigInteger('approved_by')->unsigned()->nullable();
            $table->foreign('approved_by')->references('id')->on('users');
            $table->double('deposit_ammount',10,2)->nullable();
            $table->double('service_charge',10,2)->nullable();
            $table->date('deposit_opening_date')->nullable();
            $table->date('deposit_exp_date')->nullable();
            $table->double('risk_ammount',10,2)->nullable();
            $table->string('comment')->nullable();
            $table->integer('status');
            $table->string('applicants_signature',200)->nullable();
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
        Schema::dropIfExists('fixed_deposit_registrations');
    }
}
