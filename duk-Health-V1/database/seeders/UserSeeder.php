<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Luis Eduardo Gomez Valencia',
            'cargo' => 'Desarrollador',
            'telefono' => '3013716660',
            'email' => 'duk000@hotmail.com',
            'password' => Hash::make('Cambiam3'),
        ])->assignRole('Dev');

        User::create([
            'name' => 'Luisa Fernanda Varela Valencia',
            'cargo' => 'Administrador',
            'telefono' => '3013716661',
            'email' => 'luisa.varela@healthsoft.com.co',
            'password' => Hash::make('Cambiam3'),
        ])->assignRole('Admin');

        User::create([
            'name' => 'Paola Calderon',
            'cargo' => 'Administrador',
            'telefono' => '3013716661',
            'email' => 'paola.calderon@healthsoft.com.co',
            'password' => Hash::make('Cambiam3'),
        ])->assignRole('Admin');

        User::create([
            'name' => 'Juan Lopez',
            'cargo' => 'Administrador',
            'telefono' => '3013716661',
            'email' => 'juan.lopez@healthsoft.com.co',
            'password' => Hash::make('Cambiam3'),
        ])->assignRole('Admin');

        User::create([
            'name' => 'Johan Suaza',
            'cargo' => 'Administrador',
            'telefono' => '3013716661',
            'email' => 'johan.suaza@healthsoft.com.co',
            'password' => Hash::make('Cambiam3'),
        ])->assignRole('Admin');

        User::create([
            'name' => 'Jenny Alejandra Gomez',
            'cargo' => 'Administrador',
            'telefono' => '3013716661',
            'email' => 'jenny.gomez@healthsoft.com.co',
            'password' => Hash::make('Cambiam3'),
        ])->assignRole('Admin');

        User::create([
            'name' => 'Desarrollador',
            'cargo' => 'Desarrollador',
            'telefono' => '3013716661',
            'email' => 'desarrollador@healthsoft.com.co',
            'password' => Hash::make('Cambiam3'),
        ])->assignRole('Cliente');
    }
}
