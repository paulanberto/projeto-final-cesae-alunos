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
        ],
        [
            'name' => 'Sara Monteiro',
            'email' => 'moderador@msft.cesae.pt',
            'password' => Hash::make('moderador@msft.cesae.pt'),
            'user_type' => '1',
            'email_verified_at' => '2025-04-04 09:23:46',
        ]]);
    }
}
