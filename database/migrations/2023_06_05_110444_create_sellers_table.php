<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('comp_name_1');
            $table->string('comp_email_1');
            $table->string('comp_contact_1');
            $table->string('designation_1');
            $table->string('dob_1');
            $table->string('comp_name_2');
            $table->string('comp_email_2');
            $table->string('comp_contact_2');
            $table->string('designation_2');
            $table->string('dob_2');
            $table->string('comp_name_3');
            $table->string('comp_email_3');
            $table->string('comp_contact_3');
            $table->string('designation_3');
            $table->string('dob_3');
            $table->string('comp_office_address');
            $table->string('comp_factory_address');
            $table->string('comp_ownername');
            $table->string('upload_certification');
            $table->string('ntn');
            $table->string('gst');
            $table->string('comp_general_certification')->nullable();
            $table->boolean('is_tmc', 1);

            $table->string('is_active',1)->default(1); // *1 => active , 0 => in active
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users');
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->foreign('deleted_by')->references('id')->on('users');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sellers');
    }
};