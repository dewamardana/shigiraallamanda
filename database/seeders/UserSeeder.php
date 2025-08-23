<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            'nama' => 'I Dewa Made Mardana',
            'slug' => Str::slug('I Dewa Made Mardana'),
            'username' => 'dewa',
            'password' => bcrypt('password'), // default password
            'email' => 'dewamardana@gmail.com',
            'department' => 'Public Area Section',
            'nomor_telp' => '085777766655',
            'gender' => 'L',
            'foto' => null,
            'remember_token' => Str::random(10),
            'status' => 'Active',
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // Insert user ke tabel users
        $user = User::create($userData);

        // Ambil semua role
        $roles = Role::all();

        if ($roles->count() > 0) {
            // Pilih role random (1 atau 2 role)
            $randomRoles = 2;
            $user->roles()->attach($randomRoles);
        }
    }
}
