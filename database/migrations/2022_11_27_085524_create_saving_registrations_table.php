<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSavingRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saving_registrations', function (Blueprint $table) {
            $table->id();
            $table->date('application_date');
            $table->string('registration_id',100);
            $table->bigInteger('branch_id')->unsigned();
            $table->foreign('branch_id')->references('id')->on('branch_infos');
            $table->bigInteger('area_id')->unsigned();
            $table->foreign('area_id')->references('id')->on('area_infos');
            $table->bigInteger('member_id')->unsigned();
            $table->foreign('member_id')->references('id')->on('members');
            $table->string('phone',50)->nullable();
            $table->bigInteger('schema_id')->unsigned();
            $table->foreign('schema_id')->references('id')->on('saving_schemas');
            $table->integer('approval')->nullable();
            $table->double('savings_ammount',10,2)->nullable();
            $table->double('total',10,2)->nullable();
            $table->double('service_charge',10,2)->nullable();
            $table->string('installment_no',100)->nullable();
            $table->double('installment_ammount',10,2)->nullable();
            $table->date('savings_handover_date')->nullable();
            $table->date('savings_exp_date')->nullable();
            $table->double('deposit_ammount',10,2)->nullable();
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
        Schema::dropIfExists('saving_registrations');
    }
}
