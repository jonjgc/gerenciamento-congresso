<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(30)->create();

        DB::table('users')->insert([
            [
                'name' => 'Jônatas Admin',
                'role_id' => Role::ADMIN,
                'email' => 'admin@mail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123'),
            ],
            [
                'name' => 'Jônatas Participante',
                'role_id' => Role::PARTICIPANTE,
                'email' => 'participante@mail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123'),
            ], [
                'name' => 'Jônatas Editor',
                'role_id' => Role::EDITOR,
                'email' => 'editor@mail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123'),
            ], [
                'name' => 'Jônatas Corretor',
                'role_id' => Role::CORRETOR,
                'email' => 'corretor@mail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123'),
            ]
        ]);
    }
}
