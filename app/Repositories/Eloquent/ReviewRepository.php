<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\ReviewRepositoryInterface;
use App\Models\Review;

class ReviewRepository extends BaseRepository implements ReviewRepositoryInterface
{
    public function model()
    {
        return Review::class;
    }

    public function getReviewByUserId($productId)
    {
        $reviews = $this->model->with('user')->where('product_id', $productId)
                    ->latest()->simplePaginate(config('setting.review.number_retrieve'));

        return $reviews;
    }

    public function getAvgStar($reviews)
    {
        $avgStar = $reviews->avg('rating');

        return $avgStar;
    }

    public function storeReview(array $request, $userId)
    {
        $review = new Review();
        $review->user_id = $userId;
        $review->content = $request['content'];
        $review->rating = $request['rating'];

        return $review;
    }
}
