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
        Schema::create('commercial_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('salemarketingorder_id');
            $table->foreign('salemarketingorder_id')->references('id')->on('sales_marketing_orders');
            $table->string('commercialperson_name');
            $table->unsignedBigInteger('buyer_id');
            $table->foreign('buyer_id')->references('id')->on('buyers');
            $table->unsignedBigInteger('seller_id');
            $table->foreign('seller_id')->references('id')->on('sellers');
            
            $table->string('productname');
            $table->string('price');
            $table->string('qty');
            $table->string('shipmentmode');
            $table->string('paymentterm');
            $table->string('origin');
            $table->string('materialavailability');
            $table->string('mfgname')->nullable();
            $table->string('commissiondecided');
            $table->string('supplierinstructions');
            $table->string('indentcustomer');
            $table->string('tosupplier');

            $table->string('is_active',1)->default(1); // *1 => active , 0 => in active
            $table->string('is_logistics_orderform_filled',1)->default(0);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
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
        Schema::dropIfExists('commercial_orders');
    }
};
