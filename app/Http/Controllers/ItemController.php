<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Models\Category;
use App\Models\Item;
use App\Traits\HasDataTablesActions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ItemController extends Controller
{
  use HasDataTablesActions;

  public function fetch_items()
  {
    $query = Item::with('category');

    $routes = [
      'view' => 'item.show',
      'edit' => 'item.edit',
      'delete' => 'item.destroy'
    ];

    return $this->generateDataTable($query, $routes);
  }

  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('item.index', [
      'total_item' => Item::count(),
      'total_stock' => Item::sum('quantity'),
      'total_price' => Item::sum(DB::raw('quantity * unit_price')),
      'average_price' => Item::avg('unit_price'),
    ]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('item.form', [
      'item' => new Item,
      'method' => 'post',
      'categories' => Category::select('id', 'name')->get(),
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(ItemRequest $request)
  {
    $request['unit_price'] = (int) str_replace('.', '', $request->unit_price);

    Item::create($request->all());

    Alert::success('Success', 'Storage Location created successfully.');

    return redirect()->route('item.index');
  }

  /**
   * Display the specified resource.
   */
  public function show(Item $item)
  {
    return view('item.show', compact('item'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Item $item)
  {
    $item->unit_price = number_format($item->unit_price, 0, ',', '.');

    return view('item.form', [
      'item' => $item,
      'method' => 'put',
      'categories' => Category::select('id', 'name')->get(),
    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(ItemRequest $request, Item $item)
  {
    $request['unit_price'] = (int) str_replace('.', '', $request->unit_price);

    $item->update($request->all());

    Alert::success('Success', 'Storage Location updated successfully.');

    return redirect()->route('item.index');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Item $item)
  {
    $item->delete();

    Alert::success('Success', 'Storage Location deleted successfully.');

    return redirect()->route('item.index');
  }

  public function bulk_delete(Request $request)
  {
    $ids = $request->ids;
    Item::whereIn('id', $ids)->delete();

    return response()->json(['message' => 'Selected items deleted successfully!']);
  }

}
