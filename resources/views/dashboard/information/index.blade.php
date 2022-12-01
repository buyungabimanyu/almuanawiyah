@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Information</h1>
    <label class="switch" for="switch">
        <input type="checkbox" id="switch" {{ ($switch['body'] == 'on') ? 'checked' : '' }}>
        <span class="slider round"></span>
    </label>
</div>
<div class="container">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahinfo">
        Tambah Informasi Terkini
    </button>
    <div class="row">
        @if ($datainfo->count())
            @foreach ($datainfo as $item)
                <div class="col-md-4 col-sm-6 col-xs-6">
                    <div class="course">
                        <form action="{{ route('information.destroy', $item->id) }}" method="post">
                            @method('delete')
                            @csrf
                            <button type="submit" class="course-img border-0 px-0 py-0" onclick="return confirm('Are you sure for remove this information?')">
                                <img src="{{ asset('assets/' . $item->body) }}">
                                <i class="course-link-icon fa fa-trash"></i>
                            </button>
                        </form>
                        {!! ($item->ppdb == 'on')? '<span class=course-title>Informasi berkaitan dengan PPDB</span>' : '' !!}
                    </div>
                </div>
            @endforeach
        @else
            <div class="alert alert-info text-center mt-2">Belum ada Informasi POP-UP</div>
        @endif
    </div>
</div>
  
  <!-- Modal -->
  <div class="modal fade" id="tambahinfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Informasi Terkini</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('information.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <input class="form-control @error('body') is-invalid @enderror" type="file" id="image" name="body" onchange="previewImage()">
                <span>955x375 pixel</span>
                @error('image')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                @enderror
                <img class="img-preview img-fluid col-sm-5 mb-3">
            </div>
            <div class="mb-3 px-3" style="clear: both">
              <h4 style="float: left">Informasi berkaitan dengan pendaftaran PPDB</h4>
              <label class="switch" style="float: right" for="ppdb">
                <input type="checkbox" id="ppdb" name="ppdb" value="on">
                <span class="slider round"></span>
            </label>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Tambahkan</button>
            </form>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function(){
      $('#switch').click(function(){
        var data = (this.checked == 1) ? 'on' : 'off';
        $.ajax({
          url: "{{ route('information.switch') }}",
          type: 'POST',
          data: {_token: "{{ csrf_token() }}", body: data},
          dataType: 'JSON'
        });
      });
    });
    function previewImage()
    {
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');
        
        if(image.files[0].size <= 2048000){
            imgPreview.style.display = 'block';
    
            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);
    
            oFReader.onload = function(oFREvent)
            {
                imgPreview.src = oFREvent.target.result;
            }
        } else {
            imgPreview.style.display = 'block';
            imgPreview.alt = 'File Gambar Terlalu Besar';
        }
    };
  </script>

@endsection