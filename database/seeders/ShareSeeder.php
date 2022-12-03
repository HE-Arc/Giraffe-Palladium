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
            'deadline' => date_create('10.12.2022'),
            'terminated' => false,
        ]);

        // 3 borrow Mario Kart to 1, and he already return it
        \App\Models\Share::factory()->create([
            'item_id' => '12',
            'lender_id' => '1',
            'borrower_id' => '2',
            'since' => date_create('21-11-2022'),
            'deadline' => date_create('12-12-2022'),
            'terminated' => true,
        ]);

        //  -> so now it's 2 who borrow Mario Kart to 1
        \App\Models\Share::factory()->create([
            'item_id' => '12',
            'lender_id' => '1',
            'borrower_id' => '2',
            'since' => date_create('01-12-2022'),
            'deadline' => date_create('12-12-2022'),
            'terminated' => false,
        ]);

        // 1 borrow a backpack to his mother (not registered in the site)
        \App\Models\Share::factory()->create([
            'item_id' => '13',
            'nonuser_lender' => 'Mama',
            'borrower_id' => '1',
            'since' => date_create('21-11-2022'),
            'deadline' => date_create('29-11-2022'),
            'terminated' => false,
        ]);

        // the brother (not registered in the site) borrow the calculator to 2
        \App\Models\Share::factory()->create([
            'item_id' => '21',
            'lender_id' => '2',
            'nonuser_borrower' => 'Brother',
            'since' => date_create('21-11-2022'),
            // No deadline
            'terminated' => false,
        ]);

        // 1 borrow object to 2, and already return it
        \App\Models\Share::factory()->create([
            'item_id' => '22',
            'lender_id' => '2',
            'borrower_id' => '1',
            'since' => date_create('03-12-2022'),
            // No deadline
            'terminated' => true,
        ]);
    }
}
