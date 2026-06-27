@extends('emails.layout')

@section('content')
  @if ($registration->is_international)
    <p style="margin:0 0 16px;">Dear <strong>{{ $registration->title }} {{ $registration->fullname }}</strong>,</p>
    <p style="margin:0 0 20px;">Unfortunately, your online payment for <strong>SIRHCM 2026</strong> was <strong style="color:#dc2626;">not successful</strong>. Your registration has been received by the Secretariat.</p>
  @else
    <p style="margin:0 0 16px;">Kính gửi <strong>{{ $registration->title }} {{ $registration->fullname }}</strong>,</p>
    <p style="margin:0 0 20px;">Thanh toán online cho <strong>SIRHCM 2026</strong> <strong style="color:#dc2626;">không thành công</strong>. Hồ sơ đăng ký vẫn đã được gửi tới Ban Tổ chức.</p>
  @endif

  @include('emails.registration._details')

  <p style="margin:16px 0 0;">
    {{ $registration->is_international
        ? 'Please contact sirhcm2024@gmail.com or retry payment. Registration ID: '.$registration->guest_code
        : 'Vui lòng liên hệ sirhcm2024@gmail.com hoặc thử thanh toán lại. Mã đăng ký: '.$registration->guest_code }}
  </p>

  <p style="margin:24px 0 0;">
    {{ $registration->is_international ? 'Best regards' : 'Trân trọng' }},<br>
    <strong>SIRHCM 2026 Secretariat</strong>
  </p>
@endsection
