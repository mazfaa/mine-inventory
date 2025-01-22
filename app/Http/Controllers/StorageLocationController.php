<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorageLocationRequest;
use App\Models\StorageLocation;
use App\Traits\HasDataTablesActions;
use RealRashid\SweetAlert\Facades\Alert;

class StorageLocationController extends Controller
{
  use HasDataTablesActions;

  public function fetch_storage_locations()
  {
    $query = StorageLocation::query();

    $routes = [
      'view' => 'storage-location.show',
      'edit' => 'storage-location.edit',
      'delete' => 'storage-location.destroy'
    ];

    return $this->generateDataTable($query, $routes);
  }
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('storage-location.index');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('storage-location.form', [
      'method' => 'post',
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StorageLocationRequest $request)
  {
    StorageLocation::create($request->all());

    Alert::success('Success', 'Storage Location created successfully.');

    return redirect()->route('storage-location.index');
  }

  /**
   * Display the specified resource.
   */
  public function show(StorageLocation $storageLocation)
  {
    return view('storage-location.show', compact('storageLocation'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(StorageLocation $storageLocation)
  {
    return view('storage-location.form', [
      'method' => 'put',
      'storageLocation' => $storageLocation,
    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(StorageLocationRequest $request, StorageLocation $storageLocation)
  {
    $storageLocation->update($request->all());

    Alert::success('Success', 'Storage Location updated successfully.');

    return redirect()->route('storage-location.index');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(StorageLocation $storageLocation)
  {
    $storageLocation->delete();

    Alert::success('Success', 'Storage Location deleted successfully.');

    return redirect()->route('storage-location.index');
  }
}
