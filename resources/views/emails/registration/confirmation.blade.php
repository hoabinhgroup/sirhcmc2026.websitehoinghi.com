@extends('emails.layout')

@section('content')
  <p style="margin:0 0 16px;color:#171822;">
    Kính gửi <strong>{{ $registration->title }} {{ $registration->fullname }}</strong>,
  </p>

  <p style="margin:0 0 20px;">
    Cảm ơn Quý Đại biểu đã đăng ký tham dự <strong style="color:#171822;">SIRHCM 2026</strong>.
  </p>

  <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="margin:0 0 24px;background:#f8f9fb;border-left:4px solid #ec1f23;">
    <tr>
      <td style="padding:16px 18px;">
        <p style="margin:0 0 8px;"><strong style="color:#171822;">Mã đăng ký:</strong> {{ $registration->guest_code }}</p>
        <p style="margin:0 0 8px;"><strong style="color:#171822;">Đơn vị:</strong> {{ $registration->affiliation }}</p>
        <p style="margin:0 0 8px;"><strong style="color:#171822;">Gói phí:</strong> {{ $registration->conference_type }}</p>
        <p style="margin:0 0 8px;"><strong style="color:#171822;">Email:</strong> {{ $registration->email }}</p>
      </td>
    </tr>
  </table>

  <p style="margin:24px 0 0;color:#171822;">
    Trân trọng,<br>
    <strong>Ban Tổ chức SIRHCM 2026</strong>
  </p>
@endsection
