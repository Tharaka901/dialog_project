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
        Schema::create('addtional_credit', function (Blueprint $table) {
            $table->id();
            $table->integer('additional_id')->default(0);
            $table->string('credit_customer_name',100)->nullable();
            $table->string('edited_credit_customer_name',100)->nullable();
            $table->double('credit_amount')->default(0);
            $table->double('edited_credit_amount')->default(0);
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
        Schema::dropIfExists('addtional_credit');
    }
};
