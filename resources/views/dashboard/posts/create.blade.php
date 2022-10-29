@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Create new post</h1>
</div>

  <div class="col-md-8">
      <form method="POST" action="{{ route('post.store') }}" class="mb-5" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
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
          <label for="image" class="form-label">Post Image</label>
          <img class="img-preview img-fluid col-sm-5 mb-3">
          <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
          <span>825x550 pixel</span>
          @error('image')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
          @enderror
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
        
        <!-- Button trigger modal Pertinjauan -->
        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#viewPost" onclick="previewBody()">
          Preview Post
        </button>

        <button type="submit" class="btn btn-primary" id="submitPost">Create post</button>
      </form>
  </div>

<!-- Modal Pertinjauan -->
<div class="modal fade" id="viewPost" tabindex="-1">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Preview Post</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <div class="row my-3">
          <div class="col-md-8">
            <h2 class="mb-3" id="judulPost"></h2>
            <img class="img-modal-preview img-fluid col-sm-5 mb-3">
            <article class="my-3 fs-5" id="bodyPost"></article>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="submitPost.click()">Create post</button>
      </div>
    </div>
  </div>
</div>


<script>

const submitPost = document.querySelector('#submitPost');

const title = document.querySelector('#title');
const slug = document.querySelector('#slug');
const judulPost = document.querySelector('#judulPost');

title.addEventListener('change', function(){
    fetch('/checkSlug?title=' + title.value)
    .then(response => response.json())
    .then(data => slug.value = data.slug);
    judulPost.innerHTML = title.value;
});

function previewBody(){
  const body = document.querySelector('#body');
  const bodyPost = document.querySelector('#bodyPost');

  bodyPost.innerHTML = body.value;
};

document.addEventListener('trix-file-accept', function(e)
{
  e.preventDefault();
});

function previewImage()
{
  const image = document.querySelector('#image');
  const imgPreview = document.querySelector('.img-preview');
  const imgModalPreview = document.querySelector('.img-modal-preview');
  
  imgPreview.style.display = 'block';
  imgModalPreview.style.display = 'block';

  const oFReader = new FileReader();
  oFReader.readAsDataURL(image.files[0]);

  oFReader.onload = function(oFREvent)
  {
    imgPreview.src = oFREvent.target.result;
    imgModalPreview.src = oFREvent.target.result;
  }

};

</script>

@endsection