<x-app>
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 items-center">Items</h1>

    <a href="{{ route('item.create') }}" class="btn btn-sm btn-dark" id="btnAddItem">New Item</a>
  </div>

  <div class="row">
    <div class="col-xl-12 col-md-12 col-sm-12">
      <div class="card">
        <div class="card-body">
          <table id="items-table" class="table nowrap w-full">
            <thead>
              <tr>
                <th>SKU</th>
                <th>Name</th>
                <th>Description</th>
                <th>Category</th>
                <th>Barcode</th>
                <th>Barcode Type</th>
                <th>Quantity</th>
                <th>Min Stock</th>
                <th>Unit Price</th>
                <th>Created Date</th>
                <th>Last Updated</th>
                <th></th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>

  <x-slot name="scripts">
    <script>
      $(function () {
        $('#items-table').DataTable({
           order: [[9, 'desc']],
          scrollX: true,
          processing: true,
          serverSide: true,
          ajax: '{{ route('fetch-items') }}',
          columns: [
            { data: 'sku', name: 'sku' },
            { data: 'name', name: 'name' },
            { data: 'description', name: 'description' },
            { data: 'category', name: 'category' },
            { data: 'barcode', name: 'barcode' },
            { data: 'barcode_type', name: 'barcode_type' },
            { data: 'quantity', name: 'quantity' },
            { data: 'min_stock', name: 'min_stock' },
            { data: 'unit_price', name: 'unit_price' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
          ]
        });
      });
    </script>
  </x-slot>
</x-app>