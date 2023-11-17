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
        Schema::create('packet_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('packet_id');
            $table->integer('user_id');
            $table->string('payment_method')->nullable();
            $table->string('bukti_pembayaran')->nullable();
            $table->enum('status', ['pending', 'verification', 'success', 'failed'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packet_histories');
    }
};
