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
            $table->string('lc_issue_file')->after('is_sale_cancel')->nullable();
            $table->longtext('lc_issue_note')->after('lc_issue_file')->nullable();
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
