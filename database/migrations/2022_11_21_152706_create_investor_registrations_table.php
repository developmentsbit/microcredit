<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestorRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investor_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->string('registration_id')->nullable();
            $table->string('branch_id')->nullable();
            $table->string('area_id')->nullable();
            $table->string('member_id')->nullable();
            $table->string('phone')->nullable();
            $table->string('schema_id')->nullable();
            $table->string('schema_per')->nullable();
            $table->string('approval')->nullable();
            $table->string('amount')->nullable();
            $table->string('totalamount')->nullable();
            $table->string('service_charge')->nullable();
            $table->string('installment')->nullable();
            $table->string('installment_amount')->nullable();
            $table->string('investment_start_date')->nullable();
            $table->string('investment_end_date')->nullable();
            $table->string('deposite')->nullable();
            $table->string('risk_amount')->nullable();
            $table->string('comment')->nullable();
            $table->string('status')->nullable();
            $table->string('signature')->nullable();
            $table->string('nominee_name')->nullable();
            $table->string('nominee_email')->nullable();
            $table->string('nominee_present_address')->nullable();
            $table->string('nominee_permanent_address')->nullable();
            $table->string('nominee_nid_no')->nullable();
            $table->string('relation_for_applicant')->nullable();
            $table->string('nominee_image')->nullable();
            $table->string('nominee_signature')->nullable();
            $table->string('go_name')->nullable();
            $table->string('go_phone')->nullable();
            $table->string('go_address')->nullable();
            $table->string('go_signature')->nullable();
            $table->string('gt_name')->nullable();
            $table->string('gt_phone')->nullable();
            $table->string('gt_address')->nullable();
            $table->string('gt_signature')->nullable();
            $table->string('approve_by')->nullable();
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
        Schema::dropIfExists('investor_registrations');
    }
}
