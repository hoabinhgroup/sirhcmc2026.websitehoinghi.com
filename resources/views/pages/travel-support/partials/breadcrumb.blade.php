<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="breadcrumb-text">
          <h2>TRAVEL SUPPORT</h2>
          <div class="bt-option">
            <a href="{{ route('home') }}">Home</a>
            @isset($breadcrumbCurrent)
              <a href="{{ route('travel-support') }}">Travel Support</a>
              <span>{{ $breadcrumbCurrent }}</span>
            @else
              <span>Travel Support</span>
            @endisset
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Breadcrumb Section End -->
