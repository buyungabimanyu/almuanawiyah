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

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Alasan</h1>
</div>

<div class="table-responsive col-lg-8">
    <a href="{{ route('alasan.create') }}" class="btn btn-primary mb-3">Create new alasan</a>

    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Icon</th>
          <th scope="col">Title</th>
          <th scope="col">Body</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @if ($alasan->count())
          @foreach ($alasan as $data)
              
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
                <i class="fa-sharp fa-solid {{ ($data->image) ? $data->image : 'fa-hashtag' }}"></i>
            </td>
            <td>{{ $data->title }}</td>
            <td>{{ $data->category->name }}</td>
            <td>
              <a href="{{ route('alasan.edit', $data->id) }}" class="badge bg-warning">
                <span data-feather="edit"></span>
              </a>
              <form action="{{ route('alasan.destroy', $data->id) }}" method="post" class="d-inline">
                @method('delete')
                @csrf
                <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><span data-feather="x-circle"></span></button>
              </form>
            </td>
          </tr>

          @endforeach
        @else
        
          <tr>
            <td colspan="5" class="text-center">Kamu belum menambahkan alasan</td>
          </tr>

        @endif

      </tbody>
    </table>
  </div>

  @if (isset($create))    
  <!-- Modal -->
  <div class="modal fade" id="create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Create new alasan</h5>
          <button type="button" class="btn-close" onclick="history.back()"></button>
        </div>
        <div class="modal-body">
          
          <form method="POST" action="{{ route('alasan.store') }}">
            @csrf

            <div class="form-floating mb-3">
                <select class="form-select" id="category" name="category_id">
                  
                  @foreach ($icons as $icon)
                    @if (old('icon') == $icon->image)
                      <option value="{{ $icon->image }}" selected><i class="feature-icon fa {!! $icon->image !!}"></i></option>
                    @else
                      <option value="{{ $icon->image }}"><i class="feature-icon fa {!! $icon->image !!}"></i></option>
                    @endif
                  @endforeach
                  
                </select>
                <label for="icon">Alasan Icon</label>
            </div>
            <div class="mb-3">
              <label for="title" class="form-label">Alasan title</label>
              <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" required autofocus value="{{ old('title') }}">
              @error('title')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="body" class="form-label">Alasan body</label>
              <input type="text" class="form-control @error('body') is-invalid @enderror" id="body" name="body" required value="{{ old('body') }}">
              @error('body')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
              @enderror
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
  </script>
  
@endif

@if (isset($edit))    
  <!-- Modal -->
  <div class="modal fade" id="edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Edit Alasan</h5>
          <button type="button" class="btn-close" onclick="history.back()"></button>
        </div>
        <div class="modal-body">
          
          <form method="POST" action="{{ route('alasan.update', $edit->id) }}">
            @method('put')
            @csrf

            <div class="form-floating mb-3">
                <select class="form-select" id="category" name="category_id">
                  
                  @foreach ($icons as $icon)
                    @if (old('icon', $edit->image) == $icon->image)
                      <option value="{{ $icon->image }}" selected>{{ $icon->name }}</option>
                    @else
                      <option value="{{ $icon->image }}">{{ $icon->name }}</option>
                    @endif
                  @endforeach
                  
                </select>
                <label for="icon">Alasan Icon</label>
            </div>
            <div class="mb-3">
              <label for="title" class="form-label">Alasan title</label>
              <input type="hidden" name="oldTitle" value="{{ $edit->title }}">
              <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" required autofocus value="{{ old('title') }}">
              @error('title')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="body" class="form-label">Alasan body</label>
              <input type="hidden" name="oldBody" value="{{ $edit->body }}">
              <input type="text" class="form-control @error('body') is-invalid @enderror" id="body" name="body" required value="{{ old('body') }}">
              @error('body')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
              @enderror
            </div>
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="history.back()">Close</button>
            <button type="submit" class="btn btn-primary">Save alasan</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  
  <script>
    $(document).ready(function(){
        $("#edit").modal('show');
    });
  </script>
  
@endif
@endsection