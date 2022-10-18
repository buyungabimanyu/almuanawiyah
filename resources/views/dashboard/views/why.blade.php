@extends('dashboard.layouts.main')

@section('container')
  @switch($switch)
      @case('alasan')
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
                    <i class="fa {{ ($data->image) ? $data->font->icon : 'fa-hashtag' }}"></i>
                </td>
                <td>{{ $data->title }}</td>
                <td>{{ $data->body }}</td>
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

        @break
      @case('create')
          <form method="POST" action="{{ route('alasan.store') }}">
            @csrf
            <div class="form-group">
              <label for="icon">Alasan Icon</label>
              <select class="form-select" id="icon" name="icon">
              </select>
            </div>
            <div class="form-group">
              <span id="selected"></span>
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
            <button type="submit" class="btn btn-primary">Create new courses</button>
          </form>
          <script src="{{ asset('js') }}/ddSlick.js"></script>
          <script>
            const icons = {!! $icons !!};
            $('select#icon').ddslick({
              data: icons,
              imagePosition:"right",
              width: "100%"
            });
          </script>
          @break
      @case('edit')
          <form method="POST" action="{{ route('alasan.update', $data->id) }}">
            @method('put')
            @csrf
            <div class="form-group">
              <label for="icon">Alasan Icon</label>
              <select class="form-select" id="icon" name="icon">
              </select>
            </div>
            <div class="form-group">
              <span id="selected"></span>
            </div>
            <div class="mb-3">
              <label for="title" class="form-label">Alasan title</label>
              <input type="hidden" name="oldTitle" value="{{ $data->title }}">
              <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" required autofocus value="{{ old('title') }}">
              @error('title')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="body" class="form-label">Alasan body</label>
              <input type="hidden" name="oldBody" value="{{ $data->body }}">
              <input type="text" class="form-control @error('body') is-invalid @enderror" id="body" name="body" required value="{{ old('body') }}">
              @error('body')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
              @enderror
            </div>
            <button type="submit" class="btn btn-primary">Create new courses</button>
          </form>
          <script src="{{ asset('js') }}/ddSlick.js"></script>
          <script>
            const icons = {!! $icons !!};
            $('select#icon').ddslick({
              data: icons,
              imagePosition:"right",
              width: "100%",
            });
          </script>
          @break
      @default
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Why View</h1>
            </div>
            
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
   @endswitch
@endsection