<x-app>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 transactions-center">{{ $method == 'post' ? 'New' : 'Edit' }} Transaction</h1>

        <a href="{{ route('transaction.index') }}" class="btn btn-sm btn-dark">
            <i class="align-middle" data-feather="corner-down-left"></i> Back to Transaction List
        </a>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <form
                action="{{ $method == 'post' ? route('transaction.store') : route('transaction.update', $transaction->id) }}"
                method="post">
                @csrf

                @if ($method == 'put')
                    @method('put')
                @endif

                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <x-form-label :for="'type'">Type *</x-form-label>
                            <select name="type" id="type"
                                class="form-select @error('type') is-invalid @enderror">
                                <option value="in">Stock In</option>
                                <option value="out">Stock Out</option>
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <x-form-label :for="'description'">Description *</x-form-label>
                            <x-textarea :name="'description'"
                                value="{{ $method == 'post' ? old('description') : old('description', $transaction->description) }}" />
                        </div>
                    </div>
                </div>

                <div class="item-container">
                    <div class="card item-card">
                        <div class="card-body">
                            <div class="mb-3 d-flex gap-4">
                                <div class="w-50">
                                    <x-form-label :for="'item'">Item *</x-form-label>
                                    <div class="d-flex">
                                        <select name="transactions[0][item_id]" id="item_id"
                                            class="form-select item-select @error('transactions.0.item_id') is-invalid @enderror">
                                            <option>Select Item</option>
                                            @foreach ($items as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ old('transactions.0.item_id') == $item->id || $transaction->item_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>

                                        <a href="{{ route('item.create') }}" class="btn border border-secondary-subtle">
                                            <i class="align-middle" data-feather="plus"></i>
                                        </a>
                                    </div>

                                    @error('transactions.0.item_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="w-50">
                                    <x-form-label :for="'quantity'">Quantity *</x-form-label>
                                    <input type="number" name="transactions[0][quantity]"
                                        class="form-control @error('transactions.0.quantity') is-invalid @enderror"
                                        id="quantity"
                                        value="{{ $method == 'post' ? old('transactions.0.quantity') : old('transactions.0.quantity', $item->quantity) }}"
                                        autocomplete="off" />

                                    @error('transactions.0.quantity')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 d-flex gap-4">
                                <div class="flex-grow-1">
                                    <x-form-label :for="'supplier'">Supplier *</x-form-label>
                                    <div class="d-flex">
                                        <select name="transactions[0][supplier_id]" id="supplier_id"
                                            class="form-select @error('transactions.0.supplier_id') is-invalid @enderror">
                                            @foreach ($suppliers as $supplier)
                                                <option value="{{ $supplier->id }}"
                                                    {{ old('transactions.0.supplier_id') == $supplier->id || $transaction->supplier_id == $supplier->id ? 'selected' : '' }}>
                                                    {{ $supplier->name }}</option>
                                            @endforeach
                                        </select>

                                        <a href="{{ route('supplier.create') }}"
                                            class="btn border border-secondary-subtle">
                                            <i class="align-middle" data-feather="plus"></i>
                                        </a>
                                    </div>

                                    @error('transactions.0.supplier_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="flex-grow-1">
                                    <x-form-label :for="'storage_location'">Storage Location *</x-form-label>
                                    <div class="d-flex">
                                        <select name="transactions[0][storage_location_id]" id="storage_location_id"
                                            class="form-select @error('transactions.0.storage_location_id') is-invalid @enderror">
                                            @foreach ($storage_locations as $storage_location)
                                                <option value="{{ $storage_location->id }}"
                                                    {{ old('transactions.0.storage_location_id') == $storage_location->id || $transaction->storage_location_id == $storage_location->id ? 'selected' : '' }}>
                                                    {{ $storage_location->name }}</option>
                                            @endforeach
                                        </select>

                                        <a href="{{ route('storage-location.create') }}"
                                            class="btn border border-secondary-subtle">
                                            <i class="align-middle" data-feather="plus"></i>
                                        </a>
                                    </div>

                                    @error('transactions.0.storage_location_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('transaction.index') }}" class="btn btn-outline-secondary">
                        Back
                    </a>
                    <button type="button" id="addItemBtn" class="btn btn-outline-secondary">Add
                        Item</button>
                    <x-submit-button />
                </div>
            </form>
        </div>
    </div>

    <x-slot name="scripts">
        <script>
            $(function() {
                const addItemBtn = $('#addItemBtn');
                const itemCardContainer = $('.item-container');

                addItemBtn.on('click', function() {
                    const itemLength = itemCardContainer.find('.item-card').length;

                    itemCardContainer.append(`
                    <div class="card item-card" id="item-card-${itemLength}">
                        <div class="card-header border">
                                <button type="button" class="btn btn-danger remove-item-btn" data-id="${itemLength}">Remove</button>
                        </div>

                        <div class="card-body">
                            <div class="mb-3 d-flex gap-4">
                                <div class="w-50">
                                  <x-form-label :for="'item'">Item *</x-form-label>
                                  <div class="d-flex">
                                      <select name="transactions[${itemLength}][item_id]" id="item_id"
                                          class="form-select item-select @error('transactions.${itemLength}.item_id') is-invalid @enderror">
                                          <option>Select Item</option>
                                          @foreach ($items as $item)
                                              <option value="{{ $item->id }}"
                                                  {{ old('transactions.${itemLength}.item_id') == $item->id || $transaction->item_id == $item->id ? 'selected' : '' }}>
                                                  {{ $item->name }}</option>
                                          @endforeach
                                      </select>

                                      <a href="{{ route('item.create') }}" class="btn border border-secondary-subtle">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus align-middle"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                      </a>
                                  </div>

                                  @error('transactions.${itemLength}.item_id')
                                      <div class="invalid-feedback">{{ $message }}</div>
                                  @enderror
                                </div>

                                <div class="w-50">
                                    <x-form-label :for="'quantity'">Quantity *</x-form-label>
                                    <input type="number" name="transactions[${itemLength}][quantity]"
                                        class="form-control @error('transactions.${itemLength}.quantity') is-invalid @enderror"
                                        id="quantity"
                                        value="{{ $method == 'post' ? old('transactions.${itemLength}.quantity') : old('transactions.${itemLength}.quantity', $item->quantity) }}"
                                        autocomplete="off" />

                                    @error('transactions.${itemLength}.quantity')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 d-flex gap-4">
                                <div class="flex-grow-1">
                                    <x-form-label :for="'supplier'">Supplier *</x-form-label>
                                    <div class="d-flex">
                                        <select name="transactions[${itemLength}][supplier_id]" id="supplier_id"
                                            class="form-select @error('transactions.${itemLength}.supplier_id') is-invalid @enderror">
                                            @foreach ($suppliers as $supplier)
                                                <option value="{{ $supplier->id }}"
                                                    {{ old('transactions.${itemLength}.supplier_id') == $supplier->id || $transaction->supplier_id == $supplier->id ? 'selected' : '' }}>
                                                    {{ $supplier->name }}</option>
                                            @endforeach
                                        </select>

                                        <a href="{{ route('supplier.create') }}"
                                            class="btn border border-secondary-subtle">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus align-middle"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                        </a>
                                    </div>

                                    @error('transactions.${itemLength}.supplier_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="flex-grow-1">
                                    <x-form-label :for="'storage_location'">Storage Location *</x-form-label>
                                    <div class="d-flex">
                                        <select name="transactions[${itemLength}][storage_location_id]" id="storage_location_id"
                                            class="form-select @error('transactions.${itemLength}.storage_location_id') is-invalid @enderror">
                                            @foreach ($storage_locations as $storage_location)
                                                <option value="{{ $storage_location->id }}"
                                                    {{ old('transactions.${itemLength}.storage_location_id') == $storage_location->id || $transaction->storage_location_id == $storage_location->id ? 'selected' : '' }}>
                                                    {{ $storage_location->name }}</option>
                                            @endforeach
                                        </select>

                                        <a href="{{ route('storage-location.create') }}"
                                            class="btn border border-secondary-subtle">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus align-middle"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                        </a>
                                    </div>

                                    @error('transactions.${itemLength}.storage_location_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                  `);

                    updateDisabledItems();
                })

                function updateDisabledItems() {
                    // Ambil semua opsi yang sudah dipilih
                    const selectedItems = [];
                    itemCardContainer.find('select[name^="transactions"][name$="[item_id]"]').each(function() {
                        const selectedValue = $(this).val();
                        if (selectedValue) {
                            selectedItems.push(selectedValue);
                        }
                    });

                    // Update disabled status untuk semua dropdown
                    itemCardContainer.find('select[name^="transactions"][name$="[item_id]"]').each(function() {
                        const currentSelect = $(this);
                        const currentValue = currentSelect.val();

                        currentSelect.find('option').each(function() {
                            const option = $(this);
                            const optionValue = option.val();

                            if (optionValue && selectedItems.includes(optionValue) && optionValue !==
                                currentValue) {
                                option.prop('disabled', true);
                            } else {
                                option.prop('disabled', false);
                            }
                        });
                    });
                }

                itemCardContainer.on('click', '.remove-item-btn', function() {
                    $(this).closest('.item-card').remove();
                    updateDisabledItems();
                });

                // Event handler untuk perubahan pada select
                itemCardContainer.on('change', '.item-select', function() {
                    updateDisabledItems();
                });
            });
        </script>
    </x-slot>
</x-app>
