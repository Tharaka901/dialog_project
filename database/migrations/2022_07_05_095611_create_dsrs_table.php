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
        Schema::create('dsrs', function (Blueprint $table) {
            $table->id();
            $table->double('in_hand')->default(0);
            $table->double('cash')->default(0);
            $table->double('cheque')->default(0);
            $table->integer('dsr_user_id');
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
        Schema::dropIfExists('dsrs');
    }
};
