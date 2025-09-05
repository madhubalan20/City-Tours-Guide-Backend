<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_groups')->insert([
            'name'=>'admin',
            'status'=>'1',
        ]);

        DB::table('user_groups')->insert([
            'name'=>'user',
            'status'=>'1',
        ]);
    }
}
