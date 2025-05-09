<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tags')->delete();

        DB::table('tags')->insert([
            ['nome' => 'Android', 'id' => '1'],
            ['nome' => 'IOS', 'id' => '2'],
            ['nome' => 'Algoritmia', 'id' => '3'],
            ['nome' => 'Quality Assurance', 'id' => '4'],
            ['nome' => 'JavaScript', 'id' => '5'],
            ['nome' => 'Laravel', 'id' => '6'],
            ['nome' => 'HTML', 'id' => '7'],
            ['nome' => 'CSS', 'id' => '8'],
            ['nome' => 'POO', 'id' => '9'],
            ['nome' => 'PHP', 'id' => '10'],
            ['nome' => 'Base de Dados', 'id' => '11'],
            ['nome' => 'SQL', 'id' => '12'],
            ['nome' => 'Engenharia de Software', 'id' => '13'],
            ['nome' => 'Design Patterns', 'id' => '14'],
            ['nome' => 'React', 'id' => '15'],
            ['nome' => 'WordPress', 'id' => '16'],
            ['nome' => 'JUnit', 'id' => '17'],
            ['nome' => 'Java', 'id' => '18'],
            ['nome' => 'Swift', 'id' => '19'],
            ['nome' => 'Kotlin', 'id' => '20'],
            ['nome' => 'XML', 'id' => '21'],
            ['nome' => 'UML', 'id' => '22'],
        ]);
    }
}
