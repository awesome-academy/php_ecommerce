<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\CreateProductSuggestRequest;
use Auth;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\RequestProductRepositoryInterface;

class UserController extends Controller
{
    private $userRepository;
    private $requestRepository;
    private $orderRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        RequestProductRepositoryInterface $requestRepository,
        OrderRepositoryInterface $orderRepository
    ) {
        $this->middleware('auth');
        $this->userRepository = $userRepository;
        $this->requestRepository = $requestRepository;
        $this->orderRepository = $orderRepository;
    }

    public function index()
    {
        $user = Auth::user();

        return view('user.profile')->with('user', $user);
    }

    public function update(UpdateUserRequest $request)
    {
        if ($this->userRepository->updateProfile($request)) {
            return redirect()->route('user.profile')->with([
                'level' => 'success',
                'message' => @trans('common.user.update.success'),
            ]);
        }
    }

    public function requestProduct(CreateProductSuggestRequest $request)
    {
        if ($this->requestRepository->createRequestFromUser($request->all(), Auth::id())) {
            return redirect()->route('user.profile')->with([
                'level' => 'success',
                'message' => @trans('common.user.request_product.success'),
            ]);
        }
    }

    public function getDetailOrder($id)
    {
        $products = $this->orderRepository->ajaxDetailOrder($id);
        if ($products != null) {
            return response()->json([
                'order' => $products,
            ]);
        } else {
            return response()->json([
                'message' => trans('common.user.order.find_fail'),
            ]);
        }
    }
}
