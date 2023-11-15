<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_informations', function (Blueprint $table) {
            $table->id();
            $table->string('company_name',100);
            $table->string('title',100);
            $table->string('phone',20)->nullable();
            $table->string('phone_2',20)->nullable();
            $table->string('email',50)->nullable();
            $table->text('address')->nullable();
            $table->string('web_address',100)->nullable();
            $table->string('logo',100)->nullable();
            $table->string('short_logo',100)->nullable();
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
        Schema::dropIfExists('company_informations');
    }
}
