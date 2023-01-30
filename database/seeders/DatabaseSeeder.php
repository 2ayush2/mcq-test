<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users')->insert([
        //     'name' => "Shree Krishna Acharya",
        //     'email' => 'test@gmail.com',
        //     'password' => Hash::make('admin12345'),
        //     'email_verified_at' => now(),
        //     'remember_token' => Str::random(10),
        // ]);
        \App\Models\Student::factory(10)->create();
        \App\Models\QuestionBank::factory(100)->create();
        // $this->call([

        // ]);
    }
}
