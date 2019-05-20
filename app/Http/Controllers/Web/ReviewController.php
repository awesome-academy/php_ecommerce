<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ReviewRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Auth;
use App\Http\Requests\CreateReviewRequest;

class ReviewController extends Controller
{
    private $reviewRepository;
    private $productRepository;

    public function __construct(
        ReviewRepositoryInterface $reviewRepository,
        ProductRepositoryInterface $productRepository
    ) {
        $this->middleware('auth');
        $this->reviewRepository = $reviewRepository;
        $this->productRepository = $productRepository;
    }

    public function store(CreateReviewRequest $request, $productSlug)
    {
        $product = $this->productRepository->findBySlug($productSlug);
        $review = $this->reviewRepository->storeReview($request->all(), Auth::id());
        $product->reviews()->save($review);

        return back();
    }
}
