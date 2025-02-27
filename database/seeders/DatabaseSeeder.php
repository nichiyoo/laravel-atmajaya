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
            [
                'code' => 'UAJ 150',
                'description' => 'Pendidikan Agama',
                'credit' => 2,
                'section' => 'A',
            ],
            [
                'code' => 'UAJ 180',
                'description' => 'Multikulturalisme',
                'credit' => 2,
                'section' => 'A',
            ],
            [
                'code' => 'WAR 130',
                'description' => 'Kewarganegaraan',
                'credit' => 2,
                'section' => 'A',
            ],
            [
                'code' => 'PAN 100',
                'description' => 'Pancasila',
                'credit' => 2,
                'section' => 'A',
            ],
            [
                'code' => 'FHK 102',
                'description' => 'Ilmu Negara',
                'credit' => 2,
                'section' => 'A',
            ],
            [
                'code' => 'FHK 111',
                'description' => 'Antropologi',
                'credit' => 2,
                'section' => 'A',
            ],
            [
                'code' => 'FHK 113',
                'description' => 'Pengantar Hukum Indonesia',
                'credit' => 3,
                'section' => 'A',
            ],
            [
                'code' => 'FHK 115',
                'description' => 'Pengantar Ilmu Hukum',
                'credit' => 3,
                'section' => 'A',
            ],
            [
                'code' => 'FHK 203',
                'description' => 'Hukum Pidana',
                'credit' => 3,
                'section' => 'A',
            ],
            [
                'code' => 'UAJ 160',
                'description' => 'Logika',
                'credit' => 2,
                'section' => 'A',
            ],
            [
                'code' => 'FHK 108',
                'description' => 'Hukum Adat',
                'credit' => 2,
                'section' => 'A',
            ],
            [
                'code' => 'FHK 109',
                'description' => 'Sosiologi',
                'credit' => 2,
                'section' => 'A',
            ],
            [
                'code' => 'FHK 112',
                'description' => 'Hukum Islam',
                'credit' => 2,
                'section' => 'A',
            ],
            [
                'code' => 'FHK 103',
                'description' => 'Pengantar Ilmu Ekonomi',
                'credit' => 2,
                'section' => 'A',
            ],
            [
                'code' => 'FHP 322',
                'description' => 'Hukum Media',
                'credit' => 2,
                'section' => 'A',
            ],
            [
                'code' => 'FHK 201',
                'description' => 'Hukum Perdata',
                'credit' => 3,
                'section' => 'A',
            ],
            [
                'code' => 'FHK 118',
                'description' => 'Hukum Hak Asasi Manusia',
                'credit' => 2,
                'section' => 'A',
            ],
            [
                'code' => 'FHK 213',
                'description' => 'Bahasa Hukum Indonesia',
                'credit' => 2,
                'section' => 'A',
            ],
            [
                'code' => 'FHK 301',
                'description' => 'Hukum Acara Perdata',
                'credit' => 3,
                'section' => 'A',
            ],
            [
                'code' => 'FHK 205',
                'description' => 'Hukum Tata Negara',
                'credit' => 3,
                'section' => 'A',
            ],
            [
                'code' => 'FHK 404',
                'description' => 'Etika Profesi',
                'credit' => 2,
                'section' => 'A',
            ],
            [
                'code' => 'FHK 214',
                'description' => 'Hukum Perkawinan',
                'credit' => 2,
                'section' => 'A',
            ],
            [
                'code' => 'FHK 207',
                'description' => 'Hukum Internasional',
                'credit' => 3,
                'section' => 'A',
            ],
            [
                'code' => 'FHK 303',
                'description' => 'Hukum Acara Pidana',
                'credit' => 3,
                'section' => 'A',
            ],
            [
                'code' => 'FHK 104',
                'description' => 'Bahasa Inggris Hukum',
                'credit' => 2,
                'section' => 'A',
            ],
            [
                'code' => 'FHK 215',
                'description' => 'Hukum Ketenagakerjaan',
                'credit' => 3,
                'section' => 'A',
            ],
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}
