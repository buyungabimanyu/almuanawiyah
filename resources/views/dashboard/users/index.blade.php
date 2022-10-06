@extends('dashboard.layouts.main')

@section('container')
<div class="panel-header">
</div>
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Users</h4>
          <a class="btn btn-primary btn-round text-white pull-right" href="{{ route('users.create') }}">Add user</a>
          @if (session()->has('success'))
          <div class="alert alert-success" role="alert">
            {{ session('success') }}
          </div>    
          @endif
          <div class="col-12 mt-2">
          </div>
        </div>
        <div class="card-body">
          <div class="toolbar">
            <!--        Here you can write extra buttons/actions for the toolbar              -->
          </div>
          <table id="datatable" class="table table-striped table-bordered align-middle" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Profile</th>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Creation date</th>
                <th>Role</th>
                <th class="disabled-sorting text-right">Actions</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Profile</th>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Creation date</th>
                <th>Role</th>
                <th class="disabled-sorting text-right">Actions</th>
              </tr>
            </tfoot>
            <tbody>
              @foreach ($users as $user)
                <tr>
                  <td>
                    <span class="avatar avatar-sm rounded-circle">
                      @if ($user->image)
                        <img src="{{ asset('/storage/' . $user->image) }}" alt="" style="max-width: 80px; border-radiu: 100px">
                      @else                
                        <img src="{{asset('img/default-avatar.png')}}" alt="" style="max-width: 80px; border-radiu: 100px">
                      @endif
                    </span>
                  </td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->username }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->created_at }}</td>
                  <td>{{ ($user->is_editor == true) ? 'Editor' : 'Subscribe'  }}</td>
                  <td class="text-right">
                    @if ($user->is_admin == true)
                        Admin
                    @else                        
                      <a href="{{ route('users.edit',$user->username) }}" class="btn btn-warning">
                        <span data-feather="tool"></span> Edit
                      </a>
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- end content-->
      </div>
      <!--  end card  -->
    </div>
    <!-- end col-md-12 -->
  </div>

    <!-- Create User route -->  
  @if (isset($createUser)) 
  <div class="modal fade" id="create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Create new User</h5>
          <button type="button" class="btn-close" onclick="history.back()"></button>
        </div>
        <div class="modal-body">
          
          <form method="POST" action="{{ route('users.store') }}">
            @csrf

            <div class="row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required>

                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email andress') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="history.back()">Close</button>
            <button type="submit" class="btn btn-primary">Create new user</button>
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
  <!-- End Create User route --> 

  <!-- Edit User route -->  
@if (isset($editUser)) 
<div class="modal fade" id="edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Edit User</h5>
        <button type="button" class="btn-close" onclick="history.back()"></button>
      </div>
      <div class="modal-body">
        
          <div class="row">
            <div class="col-md-8">
              <form method="post" action="{{ route('users.update', $editUser->username) }}" autocomplete="off"
              enctype="multipart/form-data">
                @csrf
                @method('put')
                @include('alerts.success')
                  <div class="row">
                      <div class="col-md-7 pr-1">
                          <div class="form-group">
                              <label>{{__(" Name")}}</label>
                                  <input type="hidden" name="oldName" value="{{ $editUser->name }}">
                                  <input type="text" name="name" class="form-control" value="{{ old('name', $editUser->name) }}">
                                  @include('alerts.feedback', ['field' => 'name'])
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-md-7 pr-1">
                          <div class="form-group">
                              <label>{{__(" Password")}}</label>
                                  <input type="text" name="password" class="form-control" placeholder="Isi untuk merubah password">
                                  @include('alerts.feedback', ['field' => 'password'])
                          </div>
                      </div>
                  </div>
              </div>
            <div class="col-md-4">
              <div class="card">
                @if ($editUser->image)
                    <img class="img-fluid card-img-top img-thumbnail" src="{{ asset('/storage/' . $editUser->image) }}" alt="...">
                @else                
                    <img class="img-fluid card-img-top img-thumbnail" src="{{asset('img/default-avatar.png')}}" alt="...">
                @endif
                <div class="card-body">
                  <h5 class="title">{{ $editUser->username }}</h5>
                  <p class="description">
                      {{ $editUser->email }}
                  </p>
                </div>
              </div>
            </div>
      
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary"><span data-feather="save"></span> Save</button>
        </form>

        <form action="{{ route('users.mEditor',$editUser->username) }}" method="post" class="d-inline">
          @method('PUT')
          @csrf
          <button type="submit" class="btn btn-info" onclick="return confirm('Are you sure?')"><span data-feather="hash"></span> Make an Editor</button>
        </form>

        <form action="{{ route('users.mAdmin',$editUser->username) }}" method="post" class="d-inline">
          @method('PUT')
          @csrf
          <button type="submit" class="btn btn-warning" onclick="return confirm('Are you sure?')"><span data-feather="hash"></span> Make an Admin</button>
        </form>

        <form action="{{ route('users.destroy',$editUser->username) }}" method="post" class="d-inline">
          @method('delete')
          @csrf
          <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')"><span data-feather="x-circle"></span> Delete</button>
        </form>

        <button type="button" class="btn btn-secondary" onclick="history.back()">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
  $("#edit").modal('show');
});

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

@endif
<!-- End Edit User route --> 
  

@endsection