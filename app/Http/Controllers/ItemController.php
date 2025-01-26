<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Models\Category;
use App\Models\Item;
use App\Models\ItemImage;
use App\Traits\HasDataTablesActions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ItemController extends Controller
{
  use HasDataTablesActions;

  public function fetch_items(Request $request)
  {
    // $query = Item::with('category');

    $query = Item::with([
      'category',
      'item_images' => function ($q) {
        $q->where('is_primary', true);
      }
    ]);

    if ($request->has('low_stock') && $request->low_stock) {
      $query->whereColumn('quantity', '<', 'min_stock');
    }

    $routes = [
      'view' => 'item.show',
      'edit' => 'item.edit',
      'delete' => 'item.destroy'
    ];

    return $this->generateDataTable($query, $routes, [
      'category' =>
        function ($row) {
          return $row->category->name ?? 'No Category';
        },
    ], [
      'unit_price' =>
        function ($row) {
          return 'Rp ' . number_format($row->unit_price, 0, ',', '.');
        }
    ]);
  }

  public function item_image_upload(Request $request)
  {
    dd($request->file);
  }

  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    // dd(Item::where('quantity', '<', 'min_stock')->count());
    return view('item.index', [
      'total_item' => Item::count(),
      'out_of_stock' => Item::where('quantity', 0)->count(),
      'total_stock' => Item::sum('quantity'),
      'low_stock_items' => Item::whereRaw('quantity < min_stock')->count(),
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
    // dd($request->file('image'));
    try {
      DB::beginTransaction();

      $request['initial_stock'] = $request->quantity;
      $request['unit_price'] = (int) str_replace('.', '', $request->unit_price);

      $item = Item::create($request->all());

      if ($request->hasFile('image')) {
        $image = $request->file('image');

        // Generate a unique filename with a proper extension
        $filename = uniqid() . '-' . $item->sku . '-' . str_replace(' ', '_', $item->name) . '.' . $image->extension();

        // Store the file in the public storage directory
        $path = $image->storeAs('img/items', $filename, 'public');
      }

      // Update the item's image field with the stored file path
      $item->update(['image' => $path ?? 'img/items/default.png']);


      DB::commit();

      Alert::success('Success', 'Item created successfully.');

      return redirect()->route('item.index');
    } catch (\Exception $e) {
      DB::rollback();
      throw new \Exception($e->getMessage());
    }
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
    try {
      DB::beginTransaction();

      // Konversi unit_price ke integer
      $request['unit_price'] = (int) str_replace('.', '', $request->unit_price);

      // Cek apakah ada gambar baru yang diunggah
      if ($request->hasFile('image')) {
        $image = $request->file('image');

        // Generate nama file unik dengan ekstensi yang sesuai
        $filename = uniqid() . '-' . $item->sku . '-' . str_replace(' ', '_', $item->name) . '.' . $image->extension();

        // Simpan file ke direktori public storage
        $path = $image->storeAs('img/items', $filename, 'public');

        // Hapus gambar lama jika ada
        if ($item->image && Storage::disk('public')->exists($item->image)) {
          if ($item->image != 'img/items/default.png') {
            Storage::disk('public')->delete($item->image);
          }
        }

        // Update field `image` pada item
        // $request['image'] = $path;
      }

      // dd($path);
      // Update data item
      $item->update($request->all());
      $item->update(['image' => $path ?? $item->image]);

      DB::commit();

      Alert::success('Success', 'Item updated successfully.');

      return redirect()->route('item.index');
    } catch (\Exception $e) {
      DB::rollback();
      throw new \Exception($e->getMessage());
    }
  }


  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Item $item)
  {
    $item->delete();

    Alert::success('Success', 'Item deleted successfully.');

    return redirect()->route('item.index');
  }

  public function bulk_delete(Request $request)
  {
    $ids = $request->ids;
    Item::whereIn('id', $ids)->delete();

    return response()->json(['message' => 'Selected items deleted successfully!']);
  }
}
