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
        Schema::create('userfiles', function (Blueprint $table) {
            $table->id();
            //$table->unsignedInteger('user_id');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // this will set user_id as a foreign key form id in table users
            $table->string('path');
            $table->boolean('is_processed')->default(false);
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
        Schema::dropIfExists('userfiles');
    }
};
