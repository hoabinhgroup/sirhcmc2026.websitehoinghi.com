  @php
    $socials = ['facebook', 'instagram', 'twitter', 'linkedin'];
    $members = [
        ['image' => 'https://placehold.co/300x350', 'name' => 'Emma Sandoval', 'role' => 'Speaker'],
        ['image' => 'https://placehold.co/300x350', 'name' => 'Emma Sandoval', 'role' => 'Speaker'],
        ['image' => 'https://placehold.co/300x350', 'name' => 'Emma Sandoval', 'role' => 'Speaker'],
        ['image' => 'https://placehold.co/300x350', 'name' => 'Emma Sandoval', 'role' => 'Speaker'],
        ['image' => 'https://placehold.co/300x350', 'name' => 'Emma Sandoval', 'role' => 'Speaker'],
        ['image' => 'https://placehold.co/300x350', 'name' => 'Emma Sandoval', 'role' => 'Speaker'],
        ['image' => 'https://placehold.co/300x350', 'name' => 'Emma Sandoval', 'role' => 'Speaker'],
        ['image' => 'https://placehold.co/300x350', 'name' => 'Emma Sandoval', 'role' => 'Speaker'],
        ['image' => 'https://placehold.co/300x350', 'name' => 'Emma Sandoval', 'role' => 'Speaker'],
        ['image' => 'https://placehold.co/300x350', 'name' => 'Emma Sandoval', 'role' => 'Speaker'],
    ];
  @endphp

  <!-- Team Member Section Begin -->
  <section class="team-member-section">
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

    @foreach ($members as $member)
      <div class="member-item set-bg" data-setbg="{{ $member['image'] }}">
        <div class="mi-social">
          <div class="mi-social-inner bg-gradient">
            @foreach ($socials as $social)
              <a href="#"><i class="fa fa-{{ $social }}"></i></a>
            @endforeach
          </div>
        </div>
        <div class="mi-text">
          <h5>{{ $member['name'] }}</h5>
          <span>{{ $member['role'] }}</span>
        </div>
      </div>
    @endforeach
  </section>
  <!-- Team Member Section End -->
