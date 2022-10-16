@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">About View</h1>
</div>

@if (session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif
<form action="{{ ($aboutTitle || $aboutBody || $image) ? route('about.update') : route('about.store') }}" method="post" enctype="multipart/form-data">
@if ($aboutTitle || $aboutBody || $image)
    @method('PUT')
@endif
@csrf

<div class="my-3">
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        {!! ($aboutTitle) ? '<input type="hidden" name="oldTitle" value="' . $aboutTitle->body . '">' : '' !!}
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ ($aboutTitle) ? old('title', $aboutTitle->body) : old('title') }}" required>
        @error('title')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="body" class="form-label">Body</label>
        {!! ($aboutBody) ? '<input type="hidden" name="oldBody" value="' . $aboutBody->body . '">' : '' !!}
        <input type="text" class="form-control @error('body') is-invalid @enderror" id="body" name="body" value="{{ ($aboutBody) ? old('body', $aboutBody->body) : old('body') }}">
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
    </div>
</div>


<button type="submit" class="btn btn-primary btn-round ">{{__('Change About View')}}</button>
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