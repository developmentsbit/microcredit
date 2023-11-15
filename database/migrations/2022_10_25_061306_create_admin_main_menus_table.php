<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminMainMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_main_menus', function (Blueprint $table) {
            $table->id();
            $table->integer('serial_no');
            $table->string('main_menu','30');
            $table->string('icon',50);
            $table->integer('status')->comment('0 = Inactive and 1 = Active');
            $table->integer('admin_id');
            $table->dateTime('deleted_at')->nullable();
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
        Schema::dropIfExists('admin_main_menus');
    }
}
