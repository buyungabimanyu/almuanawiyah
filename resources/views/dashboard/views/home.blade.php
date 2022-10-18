@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Home View</h1>
</div>

<form action="{{ ($homeTitle || $homeBody ) ? route('home.update') : route('home.store') }}" method="post">
@if ($homeTitle || $homeBody )
    @method('PUT')
@endif
@csrf

<div class="my-3">
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        {!! ($homeTitle) ? '<input type="hidden" name="oldTitle" value="' . $homeTitle->body . '">' : '' !!}
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ ($homeTitle) ? old('title', $homeTitle->body) : old('title') }}" required>
        @error('title')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="body" class="form-label">Body</label>
        {!! ($homeBody) ? '<input type="hidden" name="oldBody" value="' . $homeBody->body . '">' : '' !!}
        <input type="text" class="form-control @error('body') is-invalid @enderror" id="body" name="body" value="{{ ($homeBody) ? old('body', $homeBody->body) : old('body') }}">
        @error('body')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

  
<button type="submit" class="btn btn-primary btn-round ">{{__('Change Home View')}}</button>
</form>

@endsection