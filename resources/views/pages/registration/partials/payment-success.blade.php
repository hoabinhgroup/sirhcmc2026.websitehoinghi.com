@extends('layout.index')
@php
  $isInternational = $registration->is_international;
  $transferContent = $registration
      ? str_replace(
          ['{guest_code}', '{fullname}'],
          [$registration->guest_code, $registration->fullname],
          $bank['content_template'] ?? '',
      )
      : '';
@endphp
@section('title', $isInternational ? 'Registration Successful' : 'Đăng ký thành công')

@push('styles')
  <link rel="stylesheet" href="{{ Storage::url('css/registration-bank-transfer.css') }}" type="text/css">
@endpush

@section('content')
  @include('pages.registration.partials.breadcrumb', [
    'breadcrumbCurrent' => $isInternational ? 'Registration Successful' : 'Đăng ký thành công',
  ])

  <section class="registration-bank about-section spad">
    <div class="container">
      <div class="bank-transfer-page-header">
        @if ($isInternational)
          <h1>Registration Successful</h1>
          <p>Thank you for registering for <strong>{{ config('registration.event.name_en') }}</strong>.</p>
          @if ($registration)
            <p>Your registration ID is <strong>{{ $registration->guest_code }}</strong>. Please keep the registration number for your records.</p>
            <p>The registration number is required for all communications with SIRHCM2026 regarding this registration.</p>
            <p><strong>Total amount:</strong> {{ $registration->total_formatted }}</p>
          @endif
          <p>Please transfer the conference fee via <strong>Wire Transfer</strong> (bank charges must be paid at your expense).</p>
        @else
          <h1>Đăng ký thành công</h1>
          <p>Cảm ơn Quý Đại biểu đã đăng ký <strong>{{ config('registration.event.name_vi') }}</strong>.</p>
          @if ($registration)
            <p>Mã đăng ký của Quý Đại biểu là <strong>{{ $registration->guest_code }}</strong>. Vui lòng giữ lại mã đăng ký để hoàn tất hồ sơ.</p>
            <p>Mọi thông tin liên lạc với SIRHCM2026 về đăng ký này phải kèm theo số đăng ký.</p>
            <p><strong>Tổng tiền:</strong> {{ $registration->total_formatted }}</p>
          @endif
          <p>Vui lòng thanh toán chi phí hội nghị qua <strong>Chuyển khoản ngân hàng</strong> (mọi chi phí ngân hàng sẽ do người chuyển chi trả).</p>
        @endif
      </div>

      <div class="bank-transfer-wrapper">
        <div class="bank-info-section">
          <table>
            <tr>
              <td>{{ $isInternational ? 'Account name' : 'Tên tài khoản' }}</td>
              <td>{{ $bank['account_name'] }}</td>
            </tr>
            @if (! empty($bank['account_short_name']))
              <tr>
                <td>{{ $isInternational ? 'Short name' : 'Tên viết tắt' }}</td>
                <td>{{ $bank['account_short_name'] }}</td>
              </tr>
            @endif
            <tr>
              <td>{{ $isInternational ? 'Account number' : 'Số tài khoản' }}</td>
              <td>{{ $bank['account_number'] ?: '—' }}</td>
            </tr>
            <tr>
              <td>{{ $isInternational ? 'Bank' : 'Ngân hàng' }}</td>
              <td>{{ $bank['bank_name'] }}</td>
            </tr>
            @if (! empty($bank['bank_address']))
              <tr>
                <td>{{ $isInternational ? 'Bank address' : 'Địa chỉ ngân hàng' }}</td>
                <td>{{ $bank['bank_address'] }}</td>
              </tr>
            @endif
            @if (! empty($bank['swift']))
              <tr>
                <td>SWIFT code</td>
                <td>{{ $bank['swift'] }}</td>
              </tr>
            @endif
            @if (! empty($bank['bank_code']))
              <tr>
                <td>{{ $isInternational ? 'Bank code' : 'Mã ngân hàng' }}</td>
                <td>{{ $bank['bank_code'] }}</td>
              </tr>
            @endif
            @if ($registration && $transferContent)
              <tr>
                <td>{{ $isInternational ? 'Transfer content' : 'Nội dung chuyển khoản' }}</td>
                <td>{{ $transferContent }}</td>
              </tr>
            @endif
          </table>
        </div>

        <div class="qr-image-section">
          @php $qrPath = $bank['qr_image'] ?? null; @endphp
          @if ($qrPath && Storage::disk('public')->exists($qrPath))
            <img src="{{ Storage::url($qrPath) }}" width="300" height="300" alt="{{ $isInternational ? 'Bank transfer QR code' : 'QR Code chuyển khoản' }}">
          @else
            <div class="qr-placeholder">
              <p>{{ $isInternational ? 'QR code image will be updated at' : 'Ảnh QR chuyển khoản sẽ được cập nhật tại' }}</p>
              <p><code>storage/app/public/{{ $qrPath }}</code></p>
            </div>
          @endif
        </div>
      </div>

      <div class="bank-transfer-actions">
        @if ($isInternational)
          <p>Please send your payment proof to <a href="mailto:sirhcm2024@gmail.com">sirhcm2024@gmail.com</a> or Zalo <a href="tel:+84772649011">+84 772 649 011</a>.</p>
          <p>A confirmation email has been sent to your registered email address.</p>
        @else
          <p>Vui lòng gửi bằng chứng chuyển khoản qua email: <a href="mailto:sirhcm2024@gmail.com">sirhcm2024@gmail.com</a> hoặc Zalo: <a href="tel:+84772649011">+84 772 649 011</a>.</p>
          <p>Email xác nhận đã được gửi tới địa chỉ email đăng ký.</p>
        @endif
        <a href="{{ route('home') }}" class="result-action-btn">{{ $isInternational ? 'Back to home' : 'Về trang chủ' }}</a>
      </div>
    </div>
  </section>
@endsection
