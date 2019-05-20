<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\ReviewRepositoryInterface;

class ShopController extends Controller
{
    private $categoryRepository;
    private $productRepository;
    private $reviewRepository;

    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
        ProductRepositoryInterface $productRepository,
        ReviewRepositoryInterface $reviewRepository
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
        $this->reviewRepository = $reviewRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->findBy('parent_id', '0');
        $products = $this->productRepository->getAll();

        return view('shop.index')->with([
            'categories' => $categories,
            'products' => $products,
        ]);
    }

    public function show($productSlug)
    {
        $product = $this->productRepository->findBySlug($productSlug);
        $recommendProducts = $this->productRepository->getMightLikeProduct($product->category->id, $product->id);
        $reviews = $this->reviewRepository->getReviewByUserId($product->id);
        $avgStar = $this->reviewRepository->getAvgStar($reviews);
        $viewedProducts = $this->productRepository->storeProductsInSession($product, $product->id);

        return view('shop.show')->with([
            'product' => $product,
            'recommendProducts' => $recommendProducts,
            'reviews' => $reviews,
            'avgStar' => round($avgStar, config('setting.product.number_round_rating')),
            'viewedProducts' => $viewedProducts,
        ]);
    }

    public function filterCategory($slug)
    {
        $category = $this->categoryRepository->findBySlug($slug);
        $productsByCategories = $this->productRepository->findBy('category_id', $category->id);

        return response()->json([
            'products' => $productsByCategories,
        ]);
    }

    public function filterPrice($data)
    {
        $productByPrice = $this->productRepository->filterByPrice($data);

        return response()->json([
            'products' => $productByPrice,
        ]);
    }
}
