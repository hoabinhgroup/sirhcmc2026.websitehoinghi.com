<table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="margin:0 0 24px;background:#f8f9fb;border-left:4px solid #ec1f23;">
  <tr>
    <td style="padding:16px 18px;">
      <p style="margin:0 0 8px;"><strong style="color:#171822;">{{ $registration->is_international ? 'Registration ID' : 'Mã đăng ký' }}:</strong> {{ $registration->guest_code }}</p>
      <p style="margin:0 0 8px;"><strong style="color:#171822;">{{ $registration->is_international ? 'Affiliation' : 'Đơn vị' }}:</strong> {{ $registration->affiliation }}</p>
      @if ($registration->is_international)
        <p style="margin:0 0 8px;"><strong style="color:#171822;">Country/Region:</strong> {{ $registration->country }}</p>
      @endif
      <p style="margin:0 0 8px;"><strong style="color:#171822;">{{ $registration->is_international ? 'Conference type' : 'Loại đại biểu' }}:</strong> {{ $registration->conference_type }}</p>
      <p style="margin:0 0 8px;"><strong style="color:#171822;">Gala Dinner:</strong> {{ $registration->galadinnerLabel() }}</p>
      <p style="margin:0 0 8px;"><strong style="color:#171822;">{{ $registration->is_international ? 'Total amount' : 'Tổng tiền' }}:</strong> {{ $registration->total_formatted }}</p>
      <p style="margin:0 0 8px;"><strong style="color:#171822;">Email:</strong> {{ $registration->email }}</p>
    </td>
  </tr>
</table>

<p style="margin:0 0 12px;">
  <strong>{{ $registration->is_international ? 'Event' : 'Sự kiện' }}:</strong> {{ $registration->is_international ? config('registration.event.name_en') : config('registration.event.name_vi') }}<br>
  <strong>{{ $registration->is_international ? 'Dates' : 'Thời gian' }}:</strong> {{ config('registration.event.dates') }}<br>
  <strong>{{ $registration->is_international ? 'Venue' : 'Địa điểm' }}:</strong> {{ config('registration.event.venue') }}
</p>
