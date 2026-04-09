  <!-- Header Section Begin -->
  <header class="header-section">
    <div class="container">
      <div class="logo">
        <a href="{{ route('home') }}">
          <img src="{{ Storage::url('img/logo.png') }}" alt="">
        </a>
      </div>
      <div class="nav-menu">
        <nav class="mainmenu mobile-menu">
          <ul>
            @foreach ($headerMenu as $item)
              <li class="{{ $navActive($item) ? 'active' : '' }}">
                @if (! empty($item['children']))
                  <a href="#" class="nav-link" onclick="return false;" role="button" aria-haspopup="true">
                    <div class="nav-link-text-vietnamese">{{ $item['label_vi'] }}</div>
                    <div class="nav-link-text-english">{{ $item['label_en'] }}</div>
                  </a>
                @else
                  <a class="nav-link" href="{{ route($item['route']) }}">
                    <div class="nav-link-text-vietnamese">{{ $item['label_vi'] }}</div>
                    <div class="nav-link-text-english">{{ $item['label_en'] }}</div>
                  </a>
                @endif
                @if (! empty($item['children']))
                  <ul class="dropdown">
                    @foreach ($item['children'] as $child)
                      <li class="{{ request()->routeIs($child['route']) ? 'active' : '' }}">
                        <a href="{{ route($child['route']) }}">
                          <div class="nav-link-text-vietnamese">{{ $child['label_vi'] }}</div>
                          <div class="nav-link-text-english">{{ $child['label_en'] }}</div>
                        </a>
                      </li>
                    @endforeach
                  </ul>
                @endif
              </li>
            @endforeach
          </ul>
        </nav>
      </div>
      <div id="mobile-menu-wrap"></div>
    </div>
  </header>
  <!-- Header End -->
