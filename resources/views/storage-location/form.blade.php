<x-app>
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 items-center">{{ $method == 'post' ? 'New' : 'Edit' }} Storage Location</h1>

    <a href="{{ route('storage-location.index') }}" class="btn btn-sm btn-dark">
      <i class="align-middle" data-feather="corner-down-left"></i> Back to Storage Location List
    </a>
  </div>

  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-body">
          <form action="{{ $method == 'post' ? route('storage-location.store') : route('storage-location.update', $storageLocation->id) }}" method="post">
            @csrf

            @if ($method == 'put')
              @method('put')
            @endif

            <div class="mb-3">
              <x-form-label :for="'name'">Name *</x-form-label>
              <x-text-input :name="'name'" value="{{ $method == 'post' ? old('name') : old('name', $storageLocation->name) }}" />
            </div>

            <div class="mb-3">
              <x-form-label :for="'description'">Description</x-form-label>
              <x-textarea :name="'description'" value="{{ $method == 'post' ? old('description') : old('description', $storageLocation->description) }}" />
            </div>

            <x-submit-button />
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app>