@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Courses View</h1>
</div>

<form action="{{ ($coursesTitle || $coursesBody ) ? route('coursesTitle.update') : route('coursesTitle.store') }}" method="post">
@if ($coursesTitle || $coursesBody )
    @method('PUT')
@endif
@csrf

<div class="my-3">
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        {!! ($coursesTitle) ? '<input type="hidden" name="oldTitle" value="' . $coursesTitle->body . '">' : '' !!}
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ ($coursesTitle) ? old('title', $coursesTitle->body) : old('title') }}" required>
        @error('title')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="body" class="form-label">Body</label>
        {!! ($coursesBody) ? '<input type="hidden" name="oldBody" value="' . $coursesBody->body . '">' : '' !!}
        <input type="text" class="form-control @error('body') is-invalid @enderror" id="body" name="body" value="{{ ($coursesBody) ? old('body', $coursesBody->body) : old('body') }}">
        @error('body')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

  
<button type="submit" class="btn btn-primary btn-round ">{{__('Change Courses View')}}</button><a class="btn btn-secondary" href="{{ route('views') }}">Back</a>
</form>

@endsection