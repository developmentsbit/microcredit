<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('sl');
            $table->bigInteger('branch_id')->unsigned();
            $table->foreign('branch_id')->references('id')->on('branch_infos');
            $table->integer('type');
            $table->string('name',100);
            $table->string('phone')->nullable();
            $table->string('phone_2')->nullable();
            $table->string('email')->nullable();
            $table->string('fathers_name',100)->nullable();
            $table->string('mothers_name',100)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('gender',30);
            $table->string('religion',30);
            $table->text('present_address')->nullable();
            $table->text('permenant_address')->nullable();
            $table->string('emp_id')->nullable();
             $table->string('nid_no')->nullable();
            $table->date('join_date')->nullable();
            $table->integer('status')->comment('0 = Active & 1 = Inactive');
            $table->string('image',30);

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
        Schema::dropIfExists('employee_infos');
    }
}
