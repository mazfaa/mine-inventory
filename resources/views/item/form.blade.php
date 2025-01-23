<x-app>
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 items-center">{{ $method == 'post' ? 'New' : 'Edit' }} Item</h1>

    <a href="{{ route('item.index') }}" class="btn btn-sm btn-dark">
      <i class="align-middle" data-feather="corner-down-left"></i> Back to Item List
    </a>
  </div>

  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-body">
          <form action="{{ $method == 'post' ? route('item.store') : route('item.update', $item->id) }}" method="post">
            @csrf

            @if ($method == 'put')
              @method('put')
            @endif

            <div class="mb-3 d-flex gap-4">
              <div class="w-50">
                <x-form-label :for="'name'">Name *</x-form-label>
                <x-text-input :name="'name'" value="{{ $method == 'post' ? old('name') : old('name', $item->name) }}" />
              </div>

              <div class="w-50">
                <x-form-label :for="'category_id'">Category *</x-form-label>

                <div class="d-flex">
                  <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror">
                    @foreach ($categories as $category)
                      <option value="{{ $category->id }}" {{ old('category_id') == $category->id || $item->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                  </select>

                  <a href="{{ route('category.create') }}" class="btn border border-secondary-subtle">
                    <i class="align-middle" data-feather="plus"></i>
                  </a>
                </div>
                
                @error('category_id')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="mb-3">
              <x-form-label :for="'description'">Description *</x-form-label>
              <x-textarea :name="'description'" value="{{ $method == 'post' ? old('description') : old('description', $item->description) }}" />
            </div>

            <div class="mb-3 d-flex gap-4">
              <div class="flex-grow-1">
                <x-form-label :for="'sku'">SKU *</x-form-label>
                <x-text-input :name="'sku'" value="{{ $method == 'post' ? old('sku') : old('sku', $item->sku) }}" />
              </div>
            
              <div class="flex-grow-1">
                <x-form-label :for="'barcode'">Barcode *</x-form-label>
                <x-text-input :name="'barcode'" value="{{ $method == 'post' ? old('barcode') : old('barcode', $item->barcode) }}" />
              </div>
            </div>

            <div class="mb-3 d-flex gap-4">
              <div class="w-50">
                <x-form-label :for="'name'">Barcode Type *</x-form-label>
                <select name="barcode_type" id="barcode_type" class="form-select @error('barcode_type') is-invalid @enderror">
                  <option value="ISBN" {{ old('barcode_type') == 'ISBN' || $item->barcode_type == 'ISBN' ? 'selected' : '' }}>
                    ISBN
                  </option>
                  
                  <option value="UPC" {{ old('barcode_type') == 'UPC' || $item->barcode_type == 'UPC' ? 'selected' : '' }}>
                    UPC
                  </option>

                  <option value="GTIN" {{ old('barcode_type') == 'GTIN' || $item->barcode_type == 'GTIN' ? 'selected' : '' }}>
                    GTIN
                  </option>
                </select>

                @error('barcode_type')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            
              <div class="w-50">
                <x-form-label :for="'quantity'">Quantity *</x-form-label>
                <input type="number" name="quantity" class="form-control @error('quantity') is-invalid @enderror" id="quantity" value="{{ $method == 'post' ? old('quantity') : old('quantity', $item->quantity) }}" autocomplete="off" />

                @error('quantity')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="mb-3 d-flex gap-4">
              <div class="flex-grow-1">
                <x-form-label :for="'min_stock'">Minimum Stock *</x-form-label>
                <input type="number" name="min_stock" class="form-control @error('min_stock') is-invalid @enderror" id="min_stock" value="{{ $method == 'post' ? old('min_stock') : old('min_stock', $item->min_stock) }}" autocomplete="off" />

                @error('min_stock')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            
              <div class="flex-grow-1">
                <x-form-label :for="'unit_price'">Unit Price *</x-form-label>
                <input type="text" name="unit_price" class="form-control @error('unit_price') is-invalid @enderror price" id="unit_price" value="{{ $method == 'post' ? old('unit_price') : old('unit_price', $item->unit_price) }}" autocomplete="off" />

                @error('unit_price')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <x-submit-button />
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app>