@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Contact View</h1>
</div>

<form action="{{ ($contactTitle || $body || $email || $phone || $address ) ? route('contact.update') : route('contact.store') }}" method="post" enctype="multipart/form-data">
@if ($contactTitle || $body || $email || $phone || $address )
    @method('PUT')
@endif
@csrf

<div class="my-3">
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        {!! ($contactTitle) ? '<input type="hidden" name="oldTitle" value="' . $contactTitle->body . '">' : '' !!}
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ ($contactTitle) ? old('title', $contactTitle->body) : old('title') }}" required>
        @error('title')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="body" class="form-label">Body</label>
        {!! ($body) ? '<input type="hidden" name="oldBody" value="' . $body->body . '">' : '' !!}
        <input type="text" class="form-control @error('body') is-invalid @enderror" id="body" name="body" value="{{ ($body) ? old('body', $body->body) : old('body') }}">
        @error('body')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        {!! ($email) ? '<input type="hidden" name="oldEmail" value="' . $email->body . '">' : '' !!}
        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ ($email) ? old('email', $email->body) : old('email') }}">
        @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="phone" class="form-label">Contact Phone</label>
        {!! ($phone) ? '<input type="hidden" name="oldPhone" value="' . $phone->body . '">' : '' !!}
        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ ($phone) ? old('phone', $phone->body) : old('phone') }}">
        @error('phone')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="address" class="form-label">Contact Address</label>
        {!! ($address) ? '<input type="hidden" name="oldAddress" value="' . $address->body . '">' : '' !!}
        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ ($address) ? old('address', $address->body) : old('address') }}">
        @error('address')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

  
<button type="submit" class="btn btn-primary btn-round ">{{__('Change Contact View')}}</button><a class="btn btn-secondary" href="{{ route('views') }}">Back</a>
</form>
@endsection