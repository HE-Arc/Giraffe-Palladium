<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShareSeeder extends Seeder
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
        \App\Models\Share::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        // ===============================
        // Items borrowed from other users
        // ===============================

        // 2 borrow Mario Party to 1
        \App\Models\Share::factory()->create([
            'item_id' => '11',
            'lender_id' => '1',
            'borrower_id' => '2',
            'since' => date_create('21.11.2022'),
            'deadline' => date_create('12.12.2022'),
            'displayed' => true,
            'terminated' => false,
        ]);

        // 3 borrow Mario Kart to 1, and he already return it
        \App\Models\Share::factory()->create([
            'item_id' => '12',
            'lender_id' => '1',
            'borrower_id' => '2',
            'since' => date_create('21-11-2022'),
            'deadline' => date_create('12-12-2022'),
            'displayed' => true,
            'terminated' => true,
        ]);

        // 1 borrow a backpack to his mother (not registered in the site)
        \App\Models\Share::factory()->create([
            'item_id' => '13',
            'nonuser_lender' => 'Mama',
            'borrower_id' => '1',
            'since' => date_create('21-11-2022'),
            'deadline' => date_create('29-11-2022'),
            'displayed' => false,
            'terminated' => false,
        ]);

        \App\Models\Share::factory()->create([
            'item_id' => '21',
            'lender_id' => '2',
            'nonuser_borrower' => 'Brother',
            'since' => date_create('21-11-2022'),
            // No deadline
            'displayed' => false,
            'terminated' => false,
        ]);

        // ===============================
        // Items proposed but not borrowed
        // ===============================


        \App\Models\Share::factory()->create([
            'item_id' => '22',
            'lender_id' => '2',
            'deadline' => date_create('11-12-2022'), // Ambigus date/month (11 december)
            'displayed' => true,
            'terminated' => false,
        ]);

        \App\Models\Share::factory()->create([
            'item_id' => '23',
            'lender_id' => '2',
            'deadline' => date_create('07.12.2022'), // swiss format
            'displayed' => false, // not displayed
            'terminated' => false,
        ]);

        \App\Models\Share::factory()->create([
            'item_id' => '31',
            'lender_id' => '3',
            'deadline' => date_create('30-12-2022'),
            'displayed' => true,
            'terminated' => false,
        ]);

        // No deadline
        \App\Models\Share::factory()->create([
            'item_id' => '32',
            'lender_id' => '3',
            'displayed' => true,
            'terminated' => false,
        ]);

        \App\Models\Share::factory()->create([
            'item_id' => '33',
            'lender_id' => '3',
            'displayed' => true,
            'terminated' => false,
        ]);

        // Displayed but terminated (should not be visible in borrow list)
        \App\Models\Share::factory()->create([
            'item_id' => '41',
            'lender_id' => '4',
            'displayed' => true,
            'terminated' => true,
        ]);
    }
}
