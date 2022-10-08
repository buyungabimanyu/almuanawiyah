@extends('dashboard.layouts.main')

@section('container')

@if (Request::is('allposts*'))

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">All Posts</h1>
</div>

<div class="table-responsive col-lg-8">

  @if (session()->has('success'))
  <div class="alert alert-success" role="alert">
    {{ session('success') }}
  </div>    
  @endif

  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Category</th>
        <th scope="col">Author</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @if ($posts->count())
        @foreach ($posts as $post)
            
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $post->title }}</td>
          <td>{{ $post->category->name }}</td>
          <td>{{ ($post->author->name == auth()->user()->name) ? 'Your post' : $post->author->name }}</td>
          <td>
            <a href="{{ route('allposts.show', $post->slug) }}" class="badge bg-info">
              <span data-feather="eye"></span>
            </a>
            <form action="{{ route('allposts.destroy', $post->slug) }}" method="post" class="d-inline">
              @method('delete')
              @csrf
              <button class="badge bg-danger border-0 d-inline" onclick="return confirm('Are you sure?')"><span data-feather="x-circle"></span></button>
            </form>
          </td>
        </tr>

        @endforeach
      @else
      
        <tr>
          <td colspan="4" class="text-center">You don't have post yet</td>
        </tr>

      @endif

    </tbody>
  </table>
</div>

@else
    
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">My Posts</h1>
  </div>

  <div class="table-responsive col-lg-8">
    <a href="{{ route('post.create') }}" class="btn btn-primary mb-3">Create new post</a>

    @if (session()->has('success'))
    <div class="alert alert-success" role="alert">
      {{ session('success') }}
    </div>    
    @endif

    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Title</th>
          <th scope="col">Category</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @if ($posts->count())
          @foreach ($posts as $post)
              
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $post->title }}</td>
            <td>{{ $post->category->name }}</td>
            <td>
              <a href="{{ route('post.show', $post->slug) }}" class="badge bg-info">
                <span data-feather="eye"></span>
              </a>
              
              <a href="{{ route('post.edit', $post->slug) }}" class="badge bg-warning">
                <span data-feather="edit"></span>
              </a>
              <form action="{{ route('post.destroy', $post->slug) }}" method="post" class="d-inline">
                @method('delete')
                @csrf
                <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><span data-feather="x-circle"></span></button>
              </form>
            </td>
          </tr>

          @endforeach
        @else
        
          <tr>
            <td colspan="4" class="text-center">You don't have post yet</td>
          </tr>

        @endif

      </tbody>
    </table>
  </div>

@endif

@endsection