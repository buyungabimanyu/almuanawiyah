@extends('dashboard.layouts.main')

@section('container')
@if (session()->has('success'))
<div class="col-md-8">
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>    
</div>
@endif
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Setting</h1>
</div>

<div class="col-md-8">
    @if ($setting)
        <form method="POST" action="{{ route('setting.update', $setting->id) }}" class="mb-5" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control @error('body') is-invalid @enderror" id="title" name="body" value="{{ old('body', $setting->body) }}">
            @error('body')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Logo</label>
                <input type="hidden" name="oldImage" value="{{ $setting->image }}">
                @if ($setting->image)
                    <img src="{{ asset('storage/' . $setting->image) }}" class="img-preview img-fluid col-sm-4 mb-3 d-block">
                @else
                    <img class="img-preview img-fluid col-sm-4 mb-3">
                @endif
                <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
                @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="icon" class="form-label">Icon</label>
                <input type="hidden" name="oldIcon" value="{{ $setting->icon }}">
                @if ($setting->icon)
                    <img src="{{ asset('storage/' . $setting->icon) }}" class="icon-preview img-fluid col-sm-4 mb-3 d-block">
                @else
                    <img class="icon-preview img-fluid col-sm-4 mb-3">
                @endif
                <input class="form-control @error('icon') is-invalid @enderror" type="file" id="icon" name="icon" onchange="previewIcon()">
                @error('icon')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
    @else
        <form method="POST" action="{{ route('setting.store') }}" class="mb-5" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control @error('body') is-invalid @enderror" id="title" name="body" value="{{ old('body') }}">
            @error('body')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Logo</label>
                <img class="img-preview img-fluid col-sm-5 mb-3">
                <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
                @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="icon" class="form-label">FavIcon</label>
                <img class="icon-preview img-fluid col-sm-3 mb-3">
                <input class="form-control @error('icon') is-invalid @enderror" type="file" id="icon" name="icon" onchange="previewIcon()">
                @error('icon')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        
    @endif
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
</div>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Footer</h1>
</div>

<div class="table-responsive col-lg-6">
    <a href="{{ route('footer.create') }}" class="btn btn-primary mb-3">Create Footer</a>

    <table class="table table-striped table-sm align-middle">
      <thead>
        <tr>
          <th>#</th>
          <th>Footer Icon</th>
          <th>Footer Name</th>
          <th class="disabled-sorting text-right">Actions</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th>#</th>
          <th>Footer Icon</th>
          <th>Footer Name</th>
          <th class="disabled-sorting text-right">Actions</th>
        </tr>
      </tfoot>
      <tbody>
        @if ($footers->count())
            
            @foreach ($footers as $footer)
                
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    <span class="avatar avatar-sm rounded-circle">
                    @if ($footer->icon)
                        <img src="{{ asset('/storage/' . $footer->icon) }}" alt="" style="max-width: 80px; border-radiu: 100px">
                    @else                
                        <img src="{{asset('img/apple-icon.png')}}" alt="" style="max-width: 80px; border-radiu: 100px">
                    @endif
                    </span>
                </td>
                <td>{{ $footer->body }}</td>
                <td>
                    <a href="{{ route('footer.edit', $footer->id) }}" class="badge bg-warning">
                    <span data-feather="edit"></span>
                    </a>
                    <form action="{{ route('footer.destroy', $footer->id) }}" method="post" class="d-inline">
                    @method('DELETE')
                    @csrf
                    <button class="badge bg-info border-0" onclick="return confirm('Are you sure?')"><span data-feather="x-circle"></span></button>
                    </form>
                </td>
            </tr>
            @endforeach
        @else
            <tr>
                <td colspan="4" class="text-center">Tidak ada footer</td>
            </tr>
        @endif

      </tbody>
    </table>
</div>

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
    
    function previewIcon()
    {
        const icon = document.querySelector('#icon');
        const iconPreview = document.querySelector('.icon-preview');
        
        iconPreview.style.display = 'block';
    
        const oFileReader = new FileReader();
        oFileReader.readAsDataURL(icon.files[0]);
    
        oFileReader.onload = function(oFileREvent)
        {
            iconPreview.src = oFileREvent.target.result;
        }
    
    };

</script>

@if (isset($createFooter))    
<!-- Modal -->
<div class="modal fade" id="create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Create Footer</h5>
        <button type="button" class="btn-close" onclick="history.back()"></button>
      </div>
      <div class="modal-body">
        
        <form method="POST" action="{{ route('footer.store') }}" enctype="multipart/form-data">
          @csrf
          <div class="form-floating mb-3">
            <select class="form-select" id="footer-icon" name="icon">
                @foreach ($icons as $data)
                    @if (old('icon') == $data->icon)
                        <option value="{{ $data->icon }}" selected><i class="fa-brands {{ $data->icon }}"></i> {{ $data->body }}</option>
                    @else
                        <option value="{{ $data->icon }}"><i class="fa-brands {{ $data->icon }}"></i> {{ $data->body }}</option>
                    @endif
                @endforeach
            </select>
            <label for="footer-icon">Footer Icon</label>
          </div>
          <div class="mb-3">
            <label for="name" class="form-label">Footer Link</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required autofocus value="{{ old('name') }}">
            @error('name')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
            @enderror
          </div>        
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" onclick="history.back()">Close</button>
          <button type="submit" class="btn btn-primary">Create Footer</button>
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

@endsection