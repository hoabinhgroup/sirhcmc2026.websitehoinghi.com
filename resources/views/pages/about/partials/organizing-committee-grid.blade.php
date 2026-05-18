<div class="oc-grid">
  @foreach ($members as $member)
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
          <p class="oc-card-role">{{ $member['role'] }}</p>
        </div>
      </div>
    </div>
  @endforeach
</div>
