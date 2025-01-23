<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Models\Category;
use App\Models\DetailTransaction;
use App\Models\Item;
use App\Models\StorageLocation;
use App\Models\Supplier;
use App\Models\Transaction;
use App\Traits\HasDataTablesActions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class TransactionController extends Controller
{
  use HasDataTablesActions;

  public function fetch_transactions()
  {
    $query = Transaction::with('detail_transactions');

    $routes = [
      'view' => 'transaction.show',
      'edit' => 'transaction.edit',
      'delete' => 'transaction.destroy'
    ];

    return $this->generateDataTable($query, $routes);
  }

  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $stock_in = DetailTransaction::whereHas('transaction', function ($query) {
      $query->where('type', 'in');
    })->sum('quantity');

    $stock_out = DetailTransaction::whereHas('transaction', function ($query) {
      $query->where('type', 'out');
    })->sum('quantity');

    return view('transaction.index', [
      'total_transaction' => Transaction::count(),
      'stock_in' => $stock_in,
      'stock_out' => $stock_out,
      // 'average_price' => Transaction::avg('unit_price'),
    ]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('transaction.form', [
      'method' => 'post',
      'transaction' => new Transaction,
      'items' => Item::select('id', 'name')->get(),
      'suppliers' => Supplier::select('id', 'name')->get(),
      'storage_locations' => StorageLocation::select('id', 'name')->get(),
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(TransactionRequest $request)
  {
    $request['unit_price'] = (int) str_replace('.', '', $request->unit_price);

    Transaction::create($request->all());

    Alert::success('Success', 'Storage Location created successfully.');

    return redirect()->route('transaction.index');
  }

  /**
   * Display the specified resource.
   */
  public function show(Transaction $transaction)
  {
    return view('transaction.show', compact('transaction'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Transaction $transaction)
  {
    $transaction->unit_price = number_format($transaction->unit_price, 0, ',', '.');

    return view('transaction.form', [
      'method' => 'put',
      'transaction' => $transaction,
      'items' => Item::select('id', 'name')->get(),
      'suppliers' => Supplier::select('id', 'name')->get(),
      'storage_locations' => StorageLocation::select('id', 'name')->get(),
    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(TransactionRequest $request, Transaction $transaction)
  {
    $request['unit_price'] = (int) str_replace('.', '', $request->unit_price);

    $transaction->update($request->all());

    Alert::success('Success', 'Storage Location updated successfully.');

    return redirect()->route('transaction.index');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Transaction $transaction)
  {
    $transaction->delete();

    Alert::success('Success', 'Storage Location deleted successfully.');

    return redirect()->route('transaction.index');
  }

  public function bulk_delete(Request $request)
  {
    $ids = $request->ids;
    Transaction::whereIn('id', $ids)->delete();

    return response()->json(['message' => 'Selected transactions deleted successfully!']);
  }

}
