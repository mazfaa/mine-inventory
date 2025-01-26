<x-app>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 items-center">Items</h1>

        <a href="{{ route('item.create') }}" class="btn btn-sm btn-dark" id="btnAddItem">New Item</a>
    </div>

    <div class="row">
        <div class="col-md-3">
            <x-stats-card :title="'Type'" :stats="$total_item">
                <x-slot name="icon">
                    <i class="align-middle" data-feather="box"></i>
                </x-slot>
            </x-stats-card>
        </div>

        <div class="col-md-3">
            <x-stats-card :title="'Stock'" :stats="$total_stock">
                <x-slot name="icon">
                    <i class="align-middle" data-feather="package"></i>
                </x-slot>
            </x-stats-card>
        </div>

        <div class="col-md-3">
            <x-stats-card :title="'Low Stock'" :stats="$low_stock_items">
                <x-slot name="icon">
                    <i class="align-middle" data-feather="alert-triangle"></i>
                </x-slot>
            </x-stats-card>
        </div>

        <div class="col-md-3">
            <x-stats-card :title="'Out Of Stock'" :stats="$out_of_stock">
                <x-slot name="icon">
                    <i class="align-middle" data-feather="alert-circle"></i>
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
                    <div class="mb-3">
                        <button id="filter-low-stock" class="btn btn-warning btn-sm">Show Low Stock</button>
                        <button id="clear-filter" class="btn btn-secondary btn-sm d-none">Show All</button>
                    </div>

                    <table id="items-table" class="table nowrap w-full">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" class="form-check-input" id="select-all">
                                </th>
                                <th>Image</th>
                                <th>SKU</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Barcode</th>
                                <th>Barcode Type</th>
                                <th>Initial Stock</th>
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
            $(function() {
                const table = $('#items-table').DataTable({
                    scrollX: true,
                    scrollCollapse: true,
                    fixedColumns: {
                        leftColumns: 2,
                        rightColumns: 1,
                    },
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('fetch-items') }}',
                    columns: [{
                            data: null,
                            render: (data, type, row) =>
                                `<input type="checkbox" class="row-checkbox form-check-input" data-id="${row.id}">`,
                            orderable: false,
                            searchable: false,
                        },
                        {
                            data: 'image',
                            name: 'image',
                            render: function(data, type, row) {
                                return `<img src="{{ asset('storage/${data}') }}" alt="${row.name}" class="img-thumbnail" style="width: 50px;">`;
                            },
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'sku',
                            name: 'sku'
                        },
                        {
                            data: 'name',
                            name: 'name',
                            render: function(data, type, row) {
                                // Menambahkan ikon ⚠️ dan tooltip jika stok rendah
                                if (row.quantity < row.min_stock) {
                                    return `
                            <span class="text-danger" title="Stock of this item is below minimum">
                                ⚠️
                            </span> ${data}`;
                                }
                                return data;
                            },
                        },
                        {
                            data: 'description',
                            name: 'description'
                        },
                        {
                            data: 'category',
                            name: 'category'
                        },
                        {
                            data: 'barcode',
                            name: 'barcode'
                        },
                        {
                            data: 'barcode_type',
                            name: 'barcode_type'
                        },
                        {
                            data: 'initial_stock',
                            name: 'initial_stock'
                        },
                        {
                            data: 'quantity',
                            name: 'quantity'
                        },
                        {
                            data: 'min_stock',
                            name: 'min_stock'
                        },
                        {
                            data: 'unit_price',
                            name: 'unit_price'
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
                        $(row).attr('data-url', `{{ url('item') }}/${data.id}`);

                        if (data.quantity < data.min_stock) {
                            $(row).addClass('low-stock');
                        }
                    }
                });

                table.order([table.column('created_at:name').index(), 'desc']).draw();

                $('#items-table tbody').on('click', '.clickable-row', function() {
                    const url = $(this).data('url');
                    window.location.href = url;
                });

                $('#items-table tbody').on('click', '.row-checkbox', function(e) {
                    e.stopPropagation();
                });

                table.on('draw', function() {
                    $('#items-table tbody').on('click', '.btn-delete', function(e) {
                        e.stopPropagation();
                    });
                });

                // Filter stok rendah
                $('#filter-low-stock').on('click', function() {
                    table.ajax.url('{{ route('fetch-items') }}?low_stock=1')
                        .load(); // Kirim parameter low_stock=1
                    $(this).addClass('d-none');
                    $('#clear-filter').removeClass('d-none');
                });

                $('#clear-filter').on('click', function() {
                    table.ajax.url('{{ route('fetch-items') }}').load(); // Kembali ke data tanpa filter
                    $(this).addClass('d-none');
                    $('#filter-low-stock').removeClass('d-none');
                });

                const bulkActionContainer = $('#bulk-action-container');
                const rowCheckboxes = '.row-checkbox';
                const selectAllCheckbox = $('#select-all');

                /**
                 * Update the visibility of the bulk action container.
                 */

                function updateBulkActionVisibility() {
                    const checkedCount = $(rowCheckboxes + ':checked').length;
                    bulkActionContainer.toggle(checkedCount > 0);
                }

                /**
                 * Get all selected IDs from the checkboxes.
                 */

                function getSelectedIds() {
                    const ids = $(rowCheckboxes + ':checked').map(function() {
                        return $(this).data('id');
                    }).get();

                    return ids;
                }

                /**
                 * Handle the bulk delete action.
                 */
                const handleBulkDelete = (selectedIds) => {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: `You are about to delete ${selectedIds.length} items.`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '{{ route('bulk-delete-items') }}',
                                method: 'POST',
                                data: {
                                    ids: selectedIds,
                                    _token: '{{ csrf_token() }}',
                                },
                                success: (response) => {
                                    Swal.fire({
                                        title: 'Deleted!',
                                        text: response.message,
                                        icon: 'success',
                                        timer: 2000,
                                        showConfirmButton: false,
                                    });
                                    table.ajax.reload();
                                    bulkActionContainer.hide();
                                },
                            });
                        }
                    });
                };

                /**
                 * Handle the bulk edit action.
                 */
                const handleBulkEdit = (selectedIds) => {
                    Swal.fire({
                        title: 'Bulk Edit',
                        text: `You selected ${selectedIds.length} items for editing.`,
                        icon: 'info',
                        timer: 2000,
                        showConfirmButton: false,
                    });

                    // Redirect to a bulk edit page
                    window.location.href = `/items/bulk-edit?ids=${selectedIds.join(',')}`;
                };

                // Event: Checkbox change
                $(document).on('change', rowCheckboxes, updateBulkActionVisibility);

                // Event: Select All
                selectAllCheckbox.on('change', function() {
                    const isChecked = $(this).is(':checked');
                    $(rowCheckboxes).prop('checked', isChecked).trigger('change');
                });

                // Event: Bulk Delete
                $('#bulk-delete').on('click', function(e) {
                    e.preventDefault();
                    const selectedIds = getSelectedIds();
                    if (selectedIds.length > 0) {
                        handleBulkDelete(selectedIds);
                    } else {
                        Swal.fire({
                            title: 'No items selected',
                            text: 'Please select at least one item to perform this action.',
                            icon: 'info',
                            timer: 2000,
                            showConfirmButton: false,
                        });
                    }
                });

                // Event: Bulk Edit
                $('#bulk-edit').on('click', function(e) {
                    e.preventDefault();
                    const selectedIds = getSelectedIds();
                    if (selectedIds.length > 0) {
                        handleBulkEdit(selectedIds);
                    } else {
                        Swal.fire({
                            title: 'No items selected',
                            text: 'Please select at least one item to perform this action.',
                            icon: 'info',
                            timer: 2000,
                            showConfirmButton: false,
                        });
                    }
                });
            });
        </script>
    </x-slot>
</x-app>
