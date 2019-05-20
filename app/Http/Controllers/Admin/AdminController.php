<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\RequestProductRepositoryInterface;

class AdminController extends Controller
{
    private $orderRepository;
    private $requestRepository;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        RequestProductRepositoryInterface $requestRepository
    ) {
        $this->orderRepository = $orderRepository;
        $this->requestRepository = $requestRepository;
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $orders = $this->orderRepository->countWithStatus(config('setting.status.pending'));
        $requests = $this->requestRepository->count();

        return view('admin.index', [
            'users' => $users,
            'orders' => $orders,
            'requests' => $requests,
        ]);
    }

    public function getCharts()
    {
        $chart = $this->orderRepository->getCharts();

        return view('admin.chart', [
            'chartMonth' => $chart['chartMonth'],
            'chartYear' => $chart['chartYear'],
        ]);
    }
}
