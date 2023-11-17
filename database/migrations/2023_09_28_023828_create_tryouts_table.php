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
        Schema::create('tryouts', function (Blueprint $table) {
            $table->id();
            $table->integer('material_type_id');
            $table->integer('group_id')->nullable();
            $table->string('roles')->nullable();
            $table->string('code')->unique();
            $table->string('name');
            $table->integer('time')->nullable();
            $table->string('description')->nullable();
            $table->boolean('is_event')->default(false);
            $table->boolean('active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tryouts');
    }
};
