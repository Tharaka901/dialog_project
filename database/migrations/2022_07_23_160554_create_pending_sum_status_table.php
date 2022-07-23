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
        Schema::create('pending_sum_status', function (Blueprint $table) {
           $table->id();
           $table->integer('dsr_id');
           $table->string('date');
           $table->integer('inhand_sum')->default(0);
           $table->integer('sales_sum')->default(0);
           $table->integer('credit_sum')->default(0);
           $table->integer('credit_collection_sum')->default(0);
           $table->integer('banking_sum')->default(0);
           $table->integer('direct_banking_sum')->default(0);
           $table->integer('retialer_sum')->default(0);
           $table->integer('status')->default(0);
           $table->timestamps();
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pending_sum_status');
    }
};
