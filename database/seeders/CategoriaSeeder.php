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
            ['id' => '1', 'nome' => 'Mobile', 'descricao' => 'Android, Kotlin, IOS, etc.', 'exclusivoForum'=> '0'],
            ['id' => '2', 'nome' => 'Programação', 'descricao' => 'Algoritmia, POO, Design Patterns, etc.', 'exclusivoForum'=> '0'],
            ['id' => '3', 'nome' => 'Front-end', 'descricao' => 'HTML, CSS, etc.', 'exclusivoForum'=> '0'],
            ['id' => '4', 'nome' => 'DevOps', 'descricao' => '...', 'exclusivoForum'=> '0'],
            ['id' => '5', 'nome' => 'UX & Design', 'descricao' => 'Arte, 3D, VFX, etc.', 'exclusivoForum'=> '0'],
            ['id' => '6', 'nome' => 'Data Science', 'descricao' => 'SQL, Base de Dados, etc.', 'exclusivoForum'=> '0'],
            ['id' => '7', 'nome' => 'Inovação e Gestão', 'descricao' => 'Agile, etc.', 'exclusivoForum'=> '0'],
            ['id' => '8', 'nome' => 'Estágios e vagas de emprego', 'descricao' => 'Discussão e compartilhamento de informação sobre estágios e vagas de emprego', 'exclusivoForum'=> '1'],
            ['id' => '9', 'nome' => 'Conversa paralela', 'descricao' => 'Área para conversas', 'exclusivoForum'=> '1'],
        ]);
    }
}
