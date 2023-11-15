<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ho_collections', function (Blueprint $table) {
            $table->id();
            $table->string('sl')->nullable();
            $table->bigInteger('handover_branch_id')->unsigned();
            $table->foreign('handover_branch_id')->references('id')->on('branch_infos');
            $table->bigInteger('collection_branch_id')->unsigned();
            $table->foreign('collection_branch_id')->references('id')->on('branch_infos');
            $table->string('date')->nullable();
            $table->string('details')->nullable();
            $table->string('amount')->nullable();
            $table->string('status')->nullable();
            $table->string('admin_id')->nullable();
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
        Schema::dropIfExists('ho_collections');
    }
}
