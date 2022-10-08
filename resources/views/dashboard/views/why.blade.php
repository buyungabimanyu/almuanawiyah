@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Why View</h1>
</div>

@if (session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

<form action="{{ ($whyTitle || $whyBody ) ? route('why.update') : route('why.store') }}" method="post">
@if ($whyTitle || $whyBody )
    @method('PUT')
@endif
@csrf

<div class="my-3">
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        {!! ($whyTitle) ? '<input type="hidden" name="oldTitle" value="' . $whyTitle->body . '">' : '' !!}
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ ($whyTitle) ? old('title', $whyTitle->body) : old('title') }}" required>
        @error('title')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="body" class="form-label">Body</label>
        {!! ($whyBody) ? '<input type="hidden" name="oldBody" value="' . $whyBody->body . '">' : '' !!}
        <input type="text" class="form-control @error('body') is-invalid @enderror" id="body" name="body" value="{{ ($whyBody) ? old('body', $whyBody->body) : old('body') }}">
        @error('body')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

  
<button type="submit" class="btn btn-primary btn-round ">{{__('Change Why View')}}</button>
</form>

@endsection