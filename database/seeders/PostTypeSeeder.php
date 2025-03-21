<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipo_post')->delete();

        DB::table('tipo_post')->
        insert([
            ['id' => '1', 'nome' => 'Material'],
            ['id' => '2', 'nome' => 'Pergunta'],
            ['id' => '3', 'nome' => 'Genérico'],
            ['id' => '4', 'nome' => 'Comentário'],
        ]);
    }
}
