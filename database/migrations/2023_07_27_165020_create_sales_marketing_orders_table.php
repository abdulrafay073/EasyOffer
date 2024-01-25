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
        Schema::create('sales_marketing_orders', function (Blueprint $table) {
            $table->id();
            $table->string('marketingperson_name');
            $table->unsignedBigInteger('buyer_id');
            $table->foreign('buyer_id')->references('id')->on('buyers');
            $table->unsignedBigInteger('seller_id');
            $table->foreign('seller_id')->references('id')->on('sellers');
            
            $table->string('productname');
            $table->string('price');
            $table->string('qty');
            $table->string('paymentterm');
            $table->string('mfgname')->nullable();
            $table->string('shipmentmode');
            $table->string('shipmentintimation');
            $table->string('pssrequirement');
            $table->string('shipmentrequirement');
            $table->string('customershipmenttime');
            $table->string('lcdate');
            $table->string('indentcustomer');
            $table->string('tosupplier');

            $table->boolean('preshipmentcoa', 1)->default(0);
            $table->boolean('shipmentafteradc', 1)->default(0);
            $table->boolean('dml', 1)->default(0);
            $table->boolean('preshipmentdocs', 1)->default(0);
            $table->boolean('lables', 1)->default(0);
            $table->boolean('gmp', 1)->default(0);
            $table->boolean('certifictes', 1)->default(0);
            $table->boolean('imagebeforeshipment', 1)->default(0);
            $table->boolean('moa', 1)->default(0);
            $table->boolean('preinformcharges', 1)->default(0);
            $table->boolean('stability', 1)->default(0);
            $table->boolean('safta', 1)->default(0);
            $table->boolean('materialavailability', 1)->default(0);
            $table->boolean('dmf', 1)->default(0);

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
        Schema::dropIfExists('sales_marketing_orders');
    }
};
