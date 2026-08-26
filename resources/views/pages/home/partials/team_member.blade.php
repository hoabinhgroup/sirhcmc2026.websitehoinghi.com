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

  <div class="faculty-marquee" data-faculty-marquee aria-label="Faculty slider">
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
                <img src="{{ $imageUrl }}" alt="{{ $member['name'] }}" decoding="async">
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

@push('scripts')
<script>
(function () {
    var root = document.querySelector('[data-faculty-marquee]');
    if (!root) {
        return;
    }

    var track = root.querySelector('.faculty-marquee-track');
    if (!track) {
        return;
    }

    root.classList.add('is-js');

    var paused = false;
    var offset = 0;
    var last = 0;
    var speed = 90;
    var hoverMq = window.matchMedia('(hover: hover) and (pointer: fine)');

    function loopWidth() {
        return track.scrollWidth / 2;
    }

    function tick(now) {
        if (!last) {
            last = now;
        }

        var dt = Math.min(48, now - last);
        last = now;

        if (!paused && !document.hidden) {
            var half = loopWidth();
            if (half > 1) {
                offset += speed * (dt / 1000);
                if (offset >= half) {
                    offset -= half;
                }
                track.style.transform = 'translate3d(' + (-offset).toFixed(2) + 'px,0,0)';
            }
        }

        window.requestAnimationFrame(tick);
    }

    root.addEventListener('mouseenter', function () {
        if (hoverMq.matches) {
            paused = true;
        }
    });
    root.addEventListener('mouseleave', function () {
        paused = false;
    });

    window.addEventListener('load', function () {
        var half = loopWidth();
        if (half > 1) {
            offset = offset % half;
        }
    });

    window.requestAnimationFrame(tick);
})();
</script>
@endpush
