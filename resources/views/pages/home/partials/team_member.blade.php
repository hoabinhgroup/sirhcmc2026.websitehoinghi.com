@php
  $facultyMembers = config('faculty.members', []);
@endphp

<!-- Faculty Slider Section Begin -->
<section class="faculty-slider-section spad">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="section-title">
          <h2>CHỦ TOẠ - BÁO CÁO VIÊN</h2>
          <p>Faculty</p>
        </div>
      </div>
    </div>
  </div>

  <div class="faculty-marquee" aria-label="Faculty slider">
    <div class="faculty-marquee-track">
      @foreach ([1, 2] as $loopCopy)
        @foreach ($facultyMembers as $member)
          @php
            $imageUrl = str_starts_with($member['image'], 'http')
              ? $member['image']
              : Storage::url($member['image']);
            $affiliation = $member['affiliation_en'] ?? '';
          @endphp
          <div class="faculty-slide-item">
            <a href="{{ route('faculty') }}" class="faculty-slide-card">
              <div class="faculty-slide-pic">
                <img src="{{ $imageUrl }}" alt="{{ $member['name'] }}" loading="lazy">
              </div>
              <div class="faculty-slide-info">
                <h5>{{ $member['name'] }}</h5>
                @if (!empty($affiliation))
                  <span>{{ $affiliation }}</span>
                @endif
              </div>
            </a>
          </div>
        @endforeach
      @endforeach
    </div>
  </div>

  <div class="container">
    <div class="text-center faculty-slider-cta">
      <a href="{{ route('faculty') }}" class="primary-btn">View all Faculty</a>
    </div>
  </div>
</section>
<!-- Faculty Slider Section End -->