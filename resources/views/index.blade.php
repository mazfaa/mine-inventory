<x-app>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 items-center">Dashboard</h1>
    </div>

    <div class="row">
        <div class="col-md-3">
            <x-stats-card :title="'Total Items'" :stats="$total_items">
                <x-slot name="icon">
                    <i class="align-middle" data-feather="box"></i>
                </x-slot>
            </x-stats-card>
        </div>

        <div class="col-md-3">
            <x-stats-card :title="'Low Stock'" :stats="number_format($low_stock_items, 0, ',', '.')">
                <x-slot name="icon">
                    <i class="align-middle" data-feather="alert-triangle"></i>
                </x-slot>
            </x-stats-card>
        </div>

        <div class="col-md-3">
            <x-stats-card :title="'Stock In'" :stats="$total_stock_in">
                <x-slot name="icon">
                    <i class="align-middle" data-feather="log-in"></i>
                </x-slot>
            </x-stats-card>
        </div>

        <div class="col-md-3">
            <x-stats-card :title="'Stock Out'" :stats="$total_stock_out">
                <x-slot name="icon">
                    <i class="align-middle" data-feather="log-out"></i>
                </x-slot>
            </x-stats-card>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <h6 class="mb-4">Recent Activities</h6>
            <div class="card">
                <div class="card-body">
                    <table id="recentActivitiesTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Type</th>
                                <th>Quantity</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="scripts">
        <script>
            $(document).ready(function() {
                $('#recentActivitiesTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('dashboard.recent-activities') }}',
                    columns: [{
                            data: 'item_name',
                            name: 'item_name'
                        },
                        {
                            data: 'type',
                            name: 'type'
                        },
                        {
                            data: 'quantity',
                            name: 'quantity'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        }
                    ]
                });
            });
        </script>
    </x-slot>
</x-app>
