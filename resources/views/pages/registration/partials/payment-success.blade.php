@extends('layout.index')
@section('title', 'Registration Successful')

@push('styles')
  <link rel="stylesheet" href="{{ Storage::url('css/registration-bank-transfer.css') }}" type="text/css">
@endpush

@section('content')
  @include('pages.registration.partials.breadcrumb', ['breadcrumbCurrent' => 'Registration Successful'])

  <section class="registration-bank about-section spad">
    <div class="container">
      <div class="bank-transfer-page-header">
        <h1>Đăng ký thành công</h1>
        <p>Registration Successful</p>
        <p>Cảm ơn Quý Đại biểu đã đăng ký tham dự SIRHCM 2026.</p>
        @if ($registration)
          <p><strong>Mã đăng ký / Registration ID:</strong> {{ $registration->guest_code }}</p>
          <p><strong>Tổng tiền / Total:</strong> {{ $registration->total_formatted }}</p>
        @endif
      </div>

      <div class="bank-transfer-wrapper">
        <div class="bank-info-section">
          <table>
            <tr>
              <td>Tên tài khoản / Account name</td>
              <td>{{ $bank['account_name'] }}</td>
            </tr>
            <tr>
              <td>Số tài khoản / Account number</td>
              <td>{{ $bank['account_number'] ?: '—' }}</td>
            </tr>
            <tr>
              <td>Ngân hàng / Bank</td>
              <td>{{ $bank['bank_name'] }}</td>
            </tr>
            <tr>
              <td>Địa chỉ / Address</td>
              <td>{{ $bank['branch'] }}</td>
            </tr>
            @if (! empty($bank['bank_code']))
              <tr>
                <td>Bank code</td>
                <td>{{ $bank['bank_code'] }}</td>
              </tr>
            @endif
            @if (! empty($bank['swift']))
              <tr>
                <td>SWIFT</td>
                <td>{{ $bank['swift'] }}</td>
              </tr>
            @endif
            @if ($registration)
              <tr>
                <td>Nội dung CK / Transfer content</td>
                <td>{{ str_replace(['{guest_code}', '{fullname}'], [$registration->guest_code, $registration->fullname], $bank['content_template']) }}</td>
              </tr>
            @endif
          </table>
        </div>

        <div class="qr-image-section">
          @php $qrPath = $bank['qr_image'] ?? null; @endphp
          @if ($qrPath && Storage::disk('public')->exists($qrPath))
            <img src="{{ Storage::url($qrPath) }}" width="300" height="300" alt="QR Code chuyển khoản">
          @else
            <div class="qr-placeholder">
              <p>Ảnh QR chuyển khoản sẽ được cập nhật tại</p>
              <p><code>storage/app/public/{{ $qrPath }}</code></p>
            </div>
          @endif
        </div>
      </div>

      <div class="bank-transfer-actions">
        <p>Email xác nhận đã được gửi tới địa chỉ email đăng ký.</p>
        <a href="{{ route('home') }}" class="result-action-btn">Về trang chủ / Back to home</a>
      </div>
    </div>
  </section>
@endsection
