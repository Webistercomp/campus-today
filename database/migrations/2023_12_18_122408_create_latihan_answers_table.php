<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('latihan_answers', function (Blueprint $table) {
            $table->id();
            $table->integer('latihan_question_id');
            $table->integer('bobot');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE latihan_answers ADD answer MEDIUMBLOB");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('latihan_answers');
    }
};
