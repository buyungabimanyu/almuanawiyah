@extends('dashboard.layouts.main')

@section('container')
  <div class="panel-header panel-header-sm">
  </div>
  <div class="content">
    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h5 class="title">{{__(" Edit Profile")}}</h5>
          </div>
          <div class="card-body">
            <form method="post" action="{{ route('profile.update') }}" autocomplete="off"
            enctype="multipart/form-data">
              @csrf
              @method('put')
              @include('alerts.success')
              <div class="row">
              </div>
                <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label>{{__(" Name")}}</label>
                                <input type="hidden" name="oldName" value="{{ auth()->user()->name }}">
                                <input type="text" name="name" class="form-control" value="{{ old('name', auth()->user()->name) }}">
                                @include('alerts.feedback', ['field' => 'name'])
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label>{{__(" Username")}}</label>
                                <input type="hidden" name="oldUsername" value="{{ auth()->user()->username }}">
                                <input type="text" name="username" class="form-control" value="{{ old('username', auth()->user()->username) }}">
                                @include('alerts.feedback', ['field' => 'username'])
                        </div>
                    </div>
                </div>
                <div class="row">
                  <div class="col-md-7 pr-1">
                    <div class="mt-3">
                      <label for="image" class="form-label">Picture profile</label>
                      <input type="hidden" name="oldImage" value="{{ auth()->user()->image }}">
                      <img class="img-preview img-fluid col-sm-5 mb-3">
                      <input class="form-control" type="file" id="image" name="image" onchange="previewImage()">
                      <span>200x200 pixel</span>
                      @include('alerts.feedback', ['field' => 'image'])
                    </div>
                  </div>
                </div>
              <div class="card-footer ">
                <button type="submit" class="btn btn-primary btn-round">{{__('Save')}}</button>
              </div>
              <hr class="half-rule"/>
            </form>
          </div>
          <div class="card-header">
            <h5 class="title">{{__("Password")}}</h5>
          </div>
          <div class="card-body">
            <form method="post" action="{{ route('profile.password') }}" autocomplete="off">
              @csrf
              @method('put')
              @include('alerts.success', ['key' => 'password_status'])
              <div class="row">
                <div class="col-md-7 pr-1">
                  <div class="form-group {{ $errors->has('password') ? ' has-danger' : '' }}">
                    <label>{{__(" Current Password")}}</label>
                    <input class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="old_password" placeholder="{{ __('Current Password') }}" type="password"  required>
                    @include('alerts.feedback', ['field' => 'old_password'])
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-7 pr-1">
                  <div class="form-group {{ $errors->has('password') ? ' has-danger' : '' }}">
                    <label>{{__(" New password")}}</label>
                    <input class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('New Password') }}" type="password" name="password" required>
                    @include('alerts.feedback', ['field' => 'password'])
                  </div>
                </div>
            </div>
            <div class="row">
              <div class="col-md-7 pr-1">
                <div class="form-group {{ $errors->has('password') ? ' has-danger' : '' }}">
                  <label>{{__(" Confirm New Password")}}</label>
                  <input class="form-control" placeholder="{{ __('Confirm New Password') }}" type="password" name="password_confirmation" required>
                </div>
              </div>
            </div>
            <div class="card-footer ">
              <button type="submit" class="btn btn-primary btn-round ">{{__('Change Password')}}</button>
            </div>
          </form>
        </div>
      </div>
    </div>
      <div class="col-md-4">
        <div class="card">
          @if (auth()->user()->image)
              <img class="img-fluid card-img-top img-thumbnail" src="{{ asset('assets/' . auth()->user()->image) }}" alt="...">
          @else                
              <img class="img-fluid card-img-top img-thumbnail" src="{{ asset('assets/main/default-avatar.png')}}" alt="...">
          @endif
          <div class="card-body">
            <h5 class="title">{{ auth()->user()->name }}</h5>
            <p class="description">
                {{ auth()->user()->email }}
            </p>
          </div>
          </div>
        </div>
      </div>
    </div>
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

</script>

@endsection