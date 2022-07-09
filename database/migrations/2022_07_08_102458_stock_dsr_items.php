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
        Schema::create('stock_dsr_items', function (Blueprint $table) {
            $table->id();
            $table->integer("item_id");
            $table->double("qty")->default(0);
            $table->double("stock_dsr_id");
            $table->integer("status")->default("1");
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
        Schema::dropIfExists('stock_dsr_items');
    }
};
