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
    Schema::create('semesters', function (Blueprint $table) {
      $table->id();
      $table->timestamps();
      $table->foreignId('user_id')->constrained()->onDelete('cascade');
      $table->foreignId('course_id')->constrained()->onDelete('cascade');
      $table->integer('semester');
      $table->integer('year');
      $table->decimal('cw1', 4, 3)->nullable();
      $table->decimal('cw2', 4, 3)->nullable();
      $table->decimal('cw3', 4, 3)->nullable();
      $table->decimal('cw4', 4, 3)->nullable();
      $table->decimal('midterm', 4, 3)->nullable();
      $table->decimal('final', 4, 3)->nullable();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('semesters');
  }
};
