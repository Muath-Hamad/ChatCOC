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
        Schema::create('chat_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable(); // since we want to allow guest to use the chatbot user_id should be nullable ..
                                                      //i chose not to add ->constrained()->cascadeOnDelete() since the purpose is to keep logs of requests
            $table->string('ur_content'); // keeps the user request content -- cant be null
            $table->string('cr_content')->nullable(); // keeps the chatbot response content -- can be null
            $table->boolean('is_successful')->default(false);

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
        Schema::dropIfExists('chat_requests');
    }
};
