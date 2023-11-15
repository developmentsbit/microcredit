<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetDepreciationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_depreciations', function (Blueprint $table) {
            $table->id();
            $table->integer('sl');
            $table->bigInteger('asset_title_id')->unsigned();
            $table->foreign('asset_title_id')->references('id')->on('asset_categoreys');
            $table->string('depreciation_value_per');
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
        Schema::dropIfExists('asset_depreciations');
    }
}
