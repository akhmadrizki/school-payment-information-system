<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'id' => 1,
                'username' => 'master',
                'name' => 'master',
                'email' => 'master@skand.com',
                'role_id' => 1,
                'password' => Hash::make('master123#'),
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'id' => 2,
                'username' => 'admin',
                'name' => 'admin',
                'email' => 'admin@skand.com',
                'role_id' => 2,
                'password' => Hash::make('admin123#'),
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'id' => 3,
                'username' => '6381',
                'name' => 'Akhmad Rizki Prayoga',
                'email' => 'akhmadrizki24@gmail.com',
                'role_id' => 3,
                'password' => Hash::make('6381'),
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'id' => 4,
                'username' => '9689',
                'name' => 'Ayu Dhiva Purnamasari',
                'email' => 'ayudiva@gmail.com',
                'role_id' => 3,
                'password' => Hash::make('9689'),
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'id' => 5,
                'username' => '9575',
                'name' => 'Tubagus Arya Bimantara',
                'email' => 'bimantara@gmail.com',
                'role_id' => 3,
                'password' => Hash::make('9575'),
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'id' => 6,
                'username' => '9561',
                'name' => 'Arvita Dea Amanda',
                'email' => 'arvita@gmail.com',
                'role_id' => 3,
                'password' => Hash::make('9561'),
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'id' => 7,
                'username' => '9690',
                'name' => 'Dian Widyatari',
                'email' => 'dian@gmail.com',
                'role_id' => 3,
                'password' => Hash::make('9690'),
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
        ]);
    }
}
