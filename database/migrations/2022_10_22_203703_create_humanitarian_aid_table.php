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
        Schema::create('humanitarian_aid', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('worker_id')->foreign()->references('id')->on('users')->nullable();
            $table->tinyInteger('provider_id')->foreign()->references('id')->on('aid_providers');
            $table->tinyInteger('request_id')->foreign()->references('id')->on('requests')->nullable();
            $table->decimal('price', 10, 2);
            $table->mediumText('description')->nullable();
            $table->string('aid_type')->nullable();
            $table->string('status');
            $table->decimal('received_by_us_at')->nullable();
            $table->decimal('received_by_refugee_at')->nullable();
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
        Schema::dropIfExists('humanitarian_aid');
    }
};
