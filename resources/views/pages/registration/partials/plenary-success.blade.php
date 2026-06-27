@extends('layout.index')
@section('title', $registration->is_international ? 'Registration Successful' : 'Đăng ký thành công')

@push('styles')
  <link rel="stylesheet" href="{{ Storage::url('css/registration-payment-result.css') }}" type="text/css">
@endpush

@section('content')
  @include('pages.registration.partials.breadcrumb', [
    'breadcrumbCurrent' => $registration->is_international ? 'Registration Successful' : 'Đăng ký thành công',
  ])

  <section class="registration-result about-section spad">
    @component('pages.registration.partials.payment-result-card', [
      'iconClass' => 'success',
      'titleClass' => 'success',
      'title' => $registration->is_international ? 'Registration Successful' : 'Đăng ký thành công',
      'contact' => null,
    ])
      @if ($registration->is_international)
        <p>Thank you for registering for <strong>{{ config('registration.event.name_en') }}</strong>.</p>
        <p>You will be receiving an email shortly to confirm the registration.</p>
        <p>If you require additional assistance, please contact us at <a href="mailto:sirhcm2024@gmail.com">sirhcm2024@gmail.com</a>.</p>
      @else
        <p>Cảm ơn Quý Đại biểu đã đăng ký <strong>{{ config('registration.event.name_vi') }}</strong>.</p>
        <p>Quý Đại biểu sẽ nhận được email thông báo về việc xác nhận đăng ký.</p>
        <p>Nếu Quý Đại biểu cần hỗ trợ thêm, vui lòng liên hệ với chúng tôi qua email: <a href="mailto:sirhcm2024@gmail.com">sirhcm2024@gmail.com</a>.</p>
      @endif
      @if ($registration->guest_code)
        <p><strong>{{ $registration->is_international ? 'Registration ID' : 'Mã đăng ký' }}:</strong> {{ $registration->guest_code }}</p>
      @endif
      <p><a href="{{ route('home') }}" class="result-action-btn">{{ $registration->is_international ? 'Back to home' : 'Về trang chủ' }}</a></p>
    @endcomponent
  </section>
@endsection
