<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Product;

class ShopPageTest extends TestCase
{
    private $product;

    public function setup(): void
    {
        parent::setup();
        $this->product = factory(Product::class)->create();
    }

    public function testUserCanNavigateToShopPageAndSeeAllProducts()
    {
        $response = $this->get('/shop');
        $response->assertSee('Shop');
        $response->assertSee($this->product->name);
    }

    public function testUserCanNavigateToASingleProductPage()
    {
        $response = $this->get('/shop/' . $this->product->slug);
        $response->assertSee($this->product->name);
        $response->assertOk();
    }
}
