<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
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
        \App\Models\Item::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // ===============================
        // Items of the user 1
        // ===============================

        \App\Models\Item::factory()->create([
            'id' => 11,
            'owner_id' => '1',
            'title' => 'Mario Party',
            'description' => 'Nintendo Switch game',
            'listed' => false,
        ]);

        \App\Models\Item::factory()->create([
            'id' => 12,
            'owner_id' => '1',
            'title' => 'Mario Kart',
            'description' => 'Nintendo Switch game',
            'listed' => false,
        ]);

        \App\Models\Item::factory()->create([
            'id' => 13,
            'owner_id' => '1',
            'title' => 'Backpack',
            'description' => 'The backpack of my mother',
            'listed' => false,
        ]);

        // ===============================
        // Items of the user 2
        // ===============================

        \App\Models\Item::factory()->create([
            'id' => 21,
            'owner_id' => '2',
            'title' => 'Calculator',
            'description' => 'HP 12C',
            'listed' => false,
        ]);

        \App\Models\Item::factory()->create([
            'id' => 22,
            'owner_id' => '2',
            'title' => 'Book of Mathematics',
            'description' => 'How to solve some problems',
            'listed' => true,
        ]);

        \App\Models\Item::factory()->create([
            'id' => 23,
            'owner_id' => '2',
            'title' => 'Keyboard',
            'description' => 'FR-CH layout\nAsus ROG',
            'listed' => true,
        ]);

        // ===============================
        // Items of the user 3
        // ===============================

        \App\Models\Item::factory()->create([
            'id' => 31,
            'owner_id' => '3',
            'title' => 'Swiss Knife',
            'description' => 'Victorinox',
            'listed' => true,
        ]);

        \App\Models\Item::factory()->create([
            'id' => 32,
            'owner_id' => '3',
            'title' => 'BD Marsupilami 1',
            'description' => 'Great BD, i share it to let you discover it',
            'listed' => true,
        ]);

        \App\Models\Item::factory()->create([
            'id' => 33,
            'owner_id' => '3',
            'title' => 'Green Tupperware',
            'description' => 'Usefull to store some food',
            'listed' => false,
        ]);

        // ===============================
        // Other items
        // ===============================

        \App\Models\Item::factory()->create([
            'id' => 41,
            'owner_id' => '4',
            'title' => 'USB Key',
            'description' => '16GB',
            'listed' => false,
        ]);
    }
}
