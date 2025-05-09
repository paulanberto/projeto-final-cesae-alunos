<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->delete();

        DB::table('users')->insert([[
            'name' => 'Bruno Santos',
            'email' => 'admin@msft.cesae.pt',
            'password' => Hash::make('admin@msft.cesae.pt'),
            'user_type' => '2',
            'email_verified_at' => '2025-04-04 09:23:46',
            'curso_id' => '1',
            'ano' => null,
        ],
        [
            'name' => 'Sara Monteiro',
            'email' => 'moderador@msft.cesae.pt',
            'password' => Hash::make('moderador@msft.cesae.pt'),
            'user_type' => '1',
            'email_verified_at' => '2025-04-04 09:23:46',
            'curso_id' => '1',
            'ano' => null,
        ],
        [
            'name' => 'Bruno Balmant',
            'email' => 'bruno.pessamilio.prt_a@msft.cesae.pt',
            'password' => Hash::make('@pass1234'),
            'user_type' => '2',
            'email_verified_at' => '2025-04-04 09:23:46',
            'curso_id' => '2',
            'ano' => '2024',
        ],
        [
            'name' => 'Guilherme Carasek',
            'email' => 'guilherme.carasek.prt_a@msft.cesae.pt',
            'password' => Hash::make('gkaras'),
            'user_type' => '2',
            'email_verified_at' => '2025-04-04 09:23:46',
            'curso_id' => '2',
            'ano' => '2024',
        ],
        [
            'name' => 'Filipe Costa',
            'email' => 'carlos.costa.prt_a@msft.cesae.pt',
            'password' => Hash::make('@pas1234'),
            'user_type' => '2',
            'email_verified_at' => '2025-04-04 09:23:46',
            'curso_id' => '2',
            'ano' => '2024',
        ],
    ]);
    }
}
