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
        Schema::table('order_processing_stages', function (Blueprint $table) {
            $table->string('ship_invoice_file')->after('lc_issue_note')->nullable();
            $table->string('ship_packing_file')->after('ship_invoice_file')->nullable();
            $table->string('ship_coa_file')->after('ship_packing_file')->nullable();
            $table->string('ship_bl_file')->after('ship_coa_file')->nullable();
            $table->string('ship_awb_file')->after('ship_bl_file')->nullable();
            $table->string('ship_fta_file')->after('ship_awb_file')->nullable();
            $table->string('ship_gmp_file')->after('ship_fta_file')->nullable();
            $table->string('ship_form3_file')->after('ship_gmp_file')->nullable();
            $table->string('ship_form7_file')->after('ship_form3_file')->nullable();
            $table->string('ship_trackingid')->after('ship_form7_file')->nullable();
            $table->string('ship_materialtrackingid')->after('ship_trackingid')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_processing_stages', function (Blueprint $table) {
            //
        });
    }
};
