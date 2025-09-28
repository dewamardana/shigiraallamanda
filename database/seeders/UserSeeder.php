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
        $userList = [
            [
                'nama' => 'I Dewa Made Mardana',
                'username' => 'dewa',
                'email' => 'dewamardana@gmail.com',
            ],
            [
                'nama' => 'Komang Adi Putra',
                'username' => 'komang',
                'email' => 'komang@gmail.com',
            ],
            [
                'nama' => 'Nyoman Gede',
                'username' => 'nyoman',
                'email' => 'nyoman@gmail.com',
            ],
            [
                'nama' => 'Ketut Sudiarta',
                'username' => 'ketut',
                'email' => 'ketut@gmail.com',
            ],
            [
                'nama' => 'Made Putri Ayu',
                'username' => 'putri',
                'email' => 'putri@gmail.com',
            ],
            [
                'nama' => 'Wayan Arta',
                'username' => 'wayan',
                'email' => 'wayan@gmail.com',
            ],
            [
                'nama' => 'Kadek Budi',
                'username' => 'kadek',
                'email' => 'kadek@gmail.com',
            ],
            [
                'nama' => 'Gusti Ayu',
                'username' => 'gusti',
                'email' => 'gusti@gmail.com',
            ],
            [
                'nama' => 'Putu Eka',
                'username' => 'putu',
                'email' => 'putu@gmail.com',
            ],
            [
                'nama' => 'Ketut Rai',
                'username' => 'rai',
                'email' => 'rai@gmail.com',
            ],
        ];

        foreach ($userList as $data) {
            $userData = [
                'nama' => $data['nama'],
                'slug' => Str::slug($data['nama']),
                'username' => $data['username'],
                'password' => bcrypt('password'), // default password
                'email' => $data['email'],
                'department' => 'Public Area Section',
                'nomor_telp' => '08' . rand(1000000000, 9999999999),
                'gender' => rand(0, 1) ? 'L' : 'P',
                'foto' => null,
                'remember_token' => Str::random(10),
                'status' => 'Active',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $user = User::create($userData);

            // Assign role
            $roles = Role::all();
            if ($roles->count() > 0) {
                // Misalnya selalu assign role id = 2 (user biasa)
                $user->roles()->attach(2);
            }
        }
    }
}
