<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SaleItem;
use App\Models\Region;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSales = \App\Models\SaleItem::sum('total_sales');
        $overallSalesCount = \App\Models\SaleItem::sum('units_sold');
        $productCountPerRegion = \App\Models\Region::withCount(['sales as product_count' => function ($query) {
            $query->join('sale_items', 'sales.id', '=', 'sale_items.sale_id');
        }])->get()->pluck('product_count', 'name');
        $productsSoldPerMonth = \App\Models\SaleItem::select(
                \DB::raw('MONTH(sales.sale_date) as month'),
                \DB::raw('SUM(units_sold) as total')
            )
            ->join('sales', 'sale_items.sale_id', '=', 'sales.id')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');
        $productsSoldPerRegion = \App\Models\Region::select('regions.name', \DB::raw('SUM(sale_items.units_sold) as total'))
            ->join('sales', 'regions.id', '=', 'sales.region_id')
            ->join('sale_items', 'sales.id', '=', 'sale_items.sale_id')
            ->groupBy('regions.name')
            ->pluck('total', 'regions.name');
    
        return view('dashboard', compact(
            'totalSales',
            'overallSalesCount',
            'productCountPerRegion',
            'productsSoldPerMonth',
            'productsSoldPerRegion'
        ));
    }
    
}