		<!-- Header -->
		<header id="header" class="transparent-nav">
			<div class="container">

				<div class="navbar-header">
					<!-- Logo -->
					<div class="navbar-brand">
						<a class="logo white-text" href="{{ route('home') }}">
							<img src="{{ asset('assets/' . App\Models\Setting::logo()) }}">
							{{ App\Models\Setting::title() }}
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
						@switch($request)
							@case('blogposts')
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
									<a class="nav-link {{ ($active === "blogposts") ? 'active' : '' }}" href="#blogposts">BLOG</a>
								</li>
								@break
							@case('post')
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
									<a class="nav-link {{ ($active === "blogposts") ? 'active' : '' }}" href="{{ route('blogposts') }}">BLOG</a>
								</li>
								@break
							@default
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
						@endswitch
					</ul>
				</nav>
				<!-- /Navigation -->

			</div>
		</header>
		<!-- /Header -->