@extends('dashboard.layouts.main')

@section('container')

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
        <a class="btn btn-info" href="{{ route('homeview') }}">Rubah Isi Kalimat ini</a>
        </div>
      </div>
    </div>
  </div>
</div>
<a class="btn btn-info" href="{{ route('mainview') }}">Rubah Gambar Main header</a>
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
            <a class="btn btn-info" href="{{ route('aboutview') }}">Rubah Isi Kalimat dan gambar ini</a>
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
          
          <a class="btn btn-info" href="{{ route('alasanview') }}">Tambah dan rubah beberapa alasan</a>
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
          <a class="btn btn-info" href="{{ route('coursesview') }}">Rubah Isi Kalimat ini</a>
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
                  <div class="course-img">
                    @if ($item->image)
                      <img src="{{ asset('assets/' . $item->image) }}" alt="{{ $item->title }}">
                    @else
                      <img src="{{ asset('assets/main') }}/course01.jpg" alt="{{ $item->title }}">
                    @endif
                    <i class="course-link-icon fa fa-link"></i>
                  </div>
                  <div class="course-title">
                    {{ $item->title }}
                  </div>
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
                <a href="#" class="course-img">
                  <img src="{{ asset('assets/main') }}/course01.jpg" alt="">
                  <i class="course-link-icon fa fa-link"></i>
                </a>
                <a class="course-title" href="#">Beginner to Pro in Excel: Financial Modeling and Valuation</a>
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
                <a href="#" class="course-img">
                  <img src="{{ asset('assets/main') }}/course02.jpg" alt="">
                  <i class="course-link-icon fa fa-link"></i>
                </a>
                <a class="course-title" href="#">Introduction to CSS </a>
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
                <a href="#" class="course-img">
                  <img src="{{ asset('assets/main') }}/course03.jpg" alt="">
                  <i class="course-link-icon fa fa-link"></i>
                </a>
                <a class="course-title" href="#">The Ultimate Drawing Course | From Beginner To Advanced</a>
                <div class="course-details">
                  <span class="course-category">Drawing</span>
                  <span class="course-price course-premium">Premium</span>
                </div>
              </div>
            </div>
            <!-- /single course -->

            <div class="col-md-3 col-sm-6 col-xs-6">
              <div class="course">
                <a href="#" class="course-img">
                  <img src="{{ asset('assets/main') }}/course04.jpg" alt="">
                  <i class="course-link-icon fa fa-link"></i>
                </a>
                <a class="course-title" href="#">The Complete Web Development Course</a>
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
                <a href="#" class="course-img">
                  <img src="{{ asset('assets/main') }}/course05.jpg" alt="">
                  <i class="course-link-icon fa fa-link"></i>
                </a>
                <a class="course-title" href="#">PHP Tips, Tricks, and Techniques</a>
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
                <a href="#" class="course-img">
                  <img src="{{ asset('assets/main') }}/course06.jpg" alt="">
                  <i class="course-link-icon fa fa-link"></i>
                </a>
                <a class="course-title" href="#">All You Need To Know About Web Design</a>
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
                <a href="#" class="course-img">
                  <img src="{{ asset('assets/main') }}/course07.jpg" alt="">
                  <i class="course-link-icon fa fa-link"></i>
                </a>
                <a class="course-title" href="#">How to Get Started in Photography</a>
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
                <a href="#" class="course-img">
                  <img src="{{ asset('assets/main') }}/course08.jpg" alt="">
                  <i class="course-link-icon fa fa-link"></i>
                </a>
                <a class="course-title" href="#">Typography From A to Z</a>
                <div class="course-details">
                  <span class="course-category">Typography</span>
                  <span class="course-price course-free">Free</span>
                </div>
              </div>
            </div>
            <!-- /single course -->
          @endif
          <a class="btn btn-info text-center" href="{{ route('courses.index') }}">tambah dan edit courses/menu pendidikan</a>
        </div>
        <!-- /row -->

      </div>
      <!-- /courses -->

    </div>
    <!-- container -->

  </div>
  <!-- /Courses -->

{{-- <!-- Call To Action -->
<div id="cta" class="section">

<!-- Backgound Image -->
<div class="bg-image bg-parallax overlay" style="background-image:url(./img/cta1-background.jpg)"></div>
<!-- /Backgound Image -->

<!-- container -->
<div class="container">

  <!-- row -->
  <div class="row">

    <div class="col-md-6">
      <h2 class="white-text">Ceteros fuisset mei no, soleat epicurei adipiscing ne vis.</h2>
      <p class="lead white-text">Ceteros fuisset mei no, soleat epicurei adipiscing ne vis. Et his suas veniam nominati.</p>
      <a class="main-button icon-button" href="#">Get Started!</a>
    </div>

  </div>
  <!-- /row -->

</div>
<!-- /container -->

</div>
<!-- /Call To Action --> --}}

<!-- Why us -->
<div class="section">

<!-- container -->
<div class="container">

  <!-- row -->
  <div class="row">
    <div class="section-header text-center">
      <h2>{{ App\Models\Views::whyTitle() }}</h2>
      <p class="lead">{{ App\Models\Views::whyBody() }}</p>
      <a class="btn btn-info" href="{{ route('whyview') }}">Rubah Kalimat ini</a>
    </div>

    @if ($alasan->count())
      @foreach ($alasan as $item)							
        <!-- feature -->
        <div class="col-md-4">
          <div class="feature">
            <i class="feature-icon {!! $item->image !!}"></i>
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
    <a class="btn btn-info" href="{{ route('alasanview') }}">Tambah dan rubah beberapa alasan</a>

  </div>
  <!-- /row -->

  <hr class="section-hr">

  <!-- row -->
  <div class="row">
    <a class="btn btn-info" href="{{ route('videoview') }}">Rubah Kalimat dan link video</a>
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
<div class="section">

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
        @if (session()->has('success'))
          <div class="alert alert-success" role="alert">
            {{ session('success') }}
          </div>
        @endif
        <form action="" method="POST">
          @csrf
          <input class="input" type="text" name="name" placeholder="Name">
          <input class="input" type="email" name="email" placeholder="Email">
          <input class="input" type="text" name="subject" placeholder="Subject">
          <textarea class="input" name="message" placeholder="Enter your Message"></textarea>
          <button type="button" class="main-button icon-button pull-right">Send Message</button>
        </form>
      </div>
    </div>
    <!-- /contact form -->

    <!-- contact information -->
    <div class="col-md-5 col-md-offset-1">
      <h4>Contact Information</h4>
      <ul class="contact-details">
        <li><i class="fa fa-envelope"></i>{{ App\Models\Views::contactEmail() }}</li>
        <li>
          <a href="http://wa.me/{{ App\Models\Views::contactPhone() }}" target="_blank" rel="noopener noreferrer">
            <i class="fa fa-phone"></i>{{ App\Models\Views::contactPhone() }}</li>
          </a>
        <li><i class="fa fa-map-marker"></i>{{ App\Models\Views::contactAddress() }}</li>
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

<a class="btn btn-info" href="{{ route('contactview') }}">Edit Contact View</a>

</div>
<!-- /Contact -->

@endsection