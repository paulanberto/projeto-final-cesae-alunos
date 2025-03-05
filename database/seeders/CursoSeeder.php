<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cursos')->delete();

        DB::table('cursos')->insert([
            ['id' => '1', 'nome' => 'Software Developer', 'edicao' => '2024'],
            ['id' => '2', 'nome' => 'Software Developer', 'edicao' => '2023'],
            ['id' => '3', 'nome' => 'Data Analyst', 'edicao' => '2024'],
            ['id' => '4', 'nome' => 'Front End Developer', 'edicao' => '2024'],
            ['id' => '5', 'nome' => 'Front End Developer', 'edicao' => '2023'],
        ]);
    }
}
