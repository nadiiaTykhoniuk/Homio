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
        Schema::create('aid_providers', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('contact_person_id')->foreign()->references('id')->on('users');
            $table->string('company_name');
            $table->mediumText('company_description')->nullable();
            $table->string('address')->nullable();
            $table->string('phone', 15);
            $table->string('email')->nullable();
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
        Schema::dropIfExists('aid_providers');
    }
};
