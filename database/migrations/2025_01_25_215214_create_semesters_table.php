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
      $table->integer('cw1')->nullable();
      $table->integer('cw2')->nullable();
      $table->integer('cw3')->nullable();
      $table->integer('cw4')->nullable();
      $table->integer('midterm')->nullable();
      $table->integer('final')->nullable();
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
