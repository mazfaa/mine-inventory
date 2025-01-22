<x-app>
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 items-center">Suppliers</h1>

    <a href="{{ route('supplier.create') }}" class="btn btn-sm btn-dark" id="btnAddSupplier">New Supplier</a>
  </div>

  <div class="row">
    <div class="col-xl-12 col-md-12 col-sm-12">
      <div class="card">
        <div class="card-body">
          <table id="suppliers-table" class="table nowrap w-full">
            <thead>
              <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Address</th>
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
        $('#suppliers-table').DataTable({
          scrollX: true,
          processing: true,
          serverSide: true,
          ajax: '{{ route('fetch-suppliers') }}',
          columns: [
            { data: 'name', name: 'name' },
            { data: 'phone', name: 'phone' },
            { data: 'address', name: 'address' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
          ]
        });
      });
    </script>
  </x-slot>
</x-app>