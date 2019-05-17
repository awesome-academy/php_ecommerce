<?php

namespace App\Repositories\Contracts;

interface RequestProductRepositoryInterface extends RepositoryInterface
{
    public function getWithUser();

    public function storeRequest(array $request);

    public function count();

    public function createRequestFromUser(array $request, $userId);
}
