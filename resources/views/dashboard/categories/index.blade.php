@extends('dashboard.layouts.main')

@section('container')
    
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Posts Categories</h1>
  </div>
  <div class="table-responsive col-lg-6">
    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Create new category</a>

    @if (session()->has('success'))
    <div class="alert alert-success" role="alert">
      {{ session('success') }}
    </div>    
    @endif

    <table class="table table-striped table-sm align-middle">
      <thead>
        <tr>
          <th>#</th>
          <th>Category Name</th>
          <th class="disabled-sorting text-right">Actions</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th>#</th>
          <th>Category Name</th>
          <th class="disabled-sorting text-right">Actions</th>
        </tr>
      </tfoot>
      <tbody>

        @foreach ($categories as $category)
            
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $category->name }}</td>
          <td>
            <a href="{{ route('categories.edit', $category->slug) }}" class="badge bg-warning">
              <span data-feather="edit"></span>
            </a>
            <form action="{{ route('categories.destroy', $category->slug) }}" method="post" class="d-inline">
              @method('DELETE')
              @csrf
              <button class="badge bg-info border-0" onclick="return confirm('Are you sure?')"><span data-feather="x-circle"></span></button>
            </form>
          </td>
        </tr>
        @endforeach

      </tbody>
    </table>
  </div>

@if (isset($createCategory))    
<!-- Modal -->
<div class="modal fade" id="create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Create new category</h5>
        <button type="button" class="btn-close" onclick="history.back()"></button>
      </div>
      <div class="modal-body">
        
        <form method="POST" action="{{ route('categories.store') }}" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">
            <label for="name" class="form-label">Category name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required autofocus value="{{ old('name') }}">
            @error('name')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
            @enderror
          </div>
          
          <div class="mb-3">
            <label for="slug" class="form-label">Category slug</label>
            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" required value="{{ old('slug') }}">
            @error('slug')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>          
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" onclick="history.back()">Close</button>
          <button type="submit" class="btn btn-primary">Create new category</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
  $("#create").modal('show');
});
const name = document.querySelector('#name');
const slug = document.querySelector('#slug');

name.addEventListener('change', function(){
  fetch('/checkSlug?name=' + name.value)
  .then(response => response.json())
  .then(data => slug.value = data.slug);
});

</script>

@endif

@if (isset($editCategory))    
<!-- Modal -->
<div class="modal fade" id="create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" onclick="history.back()"></button>
      </div>
      <div class="modal-body">
        
        <form method="POST" action="/dashboard/categories/{{ route('categories.update',$editCategory->slug) }}" enctype="multipart/form-data">
          @method('PUT')
          @csrf
          <div class="mb-3">
            <label for="name" class="form-label">Category name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required autofocus value="{{ old('name', $editCategory->name) }}">
            @error('name')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
            @enderror
          </div>
          
          <div class="mb-3">
            <label for="slug" class="form-label">Category slug</label>
            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" required value="{{ old('slug', $editCategory->slug) }}">
            @error('slug')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>       
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" onclick="history.back()">Close</button>
          <button type="submit" class="btn btn-primary">Change the category</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
  $("#create").modal('show');
});
const name = document.querySelector('#name');
const slug = document.querySelector('#slug');

name.addEventListener('change', function(){
  fetch('/checkSlug?name=' + name.value)
  .then(response => response.json())
  .then(data => slug.value = data.slug);
});
</script>

@endif

@endsection