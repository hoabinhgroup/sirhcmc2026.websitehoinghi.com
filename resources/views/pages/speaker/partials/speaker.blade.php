@php
  $facultyMembers = [
    [
      'name' => 'Dr. Chun Yu Lin',
      'image' => 'img/speakers/1. Dr. Chun Yu Lin.jpg',
      'affiliation_vi' => 'Đài Loan',
      'affiliation_en' => 'Taiwan',
    ],
    [
      'name' => 'Prof. Guillaume Canaud',
      'image' => 'img/speakers/2. Prof. Guillaume Canaud.jpg',
      'affiliation_vi' => 'Pháp',
      'affiliation_en' => 'France',
    ],
    [
      'name' => 'Hiroshi Kondo, M.D., Ph.D',
      'image' => 'img/speakers/3. Hiroshi Kondo, M.D., Ph.D.png',
      'affiliation_vi' => 'Nhật Bản',
      'affiliation_en' => 'Japan',
    ],
    [
      'name' => 'Kai-Wen Huang MD, MS, PhD',
      'image' => 'img/speakers/4. Kai-Wen Huang MD, MS, PhD.jpg',
      'affiliation_vi' => 'Đài Loan',
      'affiliation_en' => 'Taiwan',
    ],
    [
      'name' => 'Prof. Martin Krauss',
      'image' => 'img/speakers/5. Prof. Martin Krauss.JPG',
      'affiliation_vi' => 'Đức',
      'affiliation_en' => 'Germany',
    ],
    [
      'name' => 'Prof. Masanori Inoue',
      'image' => 'img/speakers/6. Prof. Masanori Inoue.jpg',
      'affiliation_vi' => 'Nhật Bản',
      'affiliation_en' => 'Japan',
    ],
    [
      'name' => 'Assoc. Prof. Nakarin Inmutto',
      'image' => 'img/speakers/7. Assoc. Prof. Nakarin Inmutto.jpg',
      'affiliation_vi' => 'Thái Lan',
      'affiliation_en' => 'Thailand',
    ],
    [
      'name' => 'Panat Nisityotakul, M.D',
      'image' => 'img/speakers/8. Panat Nisityotakul, M.D.jpeg',
      'affiliation_vi' => 'Thái Lan',
      'affiliation_en' => 'Thailand',
    ],
  ];

  $speakerGroupsVi = [
    [
      'title' => 'Báo cáo viên',
      'members' => array_map(fn ($member) => [
        'name' => $member['name'],
        'image' => $member['image'],
        'role' => '<p>BÁO CÁO VIÊN</p>',
        'affiliation' => $member['affiliation_vi'],
      ], $facultyMembers),
    ],
  ];

  $speakerGroupsEn = [
    [
      'title' => 'Faculty',
      'members' => array_map(fn ($member) => [
        'name' => $member['name'],
        'image' => $member['image'],
        'role' => '<p>FACULTY</p>',
        'affiliation' => $member['affiliation_en'],
      ], $facultyMembers),
    ],
  ];
@endphp

<section id="faculty" class="about-section spad speaker-section" x-data="{ lang: 'vi' }">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="section-title">
          <h2>CHỦ TOẠ - BÁO CÁO VIÊN</h2>
          <p class="f-para">FACULTY</p>
        </div>

        <div class="switch-language oc-switch-language">
          <button @click="lang = 'vi'" :class="{ 'active': lang === 'vi' }" class="button-vietnam" type="button">Tiếng Việt</button>
          <button @click="lang = 'en'" :class="{ 'active': lang === 'en' }" class="button-english" type="button">English</button>
        </div>

        <div x-show="lang === 'vi'" x-cloak>
          @foreach ($speakerGroupsVi as $group)
            <div class="speaker-group">
              <h3 class="speaker-group-title">{{ $group['title'] }}</h3>
              <div class="oc-grid">
                @foreach ($group['members'] as $member)
                  @php
                    $imageUrl = str_starts_with($member['image'], 'http')
                      ? $member['image']
                      : Storage::url($member['image']);
                  @endphp
                  <div class="oc-card">
                    <div class="oc-card-body">
                      <div class="oc-card-pic">
                        <img src="{{ $imageUrl }}" alt="{{ $member['name'] }}">
                      </div>
                      <div class="oc-card-content">
                        <h5 class="oc-card-name">{{ $member['name'] }}</h5>
                        <div class="oc-card-role">{!! $member['role'] !!}</div>
                        @if (!empty($member['affiliation']))
                          <p class="oc-card-affiliation">{{ $member['affiliation'] }}</p>
                        @endif
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          @endforeach
        </div>

        <div x-show="lang === 'en'" x-cloak>
          @foreach ($speakerGroupsEn as $group)
            <div class="speaker-group">
              <h3 class="speaker-group-title">{{ $group['title'] }}</h3>
              <div class="oc-grid">
                @foreach ($group['members'] as $member)
                  @php
                    $imageUrl = str_starts_with($member['image'], 'http')
                      ? $member['image']
                      : Storage::url($member['image']);
                  @endphp
                  <div class="oc-card">
                    <div class="oc-card-body">
                      <div class="oc-card-pic">
                        <img src="{{ $imageUrl }}" alt="{{ $member['name'] }}">
                      </div>
                      <div class="oc-card-content">
                        <h5 class="oc-card-name">{{ $member['name'] }}</h5>
                        <div class="oc-card-role">{!! $member['role'] !!}</div>
                        @if (!empty($member['affiliation']))
                          <p class="oc-card-affiliation">{{ $member['affiliation'] }}</p>
                        @endif
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          @endforeach
        </div>

        <p class="f-para speaker-note">
          <span x-show="lang === 'vi'" x-cloak>Danh sách chủ toạ và báo cáo viên sẽ tiếp tục được cập nhật.</span>
          <span x-show="lang === 'en'" x-cloak>The faculty list will be updated continuously.</span>
        </p>
      </div>
    </div>
  </div>
</section>
