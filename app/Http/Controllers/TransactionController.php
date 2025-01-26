<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Models\DetailTransaction;
use App\Models\Item;
use App\Models\StorageLocation;
use App\Models\Supplier;
use App\Models\Transaction;
use App\Traits\HasDataTablesActions;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

class TransactionController extends Controller
{
  use HasDataTablesActions;

  public function fetch_transactions(Request $request)
  {
    $query = Transaction::with('detail_transactions');

    if ($request->has('type') && $request->type != '') {
      $query->where('type', $request->type);
    }

    $routes = [
      'view' => 'transaction.show',
      'edit' => 'transaction.edit',
      'delete' => 'transaction.destroy'
    ];

    return $this->generateDataTable($query, $routes, [], [
      'type' => function ($row) {
        $bgClass = ($row->type == "in") ? "primary" : "danger";
        return '<span class="badge text-bg-' . $bgClass . '">Stock ' . ucfirst($row->type) . '</span>';
      },

      'description' => function ($row) {
        return $row->description ?? '-';
      },
    ]);
  }

  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('transaction.index', [
      'total_transaction' => Transaction::count(),
      'stock_in' => Transaction::where('type', 'in')->count(),
      'stock_out' => Transaction::where('type', 'out')->count(),
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
    try {
      DB::beginTransaction();

      $transaction_type = $request->type;

      $transaction = Transaction::create([
        'type' => $transaction_type,
        'description' => $request->description,
      ]);

      foreach ($request->transactions as $index => $detail_transaction) {
        $item = Item::find($detail_transaction['item_id']);
        $supplier = Supplier::find($detail_transaction['supplier_id']);
        $storage_location = StorageLocation::find($detail_transaction['storage_location_id']);

        if ($request->type == 'out' && $item->quantity < $detail_transaction['quantity']) {
          // Menangkap dan mengalihkan ke halaman sebelumnya
          throw ValidationException::withMessages([
            "transactions.$index.quantity" => 'Stock tidak mencukupi untuk item ' . $item->name . '. Stok tersedia: ' . $item->quantity
          ]);
        }

        $detail_transaction_quantity = $detail_transaction['quantity'];
        ($transaction_type == 'in') ? $item->quantity += $detail_transaction_quantity : $item->quantity -= $detail_transaction_quantity;
        $item->save();

        DetailTransaction::create([
          'transaction_id' => $transaction->id,
          'item_id' => $item->id,
          'supplier_id' => $supplier->id,
          'storage_location_id' => $storage_location->id,
          'quantity' => $detail_transaction_quantity,
        ]);
      }

      DB::commit();

      Alert::success('Success', 'Transaction created successfully.');

      return redirect()->route('transaction.index');
    } catch (ValidationException $e) {
      // Menangani validasi error dan mengembalikan ke form
      DB::rollBack();

      // Menampilkan kembali halaman dengan pesan error
      return back()->withErrors($e->errors())->withInput();
    } catch (Exception $e) {
      DB::rollBack();

      // Menangani error umum lainnya
      throw new Exception($e->getMessage());
    }
  }


  /**
   * Display the specified resource.
   */
  public function show(Transaction $transaction)
  {
    // dd($transaction->transaction->type);
    return view('transaction.show', [
      'transaction' => $transaction,
      'total_transaction' => $transaction->detail_transactions->count(),
      'stock_in' => $transaction->detail_transactions->where('type', 'in')->count(),
      'stock_out' => $transaction->detail_transactions->where('type', 'out')->count(),
      // 'average_price' => Transaction::avg('unit_price'),
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Transaction $transaction)
  {
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
    try {
      DB::beginTransaction();

      // Update data transaksi utama
      $transaction->update([
        'type' => $request->type,
        'description' => $request->description,
      ]);

      // Simpan ID dari detail transaksi yang dikirim dari request
      $existingDetailIds = [];

      foreach ($request->transactions as $index => $detail_transaction) {
        $item = Item::find($detail_transaction['item_id']);
        $detail = DetailTransaction::find($detail_transaction['id'] ?? null);

        if ($request->type == 'out' && $item->quantity < $detail_transaction['quantity']) {
          Alert::error('Error', "Stock tidak mencukupi untuk item {$item->name}. Stok tersedia: {$item->quantity}");
          throw ValidationException::withMessages([
            "transactions.$index.quantity" => 'Stock tidak mencukupi untuk item {$item->name}. Stok tersedia: {$item->quantity}'
          ]);
          // return back();
        }

        if ($detail) {
          // Jika detail transaksi sudah ada, update data dan stok
          $transaction->type == 'in'
            ? $item->quantity -= $detail->quantity
            : $item->quantity += $detail->quantity;

          $detail->update([
            'item_id' => $detail_transaction['item_id'],
            'supplier_id' => $detail_transaction['supplier_id'],
            'storage_location_id' => $detail_transaction['storage_location_id'],
            'quantity' => $detail_transaction['quantity'],
          ]);

          $transaction->type == 'in'
            ? $item->quantity += $detail_transaction['quantity']
            : $item->quantity -= $detail_transaction['quantity'];

          $item->save();
          $existingDetailIds[] = $detail->id;
        } else {
          // Tambahkan detail transaksi baru
          $newDetail = DetailTransaction::create([
            'transaction_id' => $transaction->id,
            'item_id' => $detail_transaction['item_id'],
            'supplier_id' => $detail_transaction['supplier_id'],
            'storage_location_id' => $detail_transaction['storage_location_id'],
            'quantity' => $detail_transaction['quantity'],
          ]);

          $transaction->type == 'in'
            ? $item->quantity += $detail_transaction['quantity']
            : $item->quantity -= $detail_transaction['quantity'];

          $item->save();
          $existingDetailIds[] = $newDetail->id;
        }
      }

      // Hapus detail transaksi yang tidak ada di request
      DetailTransaction::where('transaction_id', $transaction->id)
        ->whereNotIn('id', $existingDetailIds)
        ->each(function ($detail) use ($transaction) {
          $item = Item::find($detail->item_id);

          // Kembalikan stok sebelum menghapus
          $transaction->type == 'in'
            ? $item->quantity -= $detail->quantity
            : $item->quantity += $detail->quantity;

          $item->save();

          // Hapus detail transaksi
          $detail->delete();
        });

      DB::commit();

      Alert::success('Success', 'Transaction updated successfully.');
      return redirect()->route('transaction.index');
    } catch (Exception $e) {
      DB::rollBack();
      throw new Exception($e->getMessage());
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Transaction $transaction)
  {
    $transaction->delete();

    Alert::success('Success', 'Transaction deleted successfully.');

    return redirect()->route('transaction.index');
  }

  public function bulk_delete(Request $request)
  {
    $ids = $request->ids;
    Transaction::whereIn('id', $ids)->delete();

    return response()->json(['message' => 'Selected transactions deleted successfully!']);
  }

}
