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
        Schema::create('matters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('assign_to')->nullable();
            $table->string('product_name')->nullable();
            $table->string('problem')->nullable();
            $table->string('problem_rated')->nullable();
            $table->string('status')->nullable();
            $table->string('solution')->nullable();
            $table->longtext('boss_feedback')->nullable();
            $table->string('manager_approval')->nullable();
            $table->string('resolve_time')->nullable();
            $table->string('issue_related')->nullable();
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
        Schema::dropIfExists('matters');
    }
};
