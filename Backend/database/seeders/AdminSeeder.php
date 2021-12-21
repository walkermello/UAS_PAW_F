<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'Admin@uajy.ac.id',
            'email_verified_at' => Carbon::now(),
            'password' => '$2b$10$HQZhsKPjKMST/qPpibUXwe.Hy035hNjK6V2VrebuWeT5kBWik0zdi',
            'isAdmin' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
