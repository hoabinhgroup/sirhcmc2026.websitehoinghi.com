@extends('emails.layout')

@section('content')
  @if ($registration->is_international)
    <p style="margin:0 0 16px;">Dear <strong>{{ $registration->title }} {{ $registration->fullname }}</strong>,</p>
    <p style="margin:0 0 20px;">Thank you for registering for <strong>SIRHCM 2026</strong>. Please complete your online payment using the link below.</p>
  @else
    <p style="margin:0 0 16px;">Kính gửi <strong>{{ $registration->title }} {{ $registration->fullname }}</strong>,</p>
    <p style="margin:0 0 20px;">Cảm ơn Quý Đại biểu đã đăng ký <strong>SIRHCM 2026</strong>. Vui lòng hoàn tất thanh toán online qua liên kết bên dưới.</p>
  @endif

  @include('emails.registration._details')

  @if ($paymentLink)
    <p style="margin:0 0 16px;text-align:center;">
      <a href="{{ $paymentLink }}" style="display:inline-block;padding:12px 24px;background:#ec1f23;color:#ffffff;text-decoration:none;border-radius:4px;font-weight:bold;">
        {{ $registration->is_international ? 'Pay now via OnePay' : 'Thanh toán OnePay' }}
      </a>
    </p>
    <p style="margin:0 0 16px;font-size:13px;color:#6a6b7c;">{{ $registration->is_international ? 'A 6% transaction fee is included in the total amount.' : 'Phí giao dịch 6% đã được cộng vào tổng tiền.' }}</p>
  @endif

  <p style="margin:24px 0 0;">
    {{ $registration->is_international ? 'Best regards' : 'Trân trọng' }},<br>
    <strong>SIRHCM 2026 Secretariat</strong>
  </p>
@endsection
