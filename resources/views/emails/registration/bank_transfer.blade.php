@extends('emails.layout')

@section('content')
  @if ($registration->is_international)
    <p style="margin:0 0 16px;">Dear <strong>{{ $registration->title }} {{ $registration->fullname }}</strong>,</p>
    <p style="margin:0 0 20px;">Thank you for registering for <strong>SIRHCM 2026</strong>. Please complete your payment via bank transfer using the details below.</p>
  @else
    <p style="margin:0 0 16px;">Kính gửi <strong>{{ $registration->title }} {{ $registration->fullname }}</strong>,</p>
    <p style="margin:0 0 20px;">Cảm ơn Quý Đại biểu đã đăng ký <strong>SIRHCM 2026</strong>. Vui lòng chuyển khoản theo thông tin bên dưới.</p>
  @endif

  @include('emails.registration._details')

  <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="margin:0 0 24px;background:#fff8e6;border-left:4px solid #f59e0b;">
    <tr>
      <td style="padding:16px 18px;">
        <p style="margin:0 0 8px;"><strong>{{ $registration->is_international ? 'Account name' : 'Tên tài khoản' }}:</strong> {{ $bank['account_name'] }}</p>
        <p style="margin:0 0 8px;"><strong>{{ $registration->is_international ? 'Account number' : 'Số tài khoản' }}:</strong> {{ $bank['account_number'] }}</p>
        <p style="margin:0 0 8px;"><strong>{{ $registration->is_international ? 'Bank' : 'Ngân hàng' }}:</strong> {{ $bank['bank_name'] }}</p>
        @if ($bank['swift'])
          <p style="margin:0 0 8px;"><strong>SWIFT:</strong> {{ $bank['swift'] }}</p>
        @endif
        <p style="margin:0 0 8px;"><strong>{{ $registration->is_international ? 'Transfer content' : 'Nội dung chuyển khoản' }}:</strong> {{ $transferContent }}</p>
        <p style="margin:0;">{{ $registration->is_international ? 'Please send payment proof to sirhcm2024@gmail.com or Zalo +84 772 649 011.' : 'Vui lòng gửi biên lai/chứng từ chuyển khoản qua email sirhcm2024@gmail.com hoặc Zalo 0772 649 011.' }}</p>
      </td>
    </tr>
  </table>

  <p style="margin:24px 0 0;">
    {{ $registration->is_international ? 'Best regards' : 'Trân trọng' }},<br>
    <strong>SIRHCM 2026 Secretariat</strong>
  </p>
@endsection
