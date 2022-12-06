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
        Schema::create('pending_sum', function (Blueprint $table) {
           $table->id();
           $table->integer('dsr_id');
           $table->string('date');
           $table->double('inhand_sum')->default(0);
           $table->double('inhand_cash')->default(0);
           $table->double('inhand_cheque')->default(0);
           $table->double('sales_sum')->default(0);
           $table->double('credit_sum')->default(0);
           $table->double('credit_collection_sum')->default(0);
           $table->double('banking_sum')->default(0);
           $table->double('banking_sampath')->default(0);
           $table->double('banking_cargils')->default(0);
           $table->double('banking_peoples')->default(0);
           $table->double('banking_sampth_online')->default(0);
           $table->double('direct_banking_sum')->default(0);
           $table->double('direct_banking_sampath')->default(0);
           $table->double('direct_banking_cargils')->default(0);
           $table->double('direct_banking_peoples')->default(0);
           $table->double('direct_banking_sampth_online')->default(0);
           $table->double('retialer_sum')->default(0);
           $table->integer('user_id')->default(0);
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
        Schema::dropIfExists('pending_sum');
    }
};