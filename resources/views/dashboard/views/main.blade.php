@extends('dashboard.layouts.main')

@section('container')
    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>    
    @endif

    <form action="{{ ($main->count()) ? route('main.update', $main[0]->id) : route('main.store') }}" method="post" enctype="multipart/form-data">
        @if ($main->count())
            @method('PUT')
        @endif
        @csrf

        <div class="my-3">
            @if ($main->count())
                <input type="hidden" name="oldImage" value="{{ $main[0]->image }}">
                @if ($main[0]->image)
                <div class="row">
                    <div class="col-md-6">
                            <img src="{{ asset('storage/' . $main[0]->image) }}" class="img-preview img-fluid card-img-top img-thumbnail my-3 d-block">
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="col-md-6">
                            <img class="img-preview img-fluid card-img-top img-thumbnail my-3" src="{{ asset('img') }}/page-background.jpg">
                        </div>
                    </div>
                @endif
            @else
                <div class="row">
                    <div class="col-md-6">
                        <img class="img-preview img-fluid card-img-top img-thumbnail my-3" src="{{ asset('img') }}/page-background.jpg">
                    </div>
                </div>
            @endif
            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
            @error('image')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
            @enderror
        </div>

          
        <button type="submit" class="btn btn-primary btn-round ">{{__('Change Main Header')}}</button>
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