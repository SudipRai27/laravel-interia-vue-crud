<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\AggregateSale;
use App\Models\AggregateTraffic;
use App\Models\AggregateCustomer;
use Illuminate\Support\Facades\Request;


class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard/Index', [
            'sales' => function () {
                $sales = $this->salesData();
                return [
                    'date' => $sales->pluck('date'),
                    'count' => $sales->pluck('count')
                ];
            },
            'customers' => function () {
                $customers = $this->customerData();
                return [
                    'date' => $customers->pluck('date'),
                    'count' => $customers->pluck('count')
                ];
            },
            'traffic' => function () {
                $traffic = $this->trafficData();
                return [
                    'date' => $traffic->pluck('date'),
                    'count' => $traffic->pluck('count')
                ];
            }
        ]);
    }

    private function salesData()
    {
        return AggregateSale::query()
            ->when(Request::get('period', 'weekly') === 'weekly', function ($query) {
                return $query->fromLastWeek();
            })
            ->when(Request::get('period', 'weekly') === 'monthly', function ($query) {
                return $query->fromLastMonth();
            })
            ->orderBy('date', 'DESC')
            ->get()
            ->transform(function ($data) {
                return [
                    'date' => Carbon::create($data->date)->format('j M'),
                    'count' => $data->total_sales
                ];
            });
    }

    private function customerData()
    {
        return AggregateCustomer::query()
            ->when(Request::get('period', 'weekly') === 'weekly', function ($query) {
                return $query->fromLastWeek();
            })
            ->when(Request::get('period', 'weekly') === 'monthly', function ($query) {
                return $query->fromLastMonth();
            })
            ->orderBy('date', 'DESC')
            ->get()
            ->transform(function ($data) {
                return [
                    'date' => Carbon::create($data->date)->format('j M'),
                    'count' => $data->total_customers
                ];
            });
    }

    private function trafficData()
    {
        return AggregateTraffic::query()
            ->when(Request::get('period', 'weekly') === 'weekly', function ($query) {
                return $query->fromLastWeek();
            })
            ->when(Request::get('period', 'weekly') === 'monthly', function ($query) {
                return $query->fromLastMonth();
            })
            ->orderBy('date', 'DESC')
            ->get()
            ->transform(function ($data) {
                return [
                    'date' => Carbon::create($data->date)->format('j M'),
                    'count' => $data->total_hits
                ];
            });
    }
}