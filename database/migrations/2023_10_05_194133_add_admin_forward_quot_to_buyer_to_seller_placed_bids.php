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
            $table->string('admin_forward_quot_to_buyer')->default(0)->after('admin_margin');
            
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
