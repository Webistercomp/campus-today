<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('minat_bakats', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('desc');
            $table->enum('type', ['tav', 'epps', 'mtk']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('minat_bakats');
    }
};
