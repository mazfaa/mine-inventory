<x-app>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 transactions-center">Transactions #{{ $transaction->id }} <span
                class="badge text-bg-{{ $transaction->type == 'in' ? 'primary' : 'danger' }}">Stock
                {{ ucfirst($transaction->type) }}</span>
        </h1>

        <a href="{{ route('transaction.index') }}" class="btn btn-sm btn-dark">
            <i class="align-middle" data-feather="corner-down-left"></i> Back to Transaction List
        </a>
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
            <x-stats-card :title="'Stock In'" :stats="$stock_in">
                <x-slot name="icon">
                    <i class="align-middle" data-feather="log-in"></i>
                </x-slot>
            </x-stats-card>
        </div>

        <div class="col-md-4">
            <x-stats-card :title="'Stock Out'" :stats="$stock_out">
                <x-slot name="icon">
                    <i class="align-middle" data-feather="log-out"></i>
                </x-slot>
            </x-stats-card>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <table id="detail-transactions-table" class="table nowrap w-full">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Supplier</th>
                                <th>Storage Location</th>
                                <th>Quantity</th>
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
                const table = $('#detail-transactions-table').DataTable({
                    scrollX: true,
                    scrollCollapse: true,
                    fixedColumns: {
                        leftColumns: 1,
                        rightColumns: 1,
                    },
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('fetch-detail-transactions', $transaction->id) }}',
                    columns: [{
                            data: 'item',
                            name: 'item'
                        },
                        {
                            data: 'supplier',
                            name: 'supplier',
                        },
                        {
                            data: 'storage_location',
                            name: 'storage_location',
                        },
                        {
                            data: 'quantity',
                            name: 'quantity',
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
