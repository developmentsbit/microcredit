<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomeTitlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('income_titles', function (Blueprint $table) {
            $table->id();
            $table->string('sl')->nullable();
            $table->string('title')->nullable();
            $table->string('details')->nullable();
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
        Schema::dropIfExists('income_titles');
    }
}
