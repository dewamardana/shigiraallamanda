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
        $users = [
            [
                'nama' => 'Dewi Anggraini',
                'slug' => Str::slug('Dewi Anggraini'),
                'username' => 'dewi',
                'password' => bcrypt('password'), // default password
                'email' => 'dewi@gmail.com',
                'department' => 'Public Area Section',
                'nomor_telp' => '081234567890',
                'gender' => 'P',
                'foto' => null,
                'remember_token' => Str::random(10),
                'status' => 'Active',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Rizky Pratama',
                'slug' => Str::slug('Rizky Pratama'),
                'username' => 'risky',
                'password' => bcrypt('password'), // default password
                'email' => 'rizky@gmail.com',
                'department' => 'Room Section',
                'nomor_telp' => '081298765432',
                'gender' => 'L',
                'foto' => null,
                'remember_token' => Str::random(10),
                'status' => 'Active',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Putri Wulandari',
                'slug' => Str::slug('Putri Wulandari'),
                'username' => 'putri',
                'password' => bcrypt('password'), // default password
                'email' => 'putri@gmail.com',
                'department' => 'Laundry Section',
                'nomor_telp' => '081367845210',
                'gender' => 'P',
                'foto' => null,
                'remember_token' => Str::random(10),
                'status' => 'Active',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Bagas Saputra',
                'slug' => Str::slug('Bagas Saputra'),
                'username' => 'bagas',
                'password' => bcrypt('password'), // default password
                'email' => 'bagas@gmail.com',
                'department' => 'Linen Section',
                'nomor_telp' => '085743216789',
                'gender' => 'L',
                'foto' => null,
                'remember_token' => Str::random(10),
                'status' => 'Active',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Sinta Ramadhani',
                'slug' => Str::slug('Sinta Ramadhani'),
                'username' => 'shinta',
                'password' => bcrypt('password'), // default password
                'email' => 'sinta@gmail.com',
                'department' => 'Florist dan Gardener',
                'nomor_telp' => '081255512345',
                'gender' => 'P',
                'foto' => null,
                'remember_token' => Str::random(10),
                'status' => 'Active',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Fajar Hidayat',
                'slug' => Str::slug('Fajar Hidayat'),
                'username' => 'fajar',
                'password' => bcrypt('password'), // default password
                'email' => 'fajar@gmail.com',
                'department' => 'Houseman/Housemaid',
                'nomor_telp' => '085733322210',
                'gender' => 'L',
                'foto' => null,
                'remember_token' => Str::random(10),
                'status' => 'Active',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Ayu Lestari',
                'slug' => Str::slug('Ayu Lestari'),
                'username' => 'ayu',
                'password' => bcrypt('password'), // default password
                'email' => 'ayu@gmail.com',
                'department' => 'Public Area Section',
                'nomor_telp' => '082144332255',
                'gender' => 'P',
                'foto' => null,
                'remember_token' => Str::random(10),
                'status' => 'Active',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Yudha Kurniawan',
                'slug' => Str::slug('Yudha Kurniawan'),
                'username' => 'yudha',
                'password' => bcrypt('password'), // default password
                'email' => 'yudha@gmail.com',
                'department' => 'Room Section',
                'nomor_telp' => '085643214789',
                'gender' => 'L',
                'foto' => null,
                'remember_token' => Str::random(10),
                'status' => 'Active',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Nina Rahmawati',
                'slug' => Str::slug('Nina Rahmawati'),
                'username' => 'nina',
                'password' => bcrypt('password'), // default password
                'email' => 'nina@gmail.com',
                'department' => 'Room Section',
                'nomor_telp' => '081388899900',
                'gender' => 'P',
                'foto' => null,
                'remember_token' => Str::random(10),
                'status' => 'Active',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Dimas Aditya',
                'slug' => Str::slug('Dimas Aditya'),
                'username' => 'dimas',
                'password' => bcrypt('password'), // default password
                'email' => 'dimas@gmail.com',
                'department' => 'Linen Section',
                'nomor_telp' => '085777766655',
                'gender' => 'L',
                'foto' => null,
                'remember_token' => Str::random(10),
                'status' => 'Active',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
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
                'updated_at' => now()
            ],
        ];

        $role = Role::all();
        foreach($users as $user){
            
        }



        DB::table('users')->insert($users);
        
        // Ambil semua role yang ada
        $roles = Role::all();

        // Assign role secara random untuk setiap user
        User::all()->each(function ($user) use ($roles) {
            // Pilih 1 sampai 2 role random
            $randomRoles = $roles->random(rand(1, 2))->pluck('id')->toArray();
            $user->roles()->attach($randomRoles);
        });
    }
}
