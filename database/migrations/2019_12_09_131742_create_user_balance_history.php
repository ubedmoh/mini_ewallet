<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserBalanceHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_balance_history', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_balance_id')->unsigned()->nullable();
            $table->foreign('user_balance_id')->references('id')->on('user_balance')->onDelete('set null');
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
        Schema::dropIfExists('user_balance_history');
    }
}
