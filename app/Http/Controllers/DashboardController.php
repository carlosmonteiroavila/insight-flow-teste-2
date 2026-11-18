<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Product;
use App\Models\StockMovement;

class DashboardController extends Controller
{
    public function index()
    {
        $companyId = auth()->user()->company_id;

        $stats = [
            'clients' => Client::where('company_id', $companyId)->count(),
            'products' => Product::where('company_id', $companyId)->count(),
            'low_stock' => Product::where('company_id', $companyId)
                ->whereColumn('quantity', '<=', 'minimum_quantity')->count(),
            'stock_value' => Product::where('company_id', $companyId)
                ->selectRaw('COALESCE(SUM(quantity * unit_cost), 0) as total')
                ->value('total'),
        ];

        $recentMovements = StockMovement::with('product')
            ->where('company_id', $companyId)
            ->latest()->limit(6)->get();

        $lowStockProducts = Product::where('company_id', $companyId)
            ->whereColumn('quantity', '<=', 'minimum_quantity')
            ->orderBy('quantity')->limit(5)->get();

        return view('dashboard', compact('stats', 'recentMovements', 'lowStockProducts'));
    }
}
