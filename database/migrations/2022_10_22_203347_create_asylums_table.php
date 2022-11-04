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
        Schema::create('asylums', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->string('city');
            $table->string('name');
            $table->mediumText('description')->nullable();
            $table->integer('available_places')->nullable();
            $table->boolean('allow_pets')->nullable();
            $table->boolean('provide_food')->nullable();
            $table->boolean('medical_support')->nullable();
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
        Schema::dropIfExists('asylums');
    }
};
