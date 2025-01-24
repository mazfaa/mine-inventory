<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaction;
use App\Models\Transaction;
use App\Traits\HasDataTablesActions;
use Illuminate\Http\Request;

class DetailTransactionController extends Controller
{
  use HasDataTablesActions;
  public function fetch_detail_transactions(Transaction $transaction)
  {
    $query = DetailTransaction::with('transaction')->where('transaction_id', $transaction->id)->get();

    $routes = [
      'view' => 'detail-transaction.show',
      'edit' => 'detail-transaction.edit',
      'delete' => 'detail-transaction.destroy'
    ];

    return $this->generateDataTable($query, $routes, [
      'transaction_id' => function ($row) {
        return $row->transaction->id ?? 'No Transaction ID';
      },

      'item' => function ($row) {
        return $row->item->name ?? 'No Item';
      },

      'supplier' => function ($row) {
        return $row->supplier->name ?? 'No Supplier';
      },

      'storage_location' => function ($row) {
        return $row->storage_location->name ?? 'No Storage Location';
      },

      'type' => function ($row) {
        $text = ($row->transaction->type ?? $row->type) ?? 'No Type';
        $bgClass = $text === 'out' ? 'text-bg-danger' : 'text-bg-primary';
        return '<span class="badge ' . $bgClass . '">Stock ' . ucfirst($text) . '</span>';
      },

      'description' => function ($row) {
        return $row->transaction->description ?? '-';
      },
    ]);
  }

  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    //
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   */
  public function show(DetailTransaction $detail_transaction)
  {
    // $detail_transaction = $detail_transaction::with('transaction')->find($detail_transaction->id);
    return view('detail-transaction.show', compact('detail_transaction'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(DetailTransaction $detailTransaction)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, DetailTransaction $detailTransaction)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(DetailTransaction $detailTransaction)
  {
    //
  }
}
