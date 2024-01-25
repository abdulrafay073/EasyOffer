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
        Schema::create('buyer_make_request_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('makerequest_id');
            $table->foreign('makerequest_id')->references('id')->on('buyer_make_requests');
            $table->string('customer_name',150);
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('buyer_listings');
            $table->string('qty');
            $table->string('shipping_method');
            $table->string('payment_method');
            $table->string('origin');
            $table->string('required');
            $table->longtext('description');
            $table->longtext('certification');
            $table->boolean('sample_or_real', 1);
            $table->string('price');
            $table->string('timeduration');
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
        Schema::dropIfExists('buyer_make_request_details');
    }
};