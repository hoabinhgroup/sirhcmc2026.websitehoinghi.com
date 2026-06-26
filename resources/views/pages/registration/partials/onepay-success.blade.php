@extends('layout.index')
@section('title', 'Payment Successful')

@push('styles')
  <link rel="stylesheet" href="{{ Storage::url('css/registration-payment-result.css') }}" type="text/css">
@endpush

@section('content')
  @include('pages.registration.partials.breadcrumb', ['breadcrumbCurrent' => 'Payment Successful'])

  <section class="registration-result about-section spad">
    @component('pages.registration.partials.payment-result-card', [
      'iconClass' => 'success',
      'titleClass' => 'success',
      'title' => 'Thanh toán thành công / Payment Successful',
      'contact' => '<p>Liên hệ Ban Tổ chức: <a href="mailto:sirhcm2024@gmail.com">sirhcm2024@gmail.com</a></p>',
    ])
      <p>Cảm ơn Quý Đại biểu. Giao dịch thanh toán đã được xử lý thành công.</p>
      @if ($registration)
        <p><strong>Mã đăng ký:</strong> {{ $registration->guest_code }}</p>
        <p><strong>Họ tên:</strong> {{ $registration->fullname }}</p>
      @endif
      <p><a href="{{ route('home') }}" class="result-action-btn">Về trang chủ</a></p>
    @endcomponent
  </section>
@endsection
