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
        Schema::create('latihan_questions', function (Blueprint $table) {
            $table->id();
            $table->integer('latihan_id');
            $table->integer('group_type_id')->nullable();
            $table->mediumText('question');
            $table->mediumText('pembahasan')->nullable();
            $table->timestamps();
        });
        DB::statement("ALTER TABLE latihan_questions ADD question MEDIUMBLOB");
        DB::statement("ALTER TABLE latihan_questions ADD pembahasan MEDIUMBLOB NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('latihan_questions');
    }
};
