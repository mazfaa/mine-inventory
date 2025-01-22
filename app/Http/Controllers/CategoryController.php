<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Traits\HasDataTablesActions;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
  use HasDataTablesActions;

  public function fetch_categories()
  {
    $query = Category::query();

    $routes = [
      'view' => 'category.show',
      'edit' => 'category.edit',
      'delete' => 'category.destroy'
    ];

    return $this->generateDataTable($query, $routes);
  }

  // public function fetch_categories()
  // {
  //   $collection = Category::query();

  //   return DataTables::of($collection)
  //     ->addColumn('action', function ($row) {
  //       return '
  //         <a href="' . route('category.show', $row->id) . '" class="btn btn-sm btn-secondary btn-view-detail" data-id="' . $row->id . '">View</a>
  //         <a href="' . route('category.edit', $row->id) . '" class="btn btn-sm btn-success btn-edit" data-id="' . $row->id . '">Edit</a>

  //         <form action="' . route('category.destroy', $row->id) . '" method="post" class="d-inline" onclick="return confirm(`Are you sure want to delete this record?`)">
  //           <input type="hidden" name="_token" value="' . csrf_token() . '">
  //           <input type="hidden" name="_method" value="DELETE">
  //           <button class="btn btn-sm btn-danger btn-delete" data-id="' . $row->id . '">Delete</button>
  //         </form>
  //       ';
  //     })
  //     ->editColumn('created_at', function ($row) {
  //       return $row->created_at->format('M j, Y');
  //     })
  //     ->editColumn('updated_at', function ($row) {
  //       return $row->updated_at->format('M j, Y');
  //     })
  //     ->rawColumns(['action'])->make(true);
  // }
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('category.index');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('category.form', [
      'method' => 'post',
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(CategoryRequest $request)
  {
    Category::create($request->all());

    Alert::success('Success', 'Category created successfully.');

    return redirect()->route('category.index');
  }

  /**
   * Display the specified resource.
   */
  public function show(Category $category)
  {
    return view('category.show', compact('category'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Category $category)
  {
    return view('category.form', [
      'method' => 'put',
      'category' => $category,
    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(CategoryRequest $request, Category $category)
  {
    $category->update($request->all());

    Alert::success('Success', 'Category updated successfully.');

    return redirect()->route('category.index');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Category $category)
  {
    $category->delete();

    Alert::success('Success', 'Category deleted successfully.');

    return redirect()->route('category.index');
  }
}
