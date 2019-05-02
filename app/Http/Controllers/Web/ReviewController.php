<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use App\Models\Comment;
use App\Models\Rate;
use Auth;
use App\Http\Requests\CreateReviewRequest;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(CreateReviewRequest $request, $productSlug)
    {
        $product = Product::where('slug', $productSlug)->first();
        $review = new Review();
        $review->user_id = Auth::id();
        $review->content = $request->content;
        $review->rating = $request->rating;
        $product->reviews()->save($review);

        return back();
    }
}
