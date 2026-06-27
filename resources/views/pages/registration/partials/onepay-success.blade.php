@extends('layout.index')
@php
  $isInternational = $registration?->is_international ?? false;
@endphp
@section('title', $isInternational ? 'Payment Successful' : 'Thanh toán thành công')

@push('styles')
  <link rel="stylesheet" href="{{ Storage::url('css/registration-payment-result.css') }}" type="text/css">
@endpush

@section('content')
  @include('pages.registration.partials.breadcrumb', [
    'breadcrumbCurrent' => $isInternational ? 'Payment Successful' : 'Thanh toán thành công',
  ])

  <section class="registration-result about-section spad">
    @component('pages.registration.partials.payment-result-card', [
      'iconClass' => 'success',
      'titleClass' => 'success',
      'title' => $isInternational ? 'Your Payment Has Been Processed Successfully' : 'Thanh toán thành công',
      'contact' => null,
    ])
      @if ($isInternational)
        <p>Thank you. Your payment has been processed successfully.</p>
        <p>You will be receiving an email shortly to confirm the transaction.</p>
        <p>Please check your Spam to ensure you will receive your Receipt.</p>
        <p>If you require additional assistance, please contact us at <a href="mailto:sirhcm2024@gmail.com">sirhcm2024@gmail.com</a>.</p>
      @else
        <p>Việc thanh toán của Quý Đại biểu đã thành công.</p>
        <p>Quý Đại biểu sẽ nhận được email thông báo về việc giao dịch đã hoàn tất.</p>
        <p>Vui lòng kiểm tra phần thư rác để chắc chắn Quý Đại biểu sẽ nhận được biên lai giao dịch.</p>
        <p>Nếu Quý Đại biểu cần hỗ trợ thêm, vui lòng liên hệ với chúng tôi tại email: <a href="mailto:sirhcm2024@gmail.com">sirhcm2024@gmail.com</a>.</p>
      @endif
      @if ($registration)
        <p><strong>{{ $isInternational ? 'Registration ID' : 'Mã đăng ký' }}:</strong> {{ $registration->guest_code }}</p>
      @endif
      <p><a href="{{ route('home') }}" class="result-action-btn">{{ $isInternational ? 'Back to home' : 'Về trang chủ' }}</a></p>
    @endcomponent
  </section>
@endsection
