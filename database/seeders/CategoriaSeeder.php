<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categorias')->delete();

        DB::table('categorias')->insert([
            ['id' => '1', 'nome' => 'Mobile', 'descricao' => 'Android, Kotlin, IOS, etc.'],
            ['id' => '2', 'nome' => 'Programação', 'descricao' => 'Algoritmia, POO, Design Patterns, etc.'],
            ['id' => '3', 'nome' => 'Front-end', 'descricao' => 'HTML, CSS, etc.'],
            ['id' => '4', 'nome' => 'DevOps', 'descricao' => '...'],
            ['id' => '5', 'nome' => 'UX & Design', 'descricao' => 'Arte, 3D, VFX, etc.'],
            ['id' => '6', 'nome' => 'Data Science', 'descricao' => 'SQL, Base de Dados, etc.'],
            ['id' => '7', 'nome' => 'Inovação e Gestão', 'descricao' => 'Agile, etc.']
        ]);
    }
}
