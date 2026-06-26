@extends('layout.index')
@section('title', 'Registration Successful')

@push('styles')
  <link rel="stylesheet" href="{{ Storage::url('css/registration-payment-result.css') }}" type="text/css">
@endpush

@section('content')
  @include('pages.registration.partials.breadcrumb', ['breadcrumbCurrent' => 'Registration Successful'])

  <section class="registration-result about-section spad">
    @component('pages.registration.partials.payment-result-card', [
      'iconClass' => 'success',
      'titleClass' => 'success',
      'title' => 'Đăng ký thành công / Registration Successful',
      'contact' => '<p>Liên hệ Ban Tổ chức: <a href="mailto:sirhcm2024@gmail.com">sirhcm2024@gmail.com</a></p>',
    ])
      <p>Cảm ơn Quý Đại biểu đã đăng ký tham dự SIRHCM 2026.</p>
      @if ($registration)
        <p><strong>Mã đăng ký:</strong> {{ $registration->guest_code }}</p>
        <p><strong>Họ tên:</strong> {{ $registration->fullname }}</p>
      @endif
      <p>Email xác nhận đã được gửi tới địa chỉ email đăng ký.</p>
      <p><a href="{{ route('home') }}" class="result-action-btn">Về trang chủ</a></p>
    @endcomponent
  </section>
@endsection
