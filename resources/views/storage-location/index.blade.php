<x-app>
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 items-center">Storage Locations</h1>

    <a href="{{ route('storage-location.create') }}" class="btn btn-sm btn-dark" id="btnAddStorageLocation">New Storage Location</a>
  </div>
  
  <div class="row">
    <div class="col-xl-12 col-md-12 col-sm-12">
      <div class="card">
        <div class="card-body">
          <table id="storage-locations-table" class="table nowrap w-full">
            <thead>
              <tr>
                <th>Name</th>
                <th>Description</th>
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
          $('#storage-locations-table').DataTable({
            scrollX: true,
            processing: true,
            serverSide: true,
            ajax: '{{ route('fetch-storage-locations') }}',
            columns: [
              { data: 'name', name: 'name' },
              { data: 'description', name: 'description' },
              { data: 'created_at', name: 'created_at' },
              { data: 'updated_at', name: 'updated_at' },
              { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
          });
        });
    </script>
  </x-slot>
</x-app>