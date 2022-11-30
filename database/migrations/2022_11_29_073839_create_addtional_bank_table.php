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
        Schema::create('addtional_bank', function (Blueprint $table) {
           $table->id();
           $table->integer('additional_id')->default(0);
           $table->string('bank_name',100)->nullable();
           $table->string('bank_ref_no',100)->nullable();
           $table->string('edited_bank_ref_no',100)->nullable();
           $table->double('bank_amount')->default(0);
           $table->double('edited_bank_amount')->default(0);
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
        Schema::dropIfExists('addtional_bank');
    }
};
