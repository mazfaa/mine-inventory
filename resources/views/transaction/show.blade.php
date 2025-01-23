<x-app>
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 items-center">{{ $item->name }}</h1>
  
    <a href="{{ route('item.index') }}" class="btn btn-sm btn-dark">
      <i class="align-middle" data-feather="corner-down-left"></i> Back to Item List
    </a>
  </div>

  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-body">
          <table class="table">
            <tr>
              <th>Name</th>
              <td>:</td>
              <td>{{ $item->name }}</td>
            </tr>

            <tr>
              <th>Description</th>
              <td>:</td>
              <td>{!! $item->description !!}</td>
            </tr>

            <tr>
              <th>Category</th>
              <td>:</td>
              <td>{{ $item->category->name }}</td>
            </tr>

            <tr>
              <th>SKU</th>
              <td>:</td>
              <td>{{ $item->sku }}</td>
            </tr>

            <tr>
              <th>Barcode</th>
              <td>:</td>
              <td>{{ $item->barcode }}</td>
            </tr>

            <tr>
              <th>Barcode Type</th>
              <td>:</td>
              <td>{{ $item->barcode_type }}</td>
            </tr>
          
            <tr>
              <th>Quantity</th>
              <td>:</td>
              <td>{!! $item->quantity !!}</td>
            </tr>

            <tr>
              <th>Min Stock</th>
              <td>:</td>
              <td>{{ $item->min_stock }}</td>
            </tr>

            <tr>
              <th>Unit Price</th>
              <td>:</td>
              <td>Rp {{ number_format($item->unit_price, 0, ',', '.') }}</td>
            </tr>
          
            <tr>
              <th>Created Date</th>
              <td>:</td>
              <td>{{ $item->created_at->format('M j, Y H:i:s') }}</td>
            </tr>
          
            <tr>
              <th>Last Updated</th>
              <td>:</td>
              <td>{{ $item->updated_at->format('M j, Y H:i:s') }}</td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
</x-app>