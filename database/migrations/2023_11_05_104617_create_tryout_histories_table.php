<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tryout_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('tryout_id');
            $table->timestamp('start_timestamp')->nullable();
            $table->timestamp('finish_timestamp')->nullable();
            $table->integer('score')->default(0);
            $table->json('answers')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tryout_histories');
    }
};
