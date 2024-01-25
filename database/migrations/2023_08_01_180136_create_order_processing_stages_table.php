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
        Schema::create('order_processing_stages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('logisticorder_id');
            $table->foreign('logisticorder_id')->references('id')->on('logistic_orders');

            $table->string('is_purchase_confirm',1)->default(0);    // *1 => confirm , 0 => not confirm
            $table->string('is_purchase_cancel',1)->default(0);     // *1 => cancel , 0 => not cancel
            $table->string('is_sale_confirm',1)->default(0);        // *1 => confirm , 0 => not confirm
            $table->string('is_sale_cancel',1)->default(0);         // *1 => cancel , 0 => not cancel

            $table->string('is_active',1)->default(1); // *1 => active , 0 => in active
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
        Schema::dropIfExists('order_processing_stages');
    }
};
