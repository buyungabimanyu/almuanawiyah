@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Contact Us</h1>
  </div>

  <div class="table-responsive col-lg-12">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Subject</th>
          <th scope="col">Message</th>
        </tr>
      </thead>
      <tbody>
        @if ($emails->count())
          @foreach ($emails as $data)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $data->name }}</td>
            <td>{{ $data->email }}</td>
            <td>{{ $data->subject }}</td>
            <td>{{ $data->message }}</td>
          </tr>
          @endforeach
        @else
        
          <tr>
            <td colspan="5" class="text-center">You don't have email yet</td>
          </tr>

        @endif

      </tbody>
    </table>
  </div>

@endsection