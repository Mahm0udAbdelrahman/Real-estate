<header class="main-header" id="header">
    <nav class="navbar navbar-expand-lg navbar-light" id="navbar">
      <!-- Sidebar toggle button -->
      <button id="sidebar-toggler" class="sidebar-toggle">
        <span class="sr-only">Toggle navigation</span>
      </button>

      <span class="page-title">dashboard</span>

      <div class="navbar-right ">

        <!-- search form -->
        <div class="search-form">
          <form action="index.html" method="get">
            <div class="input-group input-group-sm" id="input-group-search">
              <input type="text" autocomplete="off" name="query" id="search-input" class="form-control" placeholder="Search..." />
              <div class="input-group-append">
                <button class="btn" type="button">/</button>
              </div>
            </div>
          </form>
          <ul class="dropdown-menu dropdown-menu-search">

            <li class="nav-item">
              <a class="nav-link" href="index.html">Morbi leo risus</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.html">Dapibus ac facilisis in</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.html">Porta ac consectetur ac</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.html">Vestibulum at eros</a>
            </li>

          </ul>

        </div>


        <ul class="nav navbar-nav">

            <li class="nav-item dropdown custom-dropdown">
                <button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @foreach ($languages as $language)
                    @if(Session::get('locale') == $language->abbreviations)
                    <img width="25" height="25" src="{{ $language->media->first()->getUrl() }}" alt="Language Flag" class="notify-toggler custom-dropdown-toggler">
                    @endif
                    @endforeach
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                        {{ $properties['native'] }}
                    </a>
                    @endforeach
                </div>
            </li>

          <!-- Offcanvas -->
          <li class="custom-dropdown">
            <a class="offcanvas-toggler active custom-dropdown-toggler" data-offcanvas="contact-off" href="javascript:" >
              <i class="mdi mdi-contacts icon"></i>
            </a>
          </li>

          <!-- User Account -->
          <li class="dropdown user-menu">
            <button class="dropdown-toggle nav-link" data-toggle="dropdown">
              <img src="{{ asset('images/user/user-xs-01.jpg')}}" class="user-image rounded-circle" alt="User Image" />
              <span class="d-none d-lg-inline-block">{{ Auth::guard('member')->user()->name}}</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-right">
              <li>
                <a class="dropdown-link-item" href="">
                  <i class="mdi mdi-account-outline"></i>
                  <span class="nav-text">My Profile</span>
                </a>
              </li>
              <li>
                <a class="dropdown-link-item" href="email-inbox.html">
                  <i class="mdi mdi-email-outline"></i>
                  <span class="nav-text">Message</span>
                  <span class="badge badge-pill badge-primary">24</span>
                </a>
              </li>
              <li>
                <a class="dropdown-link-item" href="user-activities.html">
                  <i class="mdi mdi-diamond-stone"></i>
                  <span class="nav-text">Activitise</span></a>
              </li>
              <li>
                <a class="dropdown-link-item" href="user-account-settings.html">
                  <i class="mdi mdi-settings"></i>
                  <span class="nav-text">Account Setting</span>
                </a>
              </li>

              <li class="dropdown-footer">
                <form method="GET" action="{{ route('member.logout') }}">
                    @csrf
                    <button class="dropdown-link-item"> <i class="mdi mdi-logout"></i> Log Out </button>
                </form>

                </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>


  </header>
