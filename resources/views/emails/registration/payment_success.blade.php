@extends('emails.layout')

@section('content')
  @if ($registration->is_international)
    <p style="margin:0 0 16px;">Dear <strong>{{ $registration->title }} {{ $registration->fullname }}</strong>,</p>
    <p style="margin:0 0 20px;">Your online payment for <strong>SIRHCM 2026</strong> was <strong style="color:#16a34a;">successful</strong>. Thank you!</p>
  @else
    <p style="margin:0 0 16px;">Kính gửi <strong>{{ $registration->title }} {{ $registration->fullname }}</strong>,</p>
    <p style="margin:0 0 20px;">Thanh toán online cho <strong>SIRHCM 2026</strong> của Quý Đại biểu đã <strong style="color:#16a34a;">thành công</strong>. Xin cảm ơn!</p>
  @endif

  @include('emails.registration._details')

  @if ($registration->vpc_TransactionNo)
    <p style="margin:0 0 8px;"><strong>{{ $registration->is_international ? 'Transaction ID' : 'Mã giao dịch' }}:</strong> {{ $registration->vpc_TransactionNo }}</p>
  @endif

  <p style="margin:16px 0 0;">{{ $registration->is_international ? 'An e-receipt and invitation will be sent separately if applicable.' : 'Biên lai điện tử và thư mời (nếu có) sẽ được gửi riêng.' }}</p>
  <p style="margin:8px 0 0;">{{ $registration->is_international ? 'Contact' : 'Liên hệ' }}: <a href="mailto:sirhcm2024@gmail.com">sirhcm2024@gmail.com</a></p>

  <p style="margin:24px 0 0;">
    {{ $registration->is_international ? 'Best regards' : 'Trân trọng' }},<br>
    <strong>SIRHCM 2026 Secretariat</strong>
  </p>
@endsection
