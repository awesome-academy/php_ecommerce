<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Product;

class ProductControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testProductCreate()
    {
        $product = factory(Product::class)->create();
        $this->assertInstanceOf(Product::class, $product);
        $this->assertDatabaseHas('products', [
            'name' => $product->name,
            'slug' => $product->slug,
            'category_id' => $product->category_id,
            'description' => $product->description,
            'stock_quantity' => $product->stock_quantity,
            'image' => $product->image,
            'price' => $product->price,
        ]);
    }

    public function testProductShow()
    {
        $product = factory(Product::class)->create();
        $this->assertInstanceOf(Product::class, $product);
        $findProduct = Product::findOrFail($product->id);
        $this->assertEquals($findProduct->name, $product->name);
        $this->assertEquals($findProduct->slug, $product->slug);
        $this->assertEquals($findProduct->category_id, $product->category_id);
        $this->assertEquals($findProduct->description, $product->description);
        $this->assertEquals($findProduct->stock_quantity, $product->stock_quantity);
        $this->assertEquals($findProduct->image, $product->image);
        $this->assertEquals($findProduct->price, $product->price);
    }

    public function testProductUpdate()
    {
        $product = factory(Product::class)->create();
        $data = [
            'name' => 'IPHONE XS 256 GB'.rand(1, 100),
        ];
        $this->assertInstanceOf(Product::class, $product);
        $product = Product::findOrFail($product->id);
        $success = $product->update($data);
        $this->assertTrue($success);
        $this->assertDatabaseHas('products', [
            'name' => $data['name'],
        ]);

        $data = [
            'description' => 'New Iphone XS with 256gb.'
        ];
        $product = Product::findOrFail($product->id);
        $success = $product->update($data);
        $this->assertTrue($success);
        $this->assertDatabaseHas('products', [
            'description' => $data['description'],
        ]);
    }

    public function testProductDelete()
    {
        $product = factory(Product::class)->create();
        $this->assertInstanceOf(Product::class, $product);
        $success = $product->delete();
        $this->assertTrue($success);
        $this->assertDatabaseMissing('products', [
            'name' => $product->name,
            'slug' => $product->slug,
            'category_id' => $product->category_id,
            'description' => $product->description,
            'stock_quantity' => $product->stock_quantity,
            'image' => $product->image,
            'price' => $product->price,
        ]);
    }
}
