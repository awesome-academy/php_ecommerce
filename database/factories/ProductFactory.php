<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Product;
use App\Models\Category;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $name = str_replace('.', '', $faker->sentence(rand(4, 8)));
    return [
        'category_id' => function () {
            $idCategories = Category::all()->pluck('id')->toArray();
            return $idCategories[array_rand($idCategories)];
        },
        'name' => $name,
        'slug' => str_slug($name, '-'),
        'description' => $faker->paragraph(2, true),
        'stock_quantity' => rand(5, 100),
        'image' => 'img/products/phone-1',
        'price' => rand(10000000, 30000000),
    ];
});
