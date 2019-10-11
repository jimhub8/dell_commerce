<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Order;
class DashboardController extends Controller
{
    public function getChartData()
    {
        $products = DB::table('products')
            ->select(DB::raw('count(id) as count, date_format(created_at, "%M") as date'))
            ->orderBy('id', 'asc')
            ->groupBy('date')
            // ->where('branch_id', Auth::user()->branch_id)
            ->get();
        $lables = [];
        $rows = [];
        foreach ($products as $key => $product) {
            $lables[] = $product->date;
            $rows[] = $product->count;
        }
        $data = array(
            'lables' => $lables,
            'rows' => $rows
        );
        return response()->json(['data' => $data]);
    }

    public function getChartOrders()
    {
        $orders = DB::table('orders')
            ->select(DB::raw('count(id) as count, date_format(created_at, "%M") as date'))
            ->orderBy('id', 'asc')
            ->groupBy('date')
            // ->where('status', 'Scheduled')
            ->get();

        $lables = [];
        $rows = [];
        foreach ($orders as $key => $order) {
            $lables[] = $order->date;
            $rows[] = $order->count;
        }
        $data = array(
            'lables' => $lables,
            'rows' => $rows
        );
        return response()->json(['data' => $data]);
    }

    public function getBrands()
    {
        $brands = DB::table('brands')
            ->select(DB::raw('count(id) as count, date_format(created_at, "%M") as date'))
            ->orderBy('id', 'asc')
            ->groupBy('date')
            ->get();

        $lables = [];
        $rows = [];
        foreach ($brands as $key => $brand) {
            $lables[] = $brand->date;
            $rows[] = $brand->count;
        }
        $data = array(
            'lables' => $lables,
            'rows' => $rows
        );
        return response()->json(['data' => $data]);
    }

    public function getCategories()
    {
        $categories = DB::table('categories')
            ->select(DB::raw('count(id) as count, date_format(created_at, "%M") as date'))
            ->orderBy('id', 'asc')
            ->groupBy('date')
            ->get();

        $lables = [];
        $rows = [];
        foreach ($categories as $key => $category) {
            $lables[] = $category->date;
            $rows[] = $category->count;
        }
        $data = array(
            'lables' => $lables,
            'rows' => $rows
        );
        return response()->json(['data' => $data]);
    }

    public function getCountCount()
    {
        $countries = ['name' => 'Kenya', 'name' => 'Uganda', 'name' => 'Tanzania'];
        return $country = array(
            'Kenya' => $kenya,
            'Tanzania' => $tanzania,
            'Uganda' => $uganda,
        );
    }


    public function getBranchCount()
    {
        $branches = Branch::setEagerLoads([])->get();
        $branch_count = [];
        foreach ($branches as $key => $branch) {
            // return $branch->id;
            $branch_count[] = array(
                'name' => $branch->branch_name,
                'id' => $key,
            );
        }
        return $branch_count;
    }

    public function getOrders()
    {
        $orders = DB::table('orders')
            ->select(DB::raw('count(id) as count, date_format(created_at, "%M") as date'))
            ->orderBy('id', 'asc')
            ->groupBy('date')
            // ->where('branch_id', Auth::id())
            ->get();

        $lables = [];
        $rows = [];
        foreach ($orders as $key => $order) {
            $lables[] = $order->date;
            $rows[] = $order->count;
        }
        $data = array(
            'lables' => $lables,
            'rows' => $rows
        );
        return response()->json(['data' => $data]);
    }




    public function getCountryhipments()
    {
        $countries = Country::setEagerLoads([])->get();
        $country_count = [];
        foreach ($countries as $key => $country) {
            // return $country->id;
            $country_count[] = array(
                'name' => $country->country_name,
                'id' => $key,
            );
        }
        return $country_count;
    }


    public function countDelivered()
    {
    }

    public function countPending()
    {
        return Order::where('delivered', 0)->count();
    }

    public function countOrders()
    {
        return Order::count();
    }
}
