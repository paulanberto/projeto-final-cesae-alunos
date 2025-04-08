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
            ['id' => '1', 'nome' => 'Professor'],
            ['id' => '2', 'nome' => 'Software Developer'],
            ['id' => '3', 'nome' => 'Data Analyst'],
            ['id' => '4', 'nome' => 'Front End Developer'],
            ['id' => '5', 'nome' => 'Administração de Sistemas Windows'],
            ['id' => '6', 'nome' => 'Marketing Humanizado no Digital'],
            ['id' => '7', 'nome' => 'Criação Páginas Web - Scripts'],
            ['id' => '8', 'nome' => 'Canva do Zero ao Avançado com IA'],
            ['id' => '9', 'nome' => 'AWS RE/START - Cloud Computing and Network Administration'],
            ['id' => '10', 'nome' => 'Linux OS and Network Essentials'],
            ['id' => '11', 'nome' => 'DevOps: Automação e Integração Contínua'],
            ['id' => '12', 'nome' => 'Técnico de Desenho Digital 3D'],
            ['id' => '13', 'nome' => 'Prototipagem de websites em Figma'],
            ['id' => '14', 'nome' => 'Creative Digital Media - GAMES EDITION'],
            ['id' => '15', 'nome' => 'Administração de Sistemas Linux'],
            ['id' => '16', 'nome' => 'Inteligência Artificial em Contexto Empresarial'],
            ['id' => '17', 'nome' => 'Gestor/Coordenador da Formação'],
            ['id' => '18', 'nome' => 'UI/UX Development'],
            ['id' => '19', 'nome' => 'Formador + Digital'],
            ['id' => '20', 'nome' => 'Técnico/a de Comunicação - Marketing, Relações Públicas e Publicidade'],
            ['id' => '21', 'nome' => 'Técnico de Multimédia'],
            ['id' => '22', 'nome' => 'Digital Marketing & Business Strategy'],
            ['id' => '23', 'nome' => 'Técnico/a Especialista em Aplicações Informáticas de Gestão'],
            ['id' => '24', 'nome' => 'Dados e Videos: Estratégias com GA4 e YouTube'],
            ['id' => '25', 'nome' => 'Modelação Paramétrica para Arquitetura'],
            ['id' => '26', 'nome' => 'Power BI: Data Visualization'],
            ['id' => '27', 'nome' => 'Gestão da presença Empresarial nas Redes Sociais'],
            ['id' => '28', 'nome' => 'Websites & ECommerce'],
            ['id' => '29', 'nome' => 'Introdução e simulação em CAD'],
            ['id' => '30', 'nome' => 'Técnico/a Comunicação e Serviço Digital'],
            ['id' => '31', 'nome' => 'Marketing Digital: Meios, Conteúdos e Estratégias'],
        ]);
    }
}
