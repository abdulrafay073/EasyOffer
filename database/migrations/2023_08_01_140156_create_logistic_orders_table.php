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
        Schema::create('logistic_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('commercialorder_id');
            $table->foreign('commercialorder_id')->references('id')->on('commercial_orders');
            
            $table->string('instruction_from_customer')->nullable();
            $table->string('instruction_from_supplier')->nullable();
            $table->string('remarks')->nullable();
            $table->string('indent_sendto_customer')->nullable();
            $table->string('indent_sendto_supplier')->nullable();
            $table->string('sc_required')->nullable();
            $table->string('ca_required')->nullable();
            $table->string('reason')->nullable();
            $table->string('customer_contactperson')->nullable();
            $table->string('supplier_contactperson')->nullable();

            $table->string('is_active',1)->default(1); // *1 => active , 0 => in active
            $table->string('is_ready_for_orderprocessing',1)->default(0);
            $table->string('order_processing_cancel',1)->default(0);
            $table->string('order_processing_cancelreason')->nullable();
            $table->string('status')->default('Order Confirmed');
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
        Schema::dropIfExists('logistic_orders');
    }
};
