@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Blog Title</h1>
</div>

<form action="{{ ($blog->count()) ? route('blog.update', $blog[0]->id) : route('blog.store') }}" method="post">
@if ($blog->count())
    @method('PUT')
@endif
@csrf

<div class="my-3">
    @if ($blog->count())
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control @error('body') is-invalid @enderror" id="title" name="body" value="{{ old('body', $blog[0]->body) }}">
    @else
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control @error('body') is-invalid @enderror" id="title" name="body" value="{{ old('body') }}">
    @endif
        @error('body')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

  
<button type="submit" class="btn btn-primary btn-round ">{{__('Change Blog Title')}}</button>
<a class="btn btn-secondary" href="{{ route('views') }}">Back</a>
</form>

@endsection