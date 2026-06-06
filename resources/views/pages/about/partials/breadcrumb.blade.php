<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="breadcrumb-text">
          <h2>SIRHCM 2026</h2>
          <div class="bt-option">
            <a href="{{ route('home') }}">Home</a>
            @isset($breadcrumbCurrent)
              <a href="{{ route('about') }}">SIRHCM 2026</a>
              <span>{{ $breadcrumbCurrent }}</span>
            @else
              <span>SIRHCM 2026</span>
            @endisset
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Breadcrumb Section End -->
