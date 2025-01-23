<?php

namespace App\Traits;

use Yajra\DataTables\Facades\DataTables;

trait HasDataTablesActions
{
  public function generateDataTable($query, $routes, $additionalColumns = [])
  {
    return DataTables::of($query)
      ->addColumn('transaction_id', function ($row) {
        return $row->transaction->name ?? 'No Transaction ID';
      })
      ->addColumn('item', function ($row) {
        return $row->item->name ?? 'No Item';
      })
      ->addColumn('supplier', function ($row) {
        return $row->supplier->name ?? 'No Supplier';
      })
      ->addColumn('storage_location', function ($row) {
        return $row->storage_location->name ?? 'No Storage_location';
      })
      ->addColumn('category', function ($row) {
        return $row->category->name ?? 'No Category';
      })
      ->editColumn('unit_price', function ($row) {
        return 'Rp ' . number_format($row->unit_price, 0, ',', '.');
      })
      ->addColumn('action', function ($row) use ($routes) {
        $viewRoute = $routes['view'] ?? null;
        $editRoute = $routes['edit'] ?? null;
        $deleteRoute = $routes['delete'] ?? null;

        $actionButtons = '';

        if ($viewRoute) {
          $actionButtons .= '<a href="' . route($viewRoute, $row->id) . '" class="btn btn-sm btn-secondary btn-view-detail" data-id="' . $row->id . '">View</a> ';
        }

        if ($editRoute) {
          $actionButtons .= '<a href="' . route($editRoute, $row->id) . '" class="btn btn-sm btn-success btn-edit" data-id="' . $row->id . '">Edit</a> ';
        }

        if ($deleteRoute) {
          $actionButtons .= '
                        <form action="' . route($deleteRoute, $row->id) . '" method="post" class="d-inline" onclick="return confirm(`Are you sure want to delete this record?`)">
                            <input type="hidden" name="_token" value="' . csrf_token() . '">
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="btn btn-sm btn-danger btn-delete" data-id="' . $row->id . '">Delete</button>
                        </form>
                    ';
        }

        return $actionButtons;
      })
      ->editColumn('created_at', function ($row) {
        return $row->created_at->format('M j, Y');
      })
      ->editColumn('updated_at', function ($row) {
        return $row->updated_at->format('M j, Y');
      })
      ->addColumns($additionalColumns)
      ->rawColumns(['action'])
      ->make(true);
  }
}
