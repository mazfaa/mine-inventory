<x-app>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 transactions-center">Transactions</h1>

        <a href="{{ route('transaction.create') }}" class="btn btn-sm btn-dark" id="btnAddTransaction">New Transaction</a>
    </div>

    <div class="row">
        <div class="col-md-4">
            <x-stats-card :title="'Total Transaction'" :stats="$total_transaction">
                <x-slot name="icon">
                    <i class="align-middle" data-feather="plus-circle"></i>
                </x-slot>
            </x-stats-card>
        </div>

        <div class="col-md-4">
            <x-stats-card :title="'Stock In Transaction'" :stats="$stock_in">
                <x-slot name="icon">
                    <i class="align-middle" data-feather="log-in"></i>
                </x-slot>
            </x-stats-card>
        </div>

        <div class="col-md-4">
            <x-stats-card :title="'Stock Out Transaction'" :stats="$stock_out">
                <x-slot name="icon">
                    <i class="align-middle" data-feather="log-out"></i>
                </x-slot>
            </x-stats-card>
        </div>
    </div>

    <div id="bulk-action-container" style="display: none; margin-bottom: 10px;">
        <div class="btn-group">
            <button id="bulk-delete" class="btn btn-danger">Bulk Delete</button>
            <button id="bulk-edit" class="btn btn-primary">Bulk Edit</button>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <label for="filter-type" class="form-label align-self-center me-2">Filter by:</label>
                        <select id="filter-type" class="form-select form-select-sm" style="width: 150px;">
                            <option value="">All</option>
                            <option value="in">Stock In</option>
                            <option value="out">Stock Out</option>
                        </select>
                    </div>


                    <table id="transactions-table" class="table nowrap w-full">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" class="form-check-input" id="select-all">
                                </th>
                                <th>Code</th>
                                <th>Type</th>
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
            $(function() {
                const table = $('#transactions-table').DataTable({
                    scrollX: true,
                    scrollCollapse: true,
                    fixedColumns: {
                        leftColumns: 2,
                        rightColumns: 1,
                    },
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('fetch-transactions') }}',
                        data: function(d) {
                            d.type = $('#filter-type').val(); // Kirim filter ke server
                        },
                    },
                    columns: [{
                            data: null,
                            render: (data, type, row) =>
                                `<input type="checkbox" class="row-checkbox form-check-input" data-id="${row.id}">`,
                            orderable: false,
                            searchable: false,
                        },
                        {
                            data: 'code',
                            name: 'code'
                        },
                        {
                            data: 'type',
                            name: 'type'
                        },
                        {
                            data: 'description',
                            name: 'description',
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                        {
                            data: 'updated_at',
                            name: 'updated_at'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ],
                    rowCallback: function(row, data) {
                        $(row).addClass('clickable-row');
                        $(row).attr('data-url', `{{ url('transaction') }}/${data.id}`);
                    }
                });

                table.order([table.column('created_at:name').index(), 'desc']).draw();

                $('#filter-type').on('change', function() {
                    table.draw(); // Refresh tabel saat dropdown diubah
                });

                $('#transactions-table tbody').on('click', '.clickable-row', function() {
                    const url = $(this).data('url');
                    window.location.href = url;
                });

                $('#transactions-table tbody').on('click', '.row-checkbox', function(e) {
                    e.stopPropagation();
                });

                table.on('draw', function() {
                    $('#transactions-table tbody').on('click', '.btn-delete', function(e) {
                        e.stopPropagation();
                    });
                });
            });
        </script>
    </x-slot>
</x-app>
