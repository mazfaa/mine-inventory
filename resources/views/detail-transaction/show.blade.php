<x-app>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 transactions-center">Detail Transaction #{{ $detail_transaction->id }}</h1>

        <a href="{{ route('transaction.show', $detail_transaction->id) }}" class="btn btn-sm btn-dark">
            <i class="align-middle" data-feather="corner-down-left"></i> Back to Detail Transaction
            #{{ $detail_transaction->id }} List
        </a>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Transaction ID</th>
                            <td>:</td>
                            <td>{{ $detail_transaction->transaction->id }}</td>
                        </tr>

                        <tr>
                            <th>Item</th>
                            <td>:</td>
                            <td>{{ $detail_transaction->item->name }}</td>
                        </tr>

                        <tr>
                            <th>Quantity</th>
                            <td>:</td>
                            <td>{{ $detail_transaction->quantity }}</td>
                        </tr>

                        <tr>
                            <th>Type</th>
                            <td>:</td>
                            <td>
                                <span
                                    class="badge text-bg-{{ $detail_transaction->transaction->type == 'in' ? 'primary' : 'danger' }}">Stock
                                    {{ ucfirst($detail_transaction->transaction->type) }}</span>
                            </td>
                        </tr>

                        <tr>
                            <th>Description</th>
                            <td>:</td>
                            <td>{{ $detail_transaction->transaction->description ?? '-' }}</td>
                        </tr>

                        <tr>
                            <th>Supplier</th>
                            <td>:</td>
                            <td>{{ $detail_transaction->supplier->name }}</td>
                        </tr>

                        <tr>
                            <th>Storage Location</th>
                            <td>:</td>
                            <td>{{ $detail_transaction->storage_location->name }}</td>
                        </tr>

                        <tr>
                            <th>Created Date</th>
                            <td>:</td>
                            <td>{{ $detail_transaction->created_at->format('M j, Y H:i:s') }}</td>
                        </tr>

                        <tr>
                            <th>Last Updated</th>
                            <td>:</td>
                            <td>{{ $detail_transaction->updated_at->format('M j, Y H:i:s') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app>
