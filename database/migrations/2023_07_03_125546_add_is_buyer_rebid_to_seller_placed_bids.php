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
        Schema::table('seller_placed_bids', function (Blueprint $table) {
            $table->string('is_buyer_rebid', 1)->default(0)->after('is_buyer_accept');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('seller_placed_bids', function (Blueprint $table) {
            //
        });
    }
};