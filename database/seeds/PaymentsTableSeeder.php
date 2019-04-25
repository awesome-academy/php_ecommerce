<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payments')->insert([
            'name' => 'Direct Delivery',
        ]);

        DB::table('payments')->insert([
            'name' => 'By Visa/Master card',
        ]);
    }
}
