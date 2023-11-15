<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('member_id',100);
            $table->string('branch_id');
            $table->string('area_id');
            $table->string('apply_date');
            $table->string('aplicant_name',100);
            $table->string('husband_wife')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('gender',30)->nullable();
            $table->string('religion',30)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('nid_no')->nullable();
            $table->string('occupation')->nullable();
            $table->string('phone')->nullable();
            $table->text('present_address')->nullable();
            $table->text('permenant_address')->nullable();
            $table->string('status')->comment('0 = Active & 1 = Inactive');
            $table->string('image',100)->nullable();
            $table->string('signature',100)->nullable();
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
        Schema::dropIfExists('members');
    }
}
