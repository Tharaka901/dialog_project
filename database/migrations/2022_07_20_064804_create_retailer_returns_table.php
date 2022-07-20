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
        Schema::create('retailer_returns', function (Blueprint $table) {
            $table->id();
            $table->string('re_customer_name',100)->nullable();
            $table->integer('re_item_id');
            $table->double('re_item_qty')->default(0);
            $table->double('re_item_amount')->default(0);
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
        Schema::dropIfExists('retailer_returns');
    }
};
