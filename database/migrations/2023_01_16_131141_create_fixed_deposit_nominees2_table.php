<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFixedDepositNominees2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fixed_deposit_nominees2', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('fixed_deposit_regid')->unsigned()->nullable();
            $table->foreign('fixed_deposit_regid')->references('id')->on('fixed_deposit_registrations');
            $table->string('nominee_name')->nullable();
            $table->string('email')->nullable();
            $table->string('present_address')->nullable();
            $table->string('permenant_address')->nullable();
            $table->string('nid_no')->nullable();
            $table->string('relation')->nullable();
            $table->string('nominee_image')->nullable();
            $table->string('nominee_signature')->nullable();
            $table->string('nid')->nullable();
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
        Schema::dropIfExists('fixed_deposit_nominees2');
    }
}
