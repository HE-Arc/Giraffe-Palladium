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
        // ===============================
        // Clean table
        // ===============================

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \App\Models\User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // ===============================
        // Easy to remember users
        // ===============================

        \App\Models\User::factory()->create([
            'name' => 'Simple Test User',
            'email' => '1@1',
            'password' => '1',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'User 2',
            'email' => '2@2',
            'password' => '2',
            'description' => 'A super description\nwith a line break',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'third user',
            'email' => '3@3',
            'password' => '3',
            'description' => 'test injection <script>alert("Hey")</script>',
        ]);

        \App\Models\User::factory(11)->create();
    }
}
