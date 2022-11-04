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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('refugee_id')->foreign()->references('id')->on('users');
            $table->tinyInteger('worker_id')->foreign()->references('id')->on('users');
            $table->string('type', 50);
            $table->string('title');
            $table->string('status');
            $table->mediumText('description')->nullable();
            $table->integer('number_of_people')->nullable();
            $table->boolean('with_pets')->nullable();
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
        Schema::dropIfExists('requests');
    }
};
