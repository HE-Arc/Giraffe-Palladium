<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \App\Models\User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        \App\Models\User::factory(11)->create();

        \App\Models\User::factory()->create([
            'name' => 'Simple Test User',
            'email' => '1@1',
            'password' => '1',
        ]);
    }
}
