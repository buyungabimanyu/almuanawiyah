		<!-- Footer -->
		<footer id="footer" class="section">

			<!-- container -->
			<div class="container">

				<!-- row -->
				<div id="bottom-footer" class="row">

					<!-- social -->
					<div class="col-md-4 col-md-push-8">
						@if (App\Models\Setting::footer()->count())
							<ul class="footer-social">
								@foreach (App\Models\Setting::footer() as $item)
									<li><a href="{{ $item->body }}" class="{{ $item->font->body }}"><i class="fa-brands {{ $item->font->icon }}"></i></a></li>
								@endforeach
							</ul>	
						@else
							<ul class="footer-social">	
								<li><a href="#" class="facebook"><i class="fa-brands fa-facebook"></i></a></li>
								<li><a href="#" class="twitter"><i class="fa-brands fa-twitter"></i></a></li>
								<li><a href="#" class="google-plus"><i class="fa-brands fa-google-plus"></i></a></li>
								<li><a href="#" class="instagram"><i class="fa-brands fa-instagram"></i></a></li>
								<li><a href="#" class="youtube"><i class="fa-brands fa-youtube"></i></a></li>
								<li><a href="#" class="linkedin"><i class="fa-brands fa-linkedin"></i></a></li>
							</ul>
						@endif
					</div>
					<!-- /social -->

					<!-- copyright -->
					<div class="col-md-8 col-md-pull-4">
						<div class="footer-copyright">
							<span>&copy; Copyright 2018. All Rights Reserved. | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com">Colorlib</a></span>
						</div>
					</div>
					<!-- /copyright -->

				</div>
				<!-- row -->

			</div>
			<!-- /container -->

		</footer>
		<!-- /Footer -->

		<!-- preloader -->
		<div id='preloader'><div class='preloader'></div></div>
		<!-- /preloader -->
