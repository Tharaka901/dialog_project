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
        Schema::create('drs_cheques', function (Blueprint $table) {
           $table->id();
           $table->integer('sum_id');
           $table->integer('dsrs_id');
           $table->string('cheque_no',30);
           $table->double('cheque_amount')->default(0);
           $table->integer('status')->default(1);
           $table->timestamp('created_at')->useCurrent();
           $table->timestamp('updated_at')->nullable();
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drs_cheques');
    }
};
