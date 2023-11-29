<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositProfitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposit_profits', function (Blueprint $table) {
            $table->id();
            $table->string('deposit_id')->nullable();
            $table->date('date')->nullable();
            $table->integer('month')->nullable();
            $table->integer('year')->nullable();
            $table->double('profit',10,2)->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('deposit_profits');
    }
}
