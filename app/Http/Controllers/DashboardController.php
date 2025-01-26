<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaction;
use App\Models\Item;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  /**
   * Show the dashboard view with statistics and recent activities.
   *
   * @return \Illuminate\View\View
   */
  public function index()
  {
    // General Statistics
    $totalItems = Item::count(); // Total number of items
    $lowStockItems = Item::whereRaw('quantity < min_stock')->count(); // Low stock threshold set to 10
    $totalStockIn = DetailTransaction::whereHas('transaction', function ($q) {
      $q->where('type', 'in');
    })->count();
    $totalStockOut = DetailTransaction::whereHas('transaction', function ($q) {
      $q->where('type', 'in');
    })->count();

    // Recent Activities (Server-side processing for DataTables)
    return view('index', [
      'total_items' => $totalItems,
      'low_stock_items' => $lowStockItems,
      'total_stock_in' => $totalStockIn,
      'total_stock_out' => $totalStockOut
    ]);
  }

  /**
   * Fetch recent activities for DataTables.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function fetch_recent_activities(Request $request)
  {
    $query = DetailTransaction::with('item')->orderBy('created_at', 'desc');

    return datatables()->eloquent($query)
      ->addColumn('item_name', function ($row) {
        return $row->item->name;
      })
      ->editColumn('type', function ($row) {
        return '<span class="badge text-bg-' . ($row->transaction->type == 'in' ? 'primary' : 'danger') . '">Stock ' . ucfirst($row->transaction->type) . '</span>';
      })
      ->editColumn('created_at', function ($row) {
        return $row->created_at->format('d M Y');
      })
      ->rawColumns(['type'])
      ->make(true);
  }
}
