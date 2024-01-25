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
        Schema::create('bmr_proceeds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('buyer_make_request_id');
            $table->foreign('buyer_make_request_id')->references('id')->on('buyer_make_requests');
            $table->unsignedBigInteger('seller_id');
            $table->foreign('seller_id')->references('id')->on('users');
            $table->string('is_reject_by_seller', 1)->default(0);
            $table->longtext('is_reject_by_seller_reason')->nullable();
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
        Schema::dropIfExists('bmr_proceeds');
    }
};