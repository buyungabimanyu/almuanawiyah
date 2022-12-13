@extends('homeviews.layouts.main')

@section('container')

@if ($information['body'] == 'on' || session('success') )
<div class="modal fade" id="info">
	<div class="modal-dialog">
		@if ($informationdata->count())
			<div class="modal-content" style="background: rgba( 0, 0, 0, 0.1 )">
				<div class="modal-header">
					<div style="position: relative; clear:both">
						<div style="float: left">
							<h4 style="color: azure">Information</h4>
						</div>
						<div style="float: right">
							<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-xmark"></i></button>
						</div>
					</div>
				</div>
				<div class="modal-body">
					<div id="main-info" class="splide" role="group" aria-label="Splide Basic HTML Example">
						<div class="splide__track">
							<ul class="splide__list">
								@foreach ($informationdata as $info)
									@if ($info->ppdb == 'on')
										<li class="splide__slide">
											<a href="#cta">
												<img src="{{ asset('assets/' . $info->body) }}" data-splide-interval="3000">
											</a>
										</li>
									@else									
										<li class="splide__slide">
											<img src="{{ asset('assets/' . $info->body) }}" data-splide-interval="3000">
										</li>
									@endif
								@endforeach
							</ul>
						</div>
					</div>
					<div id="thumbnail-info" class="splide">
						<div class="splide__track">
							<ul class="splide__list">
								@foreach ($informationdata as $info)
									<li class="splide__slide">
										<img src="{{ asset('assets/' . $info->body) }}">
									</li>
									<?php if($info->ppdb == 'on'){$ppdb = 'on';} ?>
								@endforeach
							</ul>
						</div>
					</div>
				</div>
				@if (session('success'))
					<div class="modal-footer" style="align-items:stretch; background:black">
						<h5 style="color: azure; font-size: 16px; font-weight: 500; text-align:left">{!! session('success') !!}</h5>
					</div>
				@endif
			</div>
		@endif
	</div>
</div>
<script>
	$('#info').modal('show');
	document.addEventListener( 'DOMContentLoaded', function () {
		var main = new Splide( '#main-info', {
			type      : 'fade',
			rewind    : true,
			pagination: false,
			arrows    : false,
			autoplay: true
		} );

		var thumbnails = new Splide( '#thumbnail-info', {
			fixedWidth  : 100,
			fixedHeight : 60,
			gap         : 10,
			rewind      : true,
			pagination  : false,
			isNavigation: true,
			arrows    : false,
			breakpoints : {
			600: {
				fixedWidth : 60,
				fixedHeight: 44,
			},
			},
		} );
		main.sync( thumbnails );
		main.mount();
		thumbnails.mount();
	});

