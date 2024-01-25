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
            $table->string('payment_issue_file')->after('ship_materialtrackingid')->nullable();
            $table->longtext('payment_issue_note')->after('payment_issue_file')->nullable();
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
