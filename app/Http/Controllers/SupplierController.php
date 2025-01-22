<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierRequest;
use App\Models\Supplier;
use App\Traits\HasDataTablesActions;
use RealRashid\SweetAlert\Facades\Alert;

class SupplierController extends Controller
{
  use HasDataTablesActions;

  public function fetch_suppliers()
  {
    $query = Supplier::query();

    $routes = [
      'view' => 'supplier.show',
      'edit' => 'supplier.edit',
      'delete' => 'supplier.destroy'
    ];

    return $this->generateDataTable($query, $routes);
  }
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('supplier.index');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('supplier.form', [
      'method' => 'post',
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(SupplierRequest $request)
  {
    Supplier::create($request->all());

    Alert::success('Success', 'Supplier created successfully.');

    return redirect()->route('supplier.index');
  }

  /**
   * Display the specified resource.
   */
  public function show(Supplier $supplier)
  {
    return view('supplier.show', compact('supplier'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Supplier $supplier)
  {
    return view('supplier.form', [
      'method' => 'put',
      'supplier' => $supplier,
    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(SupplierRequest $request, Supplier $supplier)
  {
    $supplier->update($request->all());

    Alert::success('Success', 'Supplier updated successfully.');

    return redirect()->route('supplier.index');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Supplier $supplier)
  {
    $supplier->delete();

    Alert::success('Success', 'Supplier deleted successfully.');

    return redirect()->route('supplier.index');
  }
}