</script>
@endif


		<!-- Home -->
		<div id="home" class="hero-area">

			<!-- Backgound Image -->
			<div class="bg-image bg-parallax overlay" style="background-image:url({{ asset('assets/' . App\Models\Views::mainHeader()) }})"></div>
			<!-- /Backgound Image -->

			<div class="home-wrapper">
				<div class="container">
					<div class="row">
						<div class="col-md-8">
							<h1 class="white-text">{{ App\Models\Views::homeTitle() }}</h1>
							<p class="lead white-text">{{ App\Models\Views::homeBody() }}</p>
							<a class="main-button icon-button" href="#about">Get Started!</a>
						</div>
					</div>
				</div>
			</div>

		</div>
		<!-- /Home -->

		<!-- About -->
		<div id="about" class="section">

			<!-- container -->
			<div class="container">

				<!-- row -->
				<div class="row">

					<div class="col-md-6">
						<div class="section-header">
							<h2>{{ App\Models\Views::aboutTitle() }}</h2>
							<p class="lead">{{ App\Models\Views::aboutBody() }}</p>
						</div>

						@if ($alasan->count())
							@foreach ($alasan as $item)								
								<!-- feature -->
								<div class="feature">
									<i class="feature-icon fa {{ ($item->image) ? $item->font->icon : 'fa-hashtag' }}"></i>
									<div class="feature-content">
										<h4>{{ $item->title }}</h4>
										<p>{{ $item->body }}</p>
									</div>
								</div>
								<!-- /feature -->
							@endforeach
						@else
							<!-- feature -->
							<div class="feature">
								<i class="feature-icon fa fa-flask"></i>
								<div class="feature-content">
									<h4>Online Courses </h4>
									<p>Ceteros fuisset mei no, soleat epicurei adipiscing ne vis. Et his suas veniam nominati.</p>
								</div>
							</div>
							<!-- /feature -->
	
							<!-- feature -->
							<div class="feature">
								<i class="feature-icon fa fa-users"></i>
								<div class="feature-content">
									<h4>Expert Teachers</h4>
									<p>Ceteros fuisset mei no, soleat epicurei adipiscing ne vis. Et his suas veniam nominati.</p>
								</div>
							</div>
							<!-- /feature -->
	
							<!-- feature -->
							<div class="feature">
								<i class="feature-icon fa fa-comments"></i>
								<div class="feature-content">
									<h4>Community</h4>
									<p>Ceteros fuisset mei no, soleat epicurei adipiscing ne vis. Et his suas veniam nominati.</p>
								</div>
							</div>
							<!-- /feature -->
						@endif
					</div>

					<div class="col-md-6">
						<div class="about-img">
							<img src="{{ asset('assets/' . App\Models\Views::aboutImg()) }}" alt="">
						</div>
					</div>

				</div>
				<!-- row -->

			</div>
			<!-- container -->
		</div>
		<!-- /About -->

		<!-- Courses -->
		<div id="courses" class="section">

			<!-- container -->
			<div class="container">

				<!-- row -->
				<div class="row">
					<div class="section-header text-center">
						<h2>{{ App\Models\Views::coursesTitle() }}</h2>
						<p class="lead">{{ App\Models\Views::coursesBody() }}</p>
					</div>
				</div>
				<!-- /row -->

				<!-- courses -->
				<div id="courses-wrapper">

					<!-- row -->
					<div class="row">

						@if ($courses->count())
							@foreach ($courses as $item)
								<!-- single course -->
								<div class="col-md-3 col-sm-6 col-xs-6">
									<div class="course">
										<a href="{{ route('homecourses', $item->slug) }}" class="course-img">
											@if ($item->image)
												<img src="{{ asset('assets/' . $item->image) }}" alt="{{ $item->title }}">
											@else
												<img src="{{ asset('assets/main') }}/course01.jpg" alt="{{ $item->title }}">
											@endif
											<i class="course-link-icon fa fa-link"></i>
										</a>
										<a href="{{ route('homecourses', $item->slug) }}" class="course-title">
											{{ $item->title }}
										</a>
										<div class="course-details">
											<span class="course-category">{{ $item->category->name }}</span>
										</div>
									</div>
								</div>
								<!-- /single course -->
							@endforeach
						@else							
							<!-- single course -->
							<div class="col-md-3 col-sm-6 col-xs-6">
								<div class="course">
									<a href="{{ route('courseshome') }}" class="course-img">
										<img src="{{ asset('assets/main') }}/course01.jpg" alt="">
										<i class="course-link-icon fa fa-link"></i>
									</a>
									<a class="course-title" href="{{ route('courseshome') }}">Beginner to Pro in Excel: Financial Modeling and Valuation</a>
									<div class="course-details">
										<span class="course-category">Business</span>
										<span class="course-price course-free">Free</span>
									</div>
								</div>
							</div>
							<!-- /single course -->

							<!-- single course -->
							<div class="col-md-3 col-sm-6 col-xs-6">
								<div class="course">
									<a href="{{ route('courseshome') }}" class="course-img">
										<img src="{{ asset('assets/main') }}/course02.jpg" alt="">
										<i class="course-link-icon fa fa-link"></i>
									</a>
									<a class="course-title" href="{{ route('courseshome') }}">Introduction to CSS </a>
									<div class="course-details">
										<span class="course-category">Web Design</span>
										<span class="course-price course-premium">Premium</span>
									</div>
								</div>
							</div>
							<!-- /single course -->

							<!-- single course -->
							<div class="col-md-3 col-sm-6 col-xs-6">
								<div class="course">
									<a href="{{ route('courseshome') }}" class="course-img">
										<img src="{{ asset('assets/main') }}/course03.jpg" alt="">
										<i class="course-link-icon fa fa-link"></i>
									</a>
									<a class="course-title" href="{{ route('courseshome') }}">The Ultimate Drawing Course | From Beginner To Advanced</a>
									<div class="course-details">
										<span class="course-category">Drawing</span>
										<span class="course-price course-premium">Premium</span>
									</div>
								</div>
							</div>
							<!-- /single course -->

							<div class="col-md-3 col-sm-6 col-xs-6">
								<div class="course">
									<a href="{{ route('courseshome') }}" class="course-img">
										<img src="{{ asset('assets/main') }}/course04.jpg" alt="">
										<i class="course-link-icon fa fa-link"></i>
									</a>
									<a class="course-title" href="{{ route('courseshome') }}">The Complete Web Development Course</a>
									<div class="course-details">
										<span class="course-category">Web Development</span>
										<span class="course-price course-free">Free</span>
									</div>
								</div>
							</div>
							<!-- /single course -->

							<!-- single course -->
							<div class="col-md-3 col-sm-6 col-xs-6">
								<div class="course">
									<a href="{{ route('courseshome') }}" class="course-img">
										<img src="{{ asset('assets/main') }}/course05.jpg" alt="">
										<i class="course-link-icon fa fa-link"></i>
									</a>
									<a class="course-title" href="{{ route('courseshome') }}">PHP Tips, Tricks, and Techniques</a>
									<div class="course-details">
										<span class="course-category">Web Development</span>
										<span class="course-price course-free">Free</span>
									</div>
								</div>
							</div>
							<!-- /single course -->
		
							<!-- single course -->
							<div class="col-md-3 col-sm-6 col-xs-6">
								<div class="course">
									<a href="{{ route('courseshome') }}" class="course-img">
										<img src="{{ asset('assets/main') }}/course06.jpg" alt="">
										<i class="course-link-icon fa fa-link"></i>
									</a>
									<a class="course-title" href="{{ route('courseshome') }}">All You Need To Know About Web Design</a>
									<div class="course-details">
										<span class="course-category">Web Design</span>
										<span class="course-price course-free">Free</span>
									</div>
								</div>
							</div>
							<!-- /single course -->
		
							<!-- single course -->
							<div class="col-md-3 col-sm-6 col-xs-6">
								<div class="course">
									<a href="{{ route('courseshome') }}" class="course-img">
										<img src="{{ asset('assets/main') }}/course07.jpg" alt="">
										<i class="course-link-icon fa fa-link"></i>
									</a>
									<a class="course-title" href="{{ route('courseshome') }}">How to Get Started in Photography</a>
									<div class="course-details">
										<span class="course-category">Photography</span>
										<span class="course-price course-free">Free</span>
									</div>
								</div>
							</div>
							<!-- /single course -->
		
		
							<!-- single course -->
							<div class="col-md-3 col-sm-6 col-xs-6">
								<div class="course">
									<a href="{{ route('courseshome') }}" class="course-img">
										<img src="{{ asset('assets/main') }}/course08.jpg" alt="">
										<i class="course-link-icon fa fa-link"></i>
									</a>
									<a class="course-title" href="{{ route('courseshome') }}">Typography From A to Z</a>
									<div class="course-details">
										<span class="course-category">Typography</span>
										<span class="course-price course-free">Free</span>
									</div>
								</div>
							</div>
							<!-- /single course -->
						@endif

					</div>
					<!-- /row -->

				</div>
				<!-- /courses -->

			</div>
			<!-- container -->

		</div>
		<!-- /Courses -->
		@if ($ppdb == 'on')
			<!-- Call To Action -->
			<div id="cta" class="section">

				<!-- Backgound Image -->
				<div class="bg-image bg-parallax overlay" style="background-image:url({{ asset('assets/' . App\Models\Views::ppdbImg()) }}"></div>
				<!-- /Backgound Image -->

				<!-- container -->
				<div class="container">

					<!-- row -->
					<div class="row">

						<div class="col-md-6">
							<h2 class="white-text">{{ App\Models\Views::ppdbTitle() }}</h2>
							<p class="lead white-text">{{ App\Models\Views::ppdbBody() }}</p>
							<a class="main-button icon-button" href="#pendaftaranppdb" data-toggle="modal">Daftar Sekarang!</a>
							
						</div>

					</div>
					<!-- /row -->
			
				</div>
				<!-- /container -->
				
			</div>
			<!-- /Call To Action -->
		@endif

		<!-- Why us -->
		<div id="why-us" class="section">

			<!-- container -->
			<div class="container">

				<!-- row -->
				<div class="row">
					<div class="section-header text-center">
						<h2>{{ App\Models\Views::whyTitle() }}</h2>
						<p class="lead">{{ App\Models\Views::whyBody() }}</p>
					</div>

					@if ($alasan->count())
						@foreach ($alasan as $item)							
							<!-- feature -->
							<div class="col-md-4">
								<div class="feature">
									<i class="feature-icon fa {{ ($item->image) ? $item->font->icon : 'fa-hashtag' }}"></i>
									<div class="feature-content">
										<h4>{{ $item->title }}</h4>
										<p>{{ $item->body }}</p>
									</div>
								</div>
							</div>
							<!-- /feature -->
						@endforeach
					@else
						<!-- feature -->
						<div class="col-md-4">
							<div class="feature">
								<i class="feature-icon fa fa-flask"></i>
								<div class="feature-content">
									<h4>Online Courses</h4>
									<p>Ceteros fuisset mei no, soleat epicurei adipiscing ne vis. Et his suas veniam nominati.</p>
								</div>
							</div>
						</div>
						<!-- /feature -->

						<!-- feature -->
						<div class="col-md-4">
							<div class="feature">
								<i class="feature-icon fa fa-users"></i>
								<div class="feature-content">
									<h4>Expert Teachers</h4>
									<p>Ceteros fuisset mei no, soleat epicurei adipiscing ne vis. Et his suas veniam nominati.</p>
								</div>
							</div>
						</div>
						<!-- /feature -->

						<!-- feature -->
						<div class="col-md-4">
							<div class="feature">
								<i class="feature-icon fa fa-comments"></i>
								<div class="feature-content">
									<h4>Community</h4>
									<p>Ceteros fuisset mei no, soleat epicurei adipiscing ne vis. Et his suas veniam nominati.</p>
								</div>
							</div>
						</div>
						<!-- /feature -->
					@endif


				</div>
				<!-- /row -->

				<hr class="section-hr">

				<!-- row -->
				<div class="row">

					<div class="col-md-6">
						<h3>{{ App\Models\Views::videoTitle() }}</h3>
						<p class="lead">{{ App\Models\Views::videoBody() }}</p>
						<p>{!! App\Models\Views::videoText() !!}</p>
					</div>

					<div class="col-md-5 col-md-offset-1">
						<iframe class="about-video" allowfullscreen="1" width="100%" height="300" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" src="{{ App\Models\Views::videoPlay() }}" width="640" height="360" frameborder="0"></iframe>
					</div>

				</div>
				<!-- /row -->

			</div>
			<!-- /container -->

		</div>
		<!-- /Why us -->


		<!-- Contact -->
		<div id="contact" class="section">

			<!-- container -->
			<div class="container">

				<!-- row -->
				<div class="row">
					<div class="section-header text-center">
						<h2>{{ App\Models\Views::contactTitle() }}</h2>
						<p class="lead">{{ App\Models\Views::contactBody() }}</p>
					</div>
					<!-- contact form -->
					<div class="col-md-6">
						<div class="contact-form">
							<h4>Send A Message</h4>
							<form action="{{ route('contact.us.store') }}" method="POST">
								@csrf
								<input class="input" type="text" name="name" placeholder="Name">
								<input class="input" type="email" name="email" placeholder="Email">
								<input class="input" type="text" name="subject" placeholder="Subject">
								<textarea class="input" name="message" placeholder="Enter your Message"></textarea>
								<button type="submit" class="main-button icon-button pull-right">Send Message</button>
							</form>
						</div>
					</div>
					<!-- /contact form -->

					<!-- contact information -->
					<div class="col-md-5 col-md-offset-1">
						<h4>Contact Information</h4>
						<ul class="contact-details">
							<li><i class="fa fa-envelope"></i> {{ App\Models\Views::contactEmail() }}</li>
							<li>
								<a href="http://wa.me/{{ App\Models\Views::contactPhone() }}" target="_blank" rel="noopener noreferrer">
									<i class="fa fa-phone"></i> {{ App\Models\Views::contactPhone() }}</li>
								</a>
							<li><i class="fa fa-map-marker"></i> {{ App\Models\Views::contactAddress() }}</li>
						</ul>

						<!-- contact map -->
						<div id="contact-map"></div>
						<!-- /contact map -->

					</div>
					<!-- contact information -->

				</div>
				<!-- /row -->

			</div>
			<!-- /container -->

		</div>
		<!-- /Contact -->

	@if ($ppdb == 'on')
		<div class="modal fade" id="pendaftaranppdb">
			<div class="modal-dialog modal-lg">
			  <div class="modal-content">
				<div class="modal-header">
				  <h4>Pendaftaran PPDB</h4>
				</div>
				<div class="modal-body">
					<div class="contact-form" style="color: black">					
						<form action="{{ route('pendaftaranppdb') }}" method="post">
						@csrf
						<input class="input" type="text" name="nama_siswa" placeholder="Nama Siswa">
						<input class="input" type="text" name="asal_sekolah" placeholder="Asal Sekolah">
						<textarea class="input" name="alamat" placeholder="Alamat"></textarea>
						<input class="input" type="email" name="email" placeholder="Email">
						<input class="input" type="text" name="no_tlp" placeholder="No Telepon/WhatsApp">
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Daftar</button>
					</form>
				  	<button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
				</div>
			  </div>
			</div>
		</div>
	@endif

@endsection