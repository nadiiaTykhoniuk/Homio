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
        Schema::create('category_review', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('category_id')->foreign()->references('id')->on('categories');
            $table->tinyInteger('review_id')->foreign()->references('id')->on('reviews');
            $table->integer('star');
            $table->mediumText('user_experience')->nullable();
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
        Schema::dropIfExists('category_review');
    }
};
