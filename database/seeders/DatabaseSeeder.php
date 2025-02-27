<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    User::factory()->create([
      'name' => 'Administrator',
      'email' => 'admin@atmajaya.ac.id',
      'identifier' => '10000000000',
      'role' => 'admin',
    ]);

    User::factory()->create([
      'name' => 'Birgitta Azlia Pohan',
      'email' => '12023001293@atmajaya.ac.id',
      'identifier' => '12023001293',
    ]);

    User::factory()->count(20)->create();

    $courses = [
      'Pendidikan Agama' => 2,
      'Multikulturalisme' => 2,
      'Kewarganegaraan' => 2,
      'Pancasila' => 2,
      'Ilmu Negara' => 2,
      'Antropologi' => 2,
      'Pengantar Hukum Indonesia' => 3,
      'Pengantar Ilmu Hukum' => 3,
      'Hukum Pidana' => 3,
      'Logika' => 3,
      'Hukum Adat' => 3,
      'Sosiologi' => 3,
      'Hukum Islam' => 3,
      'Pengantar Ilmu Ekonomi' => 3,
      'Hukum Media' => 3,
      'Hukum Perdata' => 3,
      'Hukum Hak Asasi Manusia' => 3,
      'Bahasa Inggris Hukum' => 3,
      'Hukum Tata Negara' => 3,
      'Hukum Internasional' => 3,
      'Bahasa Hukum Indonesia' => 3,
      'Hukum Perkawinan' => 3,
      'Hukum Ketenagakerjaan' => 3,
      'Hukum Acara Perdata' => 3,
      'Hukum Acara Pidana' => 3,
      'Etika Profesi' => 3,
    ];

    $classes = ['A', 'B', 'C', 'D'];

    foreach ($courses as $course => $credit) {

      foreach ($classes as $section) {
        Course::factory()->create([
          'description' => $course,
          'section' => $section,
          'credit' => $credit,
        ]);
      }
    }
  }
}
