<x-app>
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 items-center">{{ $method == 'post' ? 'New' : 'Edit' }} Supplier</h1>

    <a href="{{ route('supplier.index') }}" class="btn btn-sm btn-dark">
      <i class="align-middle" data-feather="corner-down-left"></i> Back to Supplier List
    </a>
  </div>

  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-body">
          <form action="{{ $method == 'post' ? route('supplier.store') : route('supplier.update', $supplier->id) }}" method="post">
            @csrf

            @if ($method == 'put')
              @method('put')
            @endif

            <div class="mb-3 d-flex gap-4">
              <div class="flex-grow-1">
                <x-form-label :for="'name'">Name *</x-form-label>
                <x-text-input :name="'name'" value="{{ $method == 'post' ? old('name') : old('name', $supplier->name) }}" />
              </div>

              <div class="flex-grow-1">
                <x-form-label :for="'phone'">Phone *</x-form-label>
                <x-text-input :name="'phone'" value="{{ $method == 'post' ? old('phone') : old('phone', $supplier->phone) }}" />
              </div>
            </div>

            <div class="mb-3">
              <x-form-label :for="'address'">Address *</x-form-label>
              <x-textarea :name="'address'" value="{{ $method == 'post' ? old('address') : old('address', $supplier->address) }}" />
            </div>

            <x-submit-button />
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app>