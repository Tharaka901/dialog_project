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
        Schema::create('credit_collections', function (Blueprint $table) {
            $table->id();
            $table->string('credit_collection_customer_name',100)->nullable();
            $table->double('credit_collection_amount')->default(0);
            $table->integer('sum_id');
            $table->integer('dsr_id')->default(0);
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('credit_collections');
    }
};
