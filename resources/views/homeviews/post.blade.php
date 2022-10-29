@extends('homeviews.layouts.main')

@section('container')

		<!-- Hero-area -->
		<div class="hero-area section">

			<!-- Backgound Image -->
			<div class="bg-image bg-parallax overlay" style="background-image:url({{ ($post->image) ? asset('assets/'. $post->image ) : asset('img').'/blog-post-background.jpg' }})"></div>
			<!-- /Backgound Image -->

			<div class="container">
				<div class="row">
					<div class="col-md-10 col-md-offset-1 text-center">
						<ul class="hero-area-tree">
							<li><a href="{{ route('home') }}">Home</a></li>
							<li><a href="{{ route('blogposts') }}">{{ $title }}</a></li>
							<li>{{ $post->title }}</li>
						</ul>
						<h1 class="white-text">{{ $post->title }}</h1>
						<ul class="blog-post-meta">
							<li class="blog-meta-author">By : <a href="/blogposts?author={{ $post->author->username }}">{{ $post->author->name }}</a></li>
							<li class="blog-meta-category">In : <a href="/blogposts?category={{ $post->category->slug }}">{{ $post->category->name }}</a></li>
							<li>{{ $post->created_at }}</li>
						</ul>
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

						<!-- blog post -->
						<div class="blog-post">
                            {!! $post->body !!}
						</div>
						<!-- /blog post -->
{{-- 
						<!-- blog share -->
						<div class="blog-share">
							<h4>Share This Post:</h4>
							<a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
							<a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
							<a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
						</div>
						<!-- /blog share --> --}}

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
				<!-- row -->

			</div>
			<!-- container -->

		</div>
		<!-- /Blog -->

@endsection