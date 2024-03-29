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
        Schema::create('directbankings', function (Blueprint $table) {
            $table->id();
            $table->string('direct_bank_customer_name',100)->nullable();
            $table->string('direct_bank_name',100)->nullable();
            $table->string('direct_bank_ref_no',100)->nullable();
            $table->double('direct_bank_amount')->default(0);
            $table->integer('dsr_id')->default(0);
            $table->integer('sum_id')->default(0);
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
        Schema::dropIfExists('directbankings');
    }
};
