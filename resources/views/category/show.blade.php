<x-app>
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 items-center">{{ $category->name }}</h1>
  
    <a href="{{ route('category.index') }}" class="btn btn-sm btn-dark">
      <i class="align-middle" data-feather="corner-down-left"></i> Back to Category List
    </a>
  </div>

  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-body">
          <table class="table">
            <tr>
              <th>Name</th>
              <td>:</td>
              <td>{{ $category->name }}</td>
            </tr>
          
            <tr>
              <th>Description</th>
              <td>:</td>
              <td>{!! $category->description !!}</td>
            </tr>
          
            <tr>
              <th>Created Date</th>
              <td>:</td>
              <td>{{ $category->created_at->format('M j, Y H:i:s') }}</td>
            </tr>
          
            <tr>
              <th>Last Updated</th>
              <td>:</td>
              <td>{{ $category->updated_at->format('M j, Y H:i:s') }}</td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
</x-app>