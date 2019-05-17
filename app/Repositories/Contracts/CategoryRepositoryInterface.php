<?php

namespace App\Repositories\Contracts;

interface CategoryRepositoryInterface extends RepositoryInterface
{
    public function getCategory();

    public function store(array $request);
}
