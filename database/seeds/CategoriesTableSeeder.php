<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'Phone',
            'slug' => 'phone',
            'parent_id' => 0,
        ]);

        DB::table('categories')->insert([
            'name' => 'Desktop',
            'slug' => 'desktop',
            'parent_id' => 0,
        ]);

        DB::table('categories')->insert([
            'name' => 'Laptop',
            'slug' => 'laptop',
            'parent_id' => 0,
        ]);

        DB::table('categories')->insert([
            'name' => 'Tablet',
            'slug' => 'tablet',
            'parent_id' => 0,
        ]);

        DB::table('categories')->insert([
            'name' => 'Appliance',
            'slug' => 'appliance',
            'parent_id' => 0,
        ]);

        DB::table('categories')->insert([
            'name' => 'Security',
            'slug' => 'security',
            'parent_id' => 0,
        ]);
    }
}
