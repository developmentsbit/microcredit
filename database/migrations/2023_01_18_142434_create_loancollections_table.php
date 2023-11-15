<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoancollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loancollections', function (Blueprint $table) {
            $table->id();
            $table->integer('serial_no');
            $table->date('date');
            $table->bigInteger('branch_id')->unsigned();
            $table->foreign('branch_id')->references('id')->on('branch_infos');
            $table->bigInteger('member_id')->unsigned();
            $table->foreign('member_id')->references('id')->on('internalloans');
            $table->double('ammount',10,2);
            $table->text('description')->nullable();
            $table->integer('status');
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
        Schema::dropIfExists('loancollections');
    }
}
