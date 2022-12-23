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
        Schema::create('adminfiles', function (Blueprint $table) {
            $table->id();
            //$table->unsignedInteger('user_id');
           // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
           $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // this will set user_id as a foreign key form id in table users
            $table->string('path');
            $table->boolean('is_processed')->default(false);
            $table->boolean('is_excel')->default(false);
            $table->boolean('is_schedule')->default(false);
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
        Schema::dropIfExists('adminfiles');
    }
};
