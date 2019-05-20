<?php

namespace App\Repositories\Contracts;

interface ProductRepositoryInterface extends RepositoryInterface
{
    public function getAll();

    public function getAllWithoutPaginate();

    public function getMightLikeProduct($categoryId, $exceptProductId);

    public function storeProductsInSession($product, $id);

    public function filterByCategory($slug);

    public function filterByPrice($data);

    public function storeProduct(array $request);

    public function importProduct($request);
}
