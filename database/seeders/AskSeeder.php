<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AskSeeder extends Seeder
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
        \App\Models\Ask::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Note : Seeder of share of user 1 had no item to lend (all was already lent)

        // ===============================
        // Ask to borrow items of the user 2
        // ===============================

        \App\Models\Ask::factory()->create([
            'borrower_id' => '1',
            'item_id' => '21',
        ]);

        \App\Models\Ask::factory()->create([
            'borrower_id' => '3',
            'item_id' => '21',
        ]);

        \App\Models\Ask::factory()->create([
            'borrower_id' => '3',
            'item_id' => '22',
        ]);

        \App\Models\Ask::factory()->create([
            'borrower_id' => '3',
            'item_id' => '23',
        ]);

        // ===============================
        // Ask to borrow items of the user 3
        // ===============================

        // User 1 spammed the borrow of this item
        // only 1 entry should be visible on the ask page
        // Note : in real time, only one entry can be created, others should be rejected
        \App\Models\Ask::factory()->create([
            'borrower_id' => '1',
            'item_id' => '31',
        ]);

        \App\Models\Ask::factory()->create([
            'borrower_id' => '1',
            'item_id' => '31',
        ]);

        \App\Models\Ask::factory()->create([
            'borrower_id' => '1',
            'item_id' => '31',
        ]);


        \App\Models\Ask::factory()->create([
            'borrower_id' => '1',
            'item_id' => '32',
        ]);

        \App\Models\Ask::factory()->create([
            'borrower_id' => '2',
            'item_id' => '32',
        ]);

        // User 3 ask to borrow an item of himself
        // it shouldn't be visible on the ask page
        // Note : in real time, it should be rejected
        \App\Models\Ask::factory()->create([
            'borrower_id' => '3',
            'item_id' => '32',
        ]);

        // No asks for items id 33 and 41
    }
}
