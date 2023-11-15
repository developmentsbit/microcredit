<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSavingsRegistrationNomineesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('savings_registration_nominees', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('savings_reg_id')->unsigned();
            $table->foreign('savings_reg_id')->references('id')->on('saving_registrations');
            $table->string('nominee_name',200);
            $table->string('email',200)->nullable();
            $table->text('present_address')->nullable();
            $table->text('permenant_address')->nullable();
            $table->string('nid_no',100)->nullable();
            $table->string('relation',100)->nullable();
            $table->string('nominee_image',100)->nullable();
            $table->string('nominee_signature',100)->nullable();
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
        Schema::dropIfExists('savings_registration_nominees');
    }
}
