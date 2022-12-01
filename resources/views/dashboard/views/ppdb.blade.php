@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">PPDB View</h1>
</div>
<form action="{{ ($ppdbTitle || $ppdbBody || $image) ? route('ppdb.update') : route('ppdb.store') }}" method="post" enctype="multipart/form-data">
@if ($ppdbTitle || $ppdbBody || $image)
    @method('PUT')
@endif
@csrf

<div class="my-3">
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        {!! ($ppdbTitle) ? '<input type="hidden" name="oldTitle" value="' . $ppdbTitle->body . '">' : '' !!}
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ ($ppdbTitle) ? old('title', $ppdbTitle->body) : old('title') }}" required>
        @error('title')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="body" class="form-label">Body</label>
        {!! ($ppdbBody) ? '<input type="hidden" name="oldBody" value="' . $ppdbBody->body . '">' : '' !!}
        <input type="text" class="form-control @error('body') is-invalid @enderror" id="body" name="body" value="{{ ($ppdbBody) ? old('body', $ppdbBody->body) : old('body') }}">
        @error('body')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Image </label>
        {!! ($image) ? '<input type="hidden" name="oldImage" value="' . $image->image . '">' : '' !!}
        <img class="img-preview img-fluid col-sm-4 mb-3" src="{{ ($image) ? asset('assets/' . $image->image) : '' }}">
        <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
        @error('image')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        1600x900 pixel
    </div>
</div>


<button type="submit" class="btn btn-primary btn-round ">{{__('Change PPDB View')}}</button>
<a class="btn btn-secondary" href="{{ route('views') }}">Back</a>
</form>

<script>

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

@endsection