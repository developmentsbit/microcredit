<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_expenses', function (Blueprint $table) {
            $table->id();
            $table->integer('serial_no');
            $table->date('date');
            $table->bigInteger('branch_id')->unsigned();
            $table->foreign('branch_id')->references('id')->on('branch_infos');
            $table->bigInteger('asset_title_id')->unsigned();
            $table->foreign('asset_title_id')->references('id')->on('asset_categoreys');
            $table->double('taka_ammount');
            $table->integer('status');
            $table->text('description')->nullable();
            $table->bigInteger('admin_id')->unsigned();
            $table->foreign('admin_id')->references('id')->on('users');
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
        Schema::dropIfExists('asset_expenses');
    }
}
