<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBalanceBankHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balance_bank_history', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('balance_bank_id')->unsigned()->nullable();
            $table->foreign('balance_bank_id')->references('id')->on('balance_bank')->onDelete('set null');
            $table->integer('balance_before')->nullable();
            $table->integer('balance_after')->nullable();
            $table->string('activity')->nullable();
            $table->enum('type', ['credit', 'debit'])->default('credit');
            $table->string('ip')->nullable();
            $table->string('location')->nullable();
            $table->string('user_agent')->nullable();
            $table->string('author')->nullable();
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
        Schema::dropIfExists('balance_bank_history');
    }
}
