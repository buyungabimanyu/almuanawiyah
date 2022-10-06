		<!-- Header -->
		<header id="header" class="transparent-nav">
			<div class="container">

				<div class="navbar-header">
					<!-- Logo -->
					<div class="navbar-brand">
						<a class="logo white-text" href="{{ route('home') }}">
							<img src="{{ asset('storage/' . App\Models\Setting::logo()) }}" alt="{{ (App\Models\Setting::title()) ? App\Models\Setting::title() : 'Al-Muanawiyah' }}">
							{{ (App\Models\Setting::title()) ? App\Models\Setting::title() : 'Al-Muanawiyah' }}
						</a>
					</div>
					<!-- /Logo -->

					<!-- Mobile toggle -->
					<button class="navbar-toggle">
						<span></span>
					</button>
					<!-- /Mobile toggle -->
				</div>

				<!-- Navigation -->
				<nav id="nav">
					<ul class="main-menu nav navbar-nav navbar-right">
						@if (Request::is('blogposts'))							
							<li>
								<a class="nav-link {{ ($active === "Home") ? 'active' : '' }}" href="{{ route('home') }}#home">HOME</a>	
							</li>
							<li>
								<a class="nav-link {{ ($active === "About") ? 'active' : '' }}" href="{{ route('home') }}#about">ABOUT</a>
							</li>
							<li>
								<a class="nav-link {{ ($active === "Courses") ? 'active' : '' }}" href="{{ route('home') }}#courses">COURSES</a>
							</li>
							<li>
								<a class="nav-link {{ ($active === "Contacts") ? 'active' : '' }}" href="{{ route('home') }}#contact">CONTACT</a>
							</li>
							<li>
								<a class="nav-link {{ ($active === "blogposts") ? 'active' : '' }}" href="{{ (Request::is('blogposts/{post:slug}')) ? route('blogposts') : __('#blogposts') }}">BLOG</a>
							</li>
						@else							
							<li>
								<a class="nav-link {{ ($active === "Home") ? 'active' : '' }}" href="#home">HOME</a>	
							</li>
							<li>
								<a class="nav-link {{ ($active === "About") ? 'active' : '' }}" href="#about">ABOUT</a>
							</li>
							<li>
								<a class="nav-link {{ ($active === "Courses") ? 'active' : '' }}" href="#courses">COURSES</a>
							</li>
							<li>
								<a class="nav-link {{ ($active === "Contacts") ? 'active' : '' }}" href="#contact">CONTACT</a>
							</li>
							<li>
								<a class="nav-link {{ ($active === "blogposts") ? 'active' : '' }}" href="{{ route('blogposts') }}">BLOG</a>
							</li>
						@endif
					</ul>
				</nav>
				<!-- /Navigation -->

			</div>
		</header>
		<!-- /Header -->