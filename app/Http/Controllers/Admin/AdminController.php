<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\RequestProduct;
use Charts;
use DB;

class AdminController extends Controller
{
    public function __construct()
    {
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
        $orders = Order::whereStatus(config('setting.status.pending'))->count();
        $requests = RequestProduct::all()->count();

        return view('admin.index', [
            'users' => $users,
            'orders' => $orders,
            'requests' => $requests,
        ]);
    }

    public function getCharts()
    {
        $ordersByMonth = Order::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"), date('Y'))->get();
        $chartMonth = $this->createChart($ordersByMonth, trans('admin.chart.order.title.detail_month'), trans('admin.chart.order.label.total'), 'bar')->groupByMonth(date('Y'), true);

        $ordersByYear = Order::all();
        $chartYear = $this->createChart($ordersByYear, trans('admin.chart.order.title.detail_year'), trans('admin.chart.order.label.total'), 'bar')->groupByYear(config('setting.chart.num_year'));

        return view('admin.chart', [
            'chartMonth' => $chartMonth,
            'chartYear' => $chartYear,
        ]);
    }

    public function createChart($data, $title, $label, $type)
    {
        $chart = Charts::database($data, $type, 'highcharts')
                  ->title($title)
                  ->elementLabel($label)
                  ->dimensions(config('setting.chart.dimensions.width'), config('setting.chart.dimensions.height'))
                  ->responsive(true);

        return $chart;
    }
}
