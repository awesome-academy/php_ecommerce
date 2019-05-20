<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\RequestProductRepositoryInterface;
use App\Models\RequestProduct;

class RequestProductRepository extends BaseRepository implements RequestProductRepositoryInterface
{
    public function model()
    {
        return RequestProduct::class;
    }

    public function getWithUser()
    {
        $requests = $this->model->with('user')->get();

        return $requests;
    }

    public function count()
    {
        $requests = $this->model->all()->count();

        return $requests;
    }

    public function storeRequest(array $request)
    {
        $requestProduct = $this->find($request['id']);
        $requestProduct->status = $request['status'];
        $requestProduct->save();

        return [
            'name' => $requestProduct->product_name,
            'description' => $requestProduct->description,
            'status' => $requestProduct->status['status'],
        ];
    }

    public function createRequestFromUser(array $request, $userId)
    {
        if ($this->model->create([
            'user_id' => $userId,
            'product_name' => $request['product_name'],
            'description' => $request['description'],
        ])) {
            return true;
        }

        return false;
    }
}
