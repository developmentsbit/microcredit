<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestmentCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investment_collections', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->string('branch_id')->nullable();
            $table->string('area_id')->nullable();
            $table->string('member_id')->nullable();
            $table->string('investment_collection')->nullable();
            $table->string('originalamount')->nullable();
            $table->string('profit')->nullable();
            $table->string('risk_amount')->nullable();
            $table->string('deposite')->nullable();
            $table->string('total')->nullable();
            $table->string('comment')->nullable();
            $table->string('admin_id')->nullable();
            $table->integer('approval')->default(0);
            $table->bigInteger('approved_by')->unsigned()->nullable();
            $table->foreign('approved_by')->references('id')->on('users');
            $table->string('entry_date')->nullable();
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
        Schema::dropIfExists('investment_collections');
    }
}
