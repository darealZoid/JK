<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('users')->insert([
            'firstname' => 'Harth',
            'middlename' => 'Pama',
            'lastname' => 'Palaras',
            'contact_number' => '09185564553',
            'user_role_id' => '1',
            'status_id' => '1',
            'username' => 'Aceboy76',
            'password' => Hash::make('200315feb'),
            'user_image' => null,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'firstname' => 'Jade',
            'middlename' => 'Zoid',
            'lastname' => 'Agduma',
            'contact_number' => '09345678911',
            'user_role_id' => '1',
            'status_id' => '1',
            'username' => 'Zoid',
            'password' => Hash::make('iloveaiah'),
            'user_image' => null,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
         ]);


        }
}
