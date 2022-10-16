@extends('homeviews.layouts.main')

@section('container')

		<!-- Hero-area -->
		<div class="hero-area section">

			<!-- Backgound Image -->
			<div class="bg-image bg-parallax overlay" style="background-image:url({{ asset('assets/' . App\Models\Views::mainHeader()) }})"></div>
			<!-- /Backgound Image -->

			<div class="container">
				<div class="row">
					<div class="col-md-10 col-md-offset-1 text-center">
						<ul class="hero-area-tree">
							<li><a href="{{ route('home') }}">Home</a></li>
							<li>Blog</li>
						</ul>
						<h1 class="white-text">{{ $title }}</h1>

					</div>
				</div>
			</div>

		</div>
		<!-- /Hero-area -->

		<!-- Blog -->
		<div id="blog" class="section">

			<!-- container -->
			<div class="container">

				<!-- row -->
				<div class="row">

					<!-- main blog -->
					<div id="main" class="col-md-9">

            @if ($posts->count())
              <!-- row -->
              <div class="row">
                @foreach ($posts as $post)
                  <!-- single blog -->
                  <div class="col-md-5 mb-3" >
                    <div class="single-blog border border-dark">
                      <div class="blog-img" style="position: relative">
                        <a href="/blogposts?category={{ $post->category->slug }}" style="position: absolute; top:0; left:0; z-index:2; background: rgba(0, 0, 0, 0.65); color:azure">{{ $post->category->name }}</a>
                        <a href="{{ route('blogpost', $post->slug) }}" style="z-index: 1">
                          @if ($post->image)
                            <img src="{{ asset('/assets/' . $post->image) }}" class="card-img-top" alt="{{ $post->category->name }}">
                          @else
                            <img src="{{ asset('/assets/main') }}/blog01.jpg" alt="{{ $post->category->name }}">
                          @endif
                        </a>
                      </div>
                      <h4><a href="{{ route('blogpost', $post->slug) }}">{{ $post->title }}</a></h4>
                      <hr style="margin: 0; padding:0">
                      <h5>{{ $post->excerpt }}</h5>
                      <div class="blog-meta">
                        <span class="blog-meta-author">By: <a href="/blogposts?author={{ $post->author->username }}">{{ $post->author->name }}</a></span>
                        <div class="pull-right">
                          <span>{{ $post->created_at }}</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /single blog -->
                @endforeach
              </div>
              <!-- /row -->
    
              <!-- row -->
              <div class="row">
    
                <!-- pagination -->
                <div class="col-md-12">
                  <div class="post-pagination">
                    {{ $posts->links() }}
                  </div>
                </div>
                <!-- pagination -->
    
              </div>
              <!-- /row -->
            @else
              <div class="row">
                <div class="col-md-12">
                  <p class="text-center fs-4">No post found.</p>
                </div>
              </div>
            @endif

					</div>
					<!-- /main blog -->

					<!-- aside blog -->
					<div id="aside" class="col-md-3">

						<!-- search widget -->
						<div class="widget search-widget">
							<form action="{{ route('blogposts') }}">

                @if (request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
          
                @if (request('author'))
                    <input type="hidden" name="author" value="{{ request('author') }}">
                @endif

								<input class="input" type="text" name="search" value="{{ request('search') }}">
								<button type="submit"><i class="fa fa-search"></i></button>
							</form>
						</div>
						<!-- /search widget -->

            @if ($categories->count())
						<!-- category widget -->
              <div class="widget category-widget">
                <h3>Categories</h3>
                @foreach ($categories as $category)
                <a class="category" href="/blogposts?category={{ $category->slug }}">{{ $category->name }} <span>{{ $category->post->count() }}</span></a>
                @endforeach
              </div>
              <!-- /category widget -->
            @endif

				</div>
				<!-- row -->

			</div>
			<!-- container -->

		</div>
		<!-- /Blog -->

@endsection