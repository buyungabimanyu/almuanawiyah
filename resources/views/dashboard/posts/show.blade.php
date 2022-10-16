@extends('dashboard.layouts.main')

@section('container')

<div class="container">
    <div class="row my-3">
        <div class="col-md-8">
            <h2 class="mb-3">{{ $post->title }}</h2>
            @if (Request::is('allposts*'))
                <a href="{{ route('allposts.index') }}" class="btn btn-success"><span data-feather="arrow-left"></span> Back to all posts</a>
                <form action="{{ route('allposts.destroy', $post->slug) }}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><span data-feather="x-circle"></span> Delete</button>
                </form>
            @else
                <a href="{{ route('post.index') }}" class="btn btn-success"><span data-feather="arrow-left"></span> Back to all my posts</a>
                <a href="{{ route('post.edit', $post->slug) }}" class="btn btn-warning"><span data-feather="edit"></span> Edit</a>
                <form action="{{ route('post.destroy', $post->slug) }}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><span data-feather="x-circle"></span> Delete</button>
                </form>
            @endif

            @if ($post->image)
                <div style="max-height: 350px; overflow:hidden">
                    <img src="{{ asset('assets/' . $post->image) }}" class="img-fluid mt-3" alt="{{ $post->title }}">
                </div>
            @else                
                <img src="{{ asset('assets/main') }}/post01.jpg" class="img-fluid mt-3">
            @endif

            <article class="my-3 fs-5">
                {!! $post->body !!}
            </article>

        </div>
    </div>
</div>

@endsection