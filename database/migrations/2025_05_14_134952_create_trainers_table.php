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
        Schema::create('trainers', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->id();
            $table->string('phone')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('specialty')->nullable(); // es: cardio, pesi, yoga
            $table->text('bio')->nullable();
            $table->string('certifications')->nullable();
            $table->integer('years_experience')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainers');
    }
};
