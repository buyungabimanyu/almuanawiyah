<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand bg-dark px-2" href="#">    
    <img src="{{ asset('storage/' . App\Models\Setting::logo()) }}" alt="{{ (App\Models\Setting::title()) ? App\Models\Setting::title() : 'Al-Muanawiyah' }}"  width="auto" height="35" class="align-text-top">
    {{ (App\Models\Setting::title()) ? App\Models\Setting::title() : 'Al-Muanawiyah' }}
  </a>
    @auth        
      <div class="navbar-nav">
        <div class="nav-item text-nowrap">
          <form action="/logout" method="POST">
            @csrf
            <button type="submit" class="nav-link px-3 bg-dark border-0">Logout <span data-feather="log-out" class="align-text-bottom"></span></button>
          </form>
        </div>
      </div>
    @endauth
  </header>