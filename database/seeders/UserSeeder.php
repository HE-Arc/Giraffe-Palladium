<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::truncate();

        \App\Models\User::factory(11)->create();

        \App\Models\User::factory()->create([
            'name' => 'Simple Test User',
            'email' => '1@1',
            'password' => bcrypt('1'),
        ]);
    }
}
