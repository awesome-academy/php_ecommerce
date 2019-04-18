<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'category_id' => '1',
            'name' => 'Iphone X1',
            'slug' => 'iphone-x-1',
            'description' => 'New Iphone X with 128gb memory, Fullbox Fulltag, Activated',
            'stock_quantity' => '10',
            'image' => 'img/products/phone-1',
            'price' => 12300000,
        ]);

        DB::table('products')->insert([
            'category_id' => '1',
            'name' => 'Iphone X2',
            'slug' => 'iphone-x-2',
            'description' => 'New Iphone X with 128gb memory, Fullbox Fulltag, Activated',
            'stock_quantity' => '2',
            'image' => 'img/products/phone-1',
            'price' => 16300000,
        ]);

        DB::table('products')->insert([
            'category_id' => '1',
            'name' => 'Iphone X3',
            'slug' => 'iphone-x-3',
            'description' => 'New Iphone X with 128gb memory, Fullbox Fulltag, Activated',
            'stock_quantity' => '3',
            'image' => 'img/products/phone-1',
            'price' => 15300000,
        ]);

        DB::table('products')->insert([
            'category_id' => '2',
            'name' => 'PC DELL1 Core i7',
            'slug' => 'pc-dell',
            'description' => 'New PC DELL with SSD 128gb memory, Core i7, 16gb ram,VGA GTX 1060',
            'stock_quantity' => '5',
            'image' => 'img/products/desktop-1',
            'price' => 15000000,
        ]);

        DB::table('products')->insert([
            'category_id' => '2',
            'name' => 'PC DELL2 Core i7',
            'slug' => 'pc-dell-2',
            'description' => 'New PC DELL with SSD 128gb memory, Core i7, 16gb ram,VGA GTX 1060',
            'stock_quantity' => '6',
            'image' => 'img/products/desktop-1',
            'price' => 13000000,
        ]);

        DB::table('products')->insert([
            'category_id' => '3',
            'name' => '[NEW] Macbook air1',
            'slug' => 'macbook-air-1',
            'description' => 'New Macbook air 2018 with 128gb memory, core i7',
            'stock_quantity' => '123',
            'image' => 'img/products/laptop-1',
            'price' => 45000000,
        ]);

        DB::table('products')->insert([
            'category_id' => '3',
            'name' => '[NEW] Macbook air2',
            'slug' => 'macbook-air-2',
            'description' => 'New Macbook air 2018 with 128gb memory, core i7',
            'stock_quantity' => '32',
            'image' => 'img/products/laptop-1',
            'price' => 35500000,
        ]);

        DB::table('products')->insert([
            'category_id' => '3',
            'name' => '[NEW] Macbook air3',
            'slug' => 'macbook-air-3',
            'description' => 'New Macbook air 2018 with 128gb memory, core i7',
            'stock_quantity' => '11',
            'image' => 'img/products/laptop-1',
            'price' => 35002000,
        ]);

        DB::table('products')->insert([
            'category_id' => '3',
            'name' => '[NEW] Macbook air4',
            'slug' => 'macbook-air-4',
            'description' => 'New Macbook air 2018 with 128gb memory, core i7',
            'stock_quantity' => '2',
            'image' => 'img/products/laptop-1',
            'price' => 55000000,
        ]);

        DB::table('products')->insert([
            'category_id' => '4',
            'name' => 'IPAD 4 PRO',
            'slug' => 'ipad-4-pro',
            'description' => 'New IPAD PRO',
            'stock_quantity' => '2',
            'image' => 'img/products/tablet-1',
            'price' => 2509000,
        ]);

        DB::table('products')->insert([
            'category_id' => '5',
            'name' => 'Tivi',
            'slug' => 'tivi',
            'description' => 'New tivi',
            'stock_quantity' => '2',
            'image' => 'img/products/appliance-1',
            'price' => 2509000,
        ]);
    }
}
