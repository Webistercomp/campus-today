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
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->integer('event_try_out_id');
            $table->integer('user_id');
            $table->integer('score1')->nullable();
            $table->integer('score2')->nullable();
            $table->integer('score3')->nullable();
            $table->integer('final_score')->nullable();
            $table->enum('status', ['lulus', 'tidak_lulus'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
