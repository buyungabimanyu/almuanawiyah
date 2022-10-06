@extends('dashboard.layouts.main')

@section('container')
    
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Posts Categories</h1>
  </div>
  <div class="table-responsive col-lg-6">
    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Create new post</a>

    @if (session()->has('success'))
    <div class="alert alert-success" role="alert">
      {{ session('success') }}
    </div>    
    @endif

    <table class="table table-striped table-sm align-middle">
      <thead>
        <tr>
          <th>#</th>
          <th>Category Icon</th>
          <th>Category Name</th>
          <th class="disabled-sorting text-right">Actions</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th>#</th>
          <th>Category Icon</th>
          <th>Category Name</th>
          <th class="disabled-sorting text-right">Actions</th>
        </tr>
      </tfoot>
      <tbody>

        @foreach ($categories as $category)
            
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>
            <span class="avatar avatar-sm rounded-circle">
              @if ($category->image)
                <img src="{{ asset('/storage/' . $category->image) }}" alt="" style="max-width: 80px; border-radiu: 100px">
              @else                
                <img src="{{asset('img/apple-icon.png')}}" alt="" style="max-width: 80px; border-radiu: 100px">
              @endif
            </span>
          </td>
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
        
        <form method="POST" action="/dashboard/categories" enctype="multipart/form-data">
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
  
          <div class="mb-3">
            <label for="image" class="form-label">Category Image</label>
            <img class="img-preview img-fluid col-sm-5 mb-3">
            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
            @error('image')
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

function previewImage()
{
  const image = document.querySelector('#image');
  const imgPreview = document.querySelector('.img-preview');
  
  imgPreview.style.display = 'block';

  const oFReader = new FileReader();
  oFReader.readAsDataURL(image.files[0]);

  oFReader.onload = function(oFREvent)
  {
    imgPreview.src = oFREvent.target.result;
  }

};
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
        
        <form method="POST" action="/dashboard/categories/{{ $editCategory->slug }}" enctype="multipart/form-data">
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
  
          <div class="mb-3">
            <label for="image" class="form-label">Category Image</label>
            <input type="hidden" name="oldImage" value="{{ $editCategory->image }}">
            @if ($editCategory->image)
              <img src="{{ asset('storage/' . $editCategory->image) }}" class="img-preview img-fluid col-sm-5 mb-3 d-block">
            @else
              <img class="img-preview img-fluid col-sm-5 mb-3">
            @endif
            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
            @error('image')
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

function previewImage()
{
  const image = document.querySelector('#image');
  const imgPreview = document.querySelector('.img-preview');
  
  imgPreview.style.display = 'block';

  const oFReader = new FileReader();
  oFReader.readAsDataURL(image.files[0]);

  oFReader.onload = function(oFREvent)
  {
    imgPreview.src = oFREvent.target.result;
  }

};
</script>

@endif

@endsection