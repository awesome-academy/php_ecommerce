<?php

namespace App\Repositories\Contracts;

interface ReviewRepositoryInterface extends RepositoryInterface
{
    public function getReviewByUserId($productId);

    public function getAvgStar($reviews);

    public function storeReview(array $request, $userId);
}
