@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Video View</h1>
</div>

<form action="{{ ($videoTitle || $videoBody || $videoText || $videoPlay ) ? route('video.update') : route('video.store') }}" method="post">
@if ($videoTitle || $videoBody || $videoText || $videoPlay )
    @method('PUT')
@endif
@csrf

<div class="my-3">
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        {!! ($videoTitle) ? '<input type="hidden" name="oldTitle" value="' . $videoTitle->body . '">' : '' !!}
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ ($videoTitle) ? old('title', $videoTitle->body) : old('title') }}" required>
        @error('title')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="body" class="form-label">Body</label>
        {!! ($videoBody) ? '<input type="hidden" name="oldBody" value="' . $videoBody->body . '">' : '' !!}
        <input type="text" class="form-control @error('body') is-invalid @enderror" id="body" name="body" value="{{ ($videoBody) ? old('body', $videoBody->body) : old('body') }}">
        @error('body')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="text" class="form-label">Text</label>
        {!! ($videoText) ? '<input type="hidden" name="oldText" value="' . $videoText->body . '">' : '' !!}
        @error('text')
          <div class="alert alert-danger" role="alert">
            {{ $message }}
          </div>
        @enderror
        <input id="text" type="hidden" name="text" value="{{ ($videoText) ? old('text', $videoText->body) : old('text') }}">
        <trix-editor input="text"></trix-editor>
      </div>
    <div class="mb-3">
        <label for="link" class="form-label">Link Video</label>
        {!! ($videoPlay) ? '<input type="hidden" name="oldLink" value="' . $videoPlay->body . '">' : '' !!}
        <input type="text" class="form-control @error('link') is-invalid @enderror" id="link" name="link" value="{{ ($videoPlay) ? old('link', $videoPlay->body) : old('link') }}">
        @error('link')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

  
<button type="submit" class="btn btn-primary btn-round ">{{__('Change video View')}}</button>
</form>

<script>
    document.addEventListener('trix-file-accept', function(e){
        e.preventDefault();
    });
</script>

@endsection