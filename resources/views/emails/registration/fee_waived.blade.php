@extends('emails.layout')

@section('content')
  @if ($registration->is_international)
    <p style="margin:0 0 16px;">Dear <strong>{{ $registration->title }} {{ $registration->fullname }}</strong>,</p>
    <p style="margin:0 0 20px;">Thank you for registering for <strong>SIRHCM 2026</strong>. Your registration is confirmed with <strong>no registration fee</strong>.</p>
  @else
    <p style="margin:0 0 16px;">Kính gửi <strong>{{ $registration->title }} {{ $registration->fullname }}</strong>,</p>
    <p style="margin:0 0 20px;">Cảm ơn Quý Đại biểu đã đăng ký <strong>SIRHCM 2026</strong>. Hồ sơ của Quý Đại biểu được xác nhận <strong>miễn phí đăng ký</strong>.</p>
  @endif

  @include('emails.registration._details')

  <p style="margin:24px 0 0;">
    {{ $registration->is_international ? 'Best regards' : 'Trân trọng' }},<br>
    <strong>SIRHCM 2026 Secretariat</strong>
  </p>
@endsection
