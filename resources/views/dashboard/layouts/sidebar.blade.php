<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
      @guest
      <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link {{ Request::is('login*') ? 'active' : '' }}" aria-current="page" href="{{ route('login') }}">
            <span data-feather="log-in" class="align-text-bottom"></span>
            Login
          </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('register*') ? 'active' : '' }}" aria-current="page" href="{{ route('register') }}">
            <span data-feather="edit-2" class="align-text-bottom"></span>
            Register
          </a>
        </li>
      </ul>
      @endguest
      @auth          
        <ul class="nav flex-column">
          <li class="nav-item">
              <a class="nav-link {{ Request::is('profile*') ? 'active' : '' }}" aria-current="page" href="{{ route('profile.edit') }}">
              <span data-feather="book-open" class="align-text-bottom"></span>
              Profile
            </a>
          </li>
          @can('editor')            
          <li class="nav-item">
            <a class="nav-link {{ Request::is('post*') ? 'active' : '' }}" href="{{ route('post.index') }}">
              <span data-feather="file-text" class="align-text-bottom"></span>
              My Posts
            </a>
          </li>
          @endcan
        </ul>

        @can('admin') 
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Administrator</span>
        </h6>
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link {{ Request::is('categories*') ? 'active' : '' }}" aria-current="page" href="{{ route('categories.index') }}">
              <span data-feather="grid" class="align-text-bottom"></span>
              Post Categories
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('users*') ? 'active' : '' }}" aria-current="page" href="{{ route('users.index') }}">
              <span data-feather="list" class="align-text-bottom"></span>
              Users List
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('allposts*') ? 'active' : '' }}" aria-current="page" href="{{ route('allposts.index') }}">
              <span data-feather="archive" class="align-text-bottom"></span>
              All Posts
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('contactus*') ? 'active' : '' }}" aria-current="page" href="{{ route('contactus') }}">
              <span data-feather="archive" class="align-text-bottom"></span>
              Email Sender
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('views*') ? 'active' : '' }}" aria-current="page" href="{{ route('views') }}">
              <span data-feather="layout" class="align-text-bottom"></span> Views
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('setting*') ? 'active' : '' }}" aria-current="page" href="{{ route('setting.index') }}">
              <span data-feather="sliders" class="align-text-bottom"></span>
              Setting
            </a>
          </li>
        </ul>
        @endcan
      @endauth
    </div>
  </nav>