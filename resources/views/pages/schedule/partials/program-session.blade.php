<h5>{{ mb_strtoupper($session['title']) }}</h5>
@foreach ($session['roles'] as $role)
  <p class="program-chairman">{{ $role['label'] }}: {{ implode(' | ', $role['names']) }}</p>
@endforeach
@if (! empty($session['items']))
  <div class="program-detail-list">
    <ul>
      @foreach ($session['items'] as $item)
        <li>
          @if ($item['time'])
            <span class="talk-time">{{ $item['time'] }}</span>
          @endif
          <span class="talk-title{{ $item['break'] ? ' talk-break' : '' }}">{{ $item['title'] }}</span>
          @if ($item['speaker'])
            <span class="talk-speaker">- {{ $item['speaker'] }}</span>
          @endif
        </li>
      @endforeach
    </ul>
  </div>
@endif
