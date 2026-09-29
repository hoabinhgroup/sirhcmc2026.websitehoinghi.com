@php
  $programDays = config('program.days', []);
  $sharedClasses = [
      'shared' => 'program-cell--shared',
      'break' => 'program-cell--shared',
      'dinner' => 'program-cell--dinner',
  ];
@endphp

<!-- Program Schedule Section Begin -->
<section class="schedule-table-section spad program-schedule-section" x-data="{ day: '1' }">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        @if (route('schedule') !== request()->url())
          <div class="section-title">
            <h2>{{ $titleVi ?? 'CHƯƠNG TRÌNH DỰ KIẾN' }}</h2>
            <p>{{ $titleEn ?? 'TENTATIVE PROGRAM' }}</p>
          </div>
        @endif
        <div class="schedule-table-tab program-schedule-tab">
          <div class="switch-language program-day-switch">
            @foreach ($programDays as $index => $programDay)
              <button @click="day = '{{ $index + 1 }}'" :class="{ 'active': day === '{{ $index + 1 }}' }"
                class="button-day{{ $index + 1 }}" type="button">
                <strong>{{ $programDay['label'] }}</strong>
                <span>{{ $programDay['date'] }}</span>
              </button>
            @endforeach
          </div>
          <div class="program-top-image">
            <img src="{{ Storage::url('img/banner web-01.jpg') }}" alt="Program Top">
          </div>
          <div class="program-tab-panels">
            @foreach ($programDays as $index => $programDay)
              <div x-show="day === '{{ $index + 1 }}'" x-cloak>
                <div class="schedule-table-content program-table-wrap">
                  <table class="program-table">
                    <thead>
                      <tr>
                        <th class="program-th program-th--time">Time</th>
                        @foreach ($programDay['rooms'] as $roomIndex => $room)
                          <th class="program-th program-th--ballroom{{ $roomIndex + 1 }}">{{ $room }}</th>
                        @endforeach
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($programDay['rows'] as $row)
                        <tr>
                          <td class="event-time">{{ $row['time'] }}</td>
                          @if (isset($row['session']))
                            <td colspan="{{ count($programDay['rooms']) }}"
                              class="program-cell {{ $sharedClasses[$row['type']] ?? 'program-cell--shared' }}">
                              @include('pages.schedule.partials.program-session', ['session' => $row['session']])
                            </td>
                          @else
                            @foreach ($row['cells'] as $cellIndex => $cell)
                              @if ($cell)
                                <td
                                  class="program-cell {{ $row['type'] === 'lunch' ? 'program-cell--lunch' : 'program-cell--ballroom' . ($cellIndex + 1) }}">
                                  @include('pages.schedule.partials.program-session', ['session' => $cell])
                                </td>
                              @else
                                <td class="program-cell program-cell--empty"></td>
                              @endif
                            @endforeach
                          @endif
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Program Schedule Section End -->
