<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminSubMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_sub_menus', function (Blueprint $table) {
            $table->id();
            $table->integer('serial_no');
            $table->bigInteger('main_menu_id')->unsigned();
            $table->foreign('main_menu_id')->references('id')->on('admin_main_menus');
            $table->string('sub_menu',100);
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
        Schema::dropIfExists('admin_sub_menus');
    }
}
