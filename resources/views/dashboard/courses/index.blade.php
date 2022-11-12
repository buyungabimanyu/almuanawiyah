@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Our Courses</h1>
  </div>

  <div class="table-responsive col-lg-8">
    <a href="{{ route('courses.create') }}" class="btn btn-primary mb-3">Create new courses</a>

    @if (session()->has('success'))
    <div class="alert alert-success" role="alert">
      {{ session('success') }}
    </div>    
    @endif

    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">image</th>
          <th scope="col">Title</th>
          <th scope="col">Category</th>
          <th scope="col">Body</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @if ($courses->count())
          @foreach ($courses as $data)
              
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
                @if ($data->image)
                <img src="{{ asset('assets/' . $data->image) }}" alt="" style="max-width: 80px; border-radiu: 100px">
              @else                
                <img src="{{asset('assets/main/courses06.jpg')}}" alt="" style="max-width: 80px; border-radiu: 100px">
              @endif
            </td>
            <td>{{ $data->title }}</td>
            <td>{{ $data->category->name }}</td>
            <td>{!! $data->body !!}</td>
            <td>
              <a href="{{ route('courses.edit', $data->id) }}" class="badge bg-warning">
                <span data-feather="edit"></span>
              </a>
              <form action="{{ route('courses.destroy', $data->id) }}" method="post" class="d-inline">
                @method('delete')
                @csrf
                <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><span data-feather="x-circle"></span></button>
              </form>
            </td>
          </tr>

          @endforeach
        @else
        
          <tr>
            <td colspan="5" class="text-center">You don't have courses yet</td>
          </tr>

        @endif

      </tbody>
    </table>
  </div>
  <a class="btn btn-secondary" href="{{ route('views') }}">Back</a>

@if (isset($create))    
  <!-- Modal -->
  <div class="modal fade" id="create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Create new courses</h5>
          <button type="button" class="btn-close" onclick="history.back()"></button>
        </div>
        <div class="modal-body">
          
          <form method="POST" action="{{ route('courses.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label for="title" class="form-label">Courses title</label>
              <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" required autofocus value="{{ old('title') }}">
              @error('title')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="slug" class="form-label">Slug</label>
              <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" required value="{{ old('slug') }}">
              @error('slug')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
    
            <div class="mb-3">
              <label for="image" class="form-label">Courses Image</label>
              <img class="img-preview img-fluid col-sm-5 mb-3">
              <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
              <span>825x550 pixel</span>
              @error('image')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
              @enderror
            </div>
            <div class="form-floating mb-3">
                <select class="form-select" id="category" name="category_id">
                  
                  @foreach ($categories as $category)
                    @if (old('category_id') == $category->id)
                      <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                    @else
                      <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endif
                  @endforeach
                  
                </select>
                <label for="category">Category</label>
              </div>
            
              <div class="mb-3">
                <label for="body" class="form-label">Body</label>
                @error('body')
                  <div class="alert alert-danger" role="alert">
                    {{ $message }}
                  </div>
                @enderror
                <input id="body" type="hidden" name="body" value="{{ old('body') }}">
                <trix-editor input="body"></trix-editor>
              </div>
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="history.back()">Close</button>
            <button type="submit" class="btn btn-primary">Create new courses</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  
  <script>
  $(document).ready(function(){
    $("#create").modal('show');
  });

  const title = document.querySelector('#title');
  const slug = document.querySelector('#slug');

  title.addEventListener('change', function(){
      fetch('/checkSlug?title=' + title.value)
      .then(response => response.json())
      .then(data => slug.value = data.slug);
  });

  document.addEventListener('trix-file-accept', function(e)
  {
    e.preventDefault();
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

@if (isset($edit))    
  <!-- Modal -->
  <div class="modal fade" id="edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Edit courses</h5>
          <button type="button" class="btn-close" onclick="history.back()"></button>
        </div>
        <div class="modal-body">
          
          <form method="POST" action="{{ route('courses.update', $edit->id) }}" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="mb-3">
              <label for="title" class="form-label">Courses title</label>
              <input type="hidden" name="oldTitle" value="{{ $edit->title }}">
              <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" required autofocus value="{{ old('title', $edit->title) }}">
              @error('title')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="slug" class="form-label">Slug</label>
              <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" required value="{{ old('slug', $edit->slug) }}">
              @error('slug')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
    
            <div class="mb-3">
              <label for="image" class="form-label">Courses Image</label>
              <input type="hidden" name="oldImage" value="{{ $edit->image }}">
              @if ($edit->image)
                <img src="{{ asset('assets/' . $edit->image) }}" class="img-preview img-fluid col-sm-5 mb-3 d-block">
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

            <div class="form-floating mb-3">
                <select class="form-select" id="category" name="category_id">
                  
                  @foreach ($categories as $category)
                    @if (old('category_id', $edit->category_id) == $category->id)
                      <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                    @else
                      <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endif
                  @endforeach
                  
                </select>
                <label for="category">Category</label>
            </div>
            
            <div class="mb-3">
              <label for="body" class="form-label">Body</label>
              @error('body')
                <div class="alert alert-danger" role="alert">
                  {{ $message }}
                </div>
              @enderror
              <input id="body" type="hidden" name="body" value="{{ old('body', $edit->body) }}">
              <trix-editor input="body"></trix-editor>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="history.back()">Close</button>
            <button type="submit" class="btn btn-primary">Save courses</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  
  <script>
  $(document).ready(function(){
    $("#edit").modal('show');
  });

  const title = document.querySelector('#title');
  const slug = document.querySelector('#slug');

  title.addEventListener('change', function(){
      fetch('/checkSlug?title=' + title.value)
      .then(response => response.json())
      .then(data => slug.value = data.slug);
  });

  document.addEventListener('trix-file-accept', function(e)
  {
    e.preventDefault();
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