@extends('layout.index')
@php
  $isInternational = $registration?->is_international ?? false;
  $registrationRoute = $isInternational
      ? route('registration.international-registration')
      : route('registration.delegate-registration');
@endphp
@section('title', $isInternational ? 'Payment Cancelled' : 'Huỷ thanh toán')

@push('styles')
  <link rel="stylesheet" href="{{ Storage::url('css/registration-payment-result.css') }}" type="text/css">
@endpush

@section('content')
  @include('pages.registration.partials.breadcrumb', [
    'breadcrumbCurrent' => $isInternational ? 'Payment Cancelled' : 'Huỷ thanh toán',
  ])

  <section class="registration-result about-section spad">
    @component('pages.registration.partials.payment-result-card', [
      'iconClass' => 'cancel',
      'titleClass' => 'cancel',
      'title' => $isInternational ? 'Your Payment Has Been Cancelled' : 'Huỷ thanh toán',
      'contact' => null,
    ])
      @if ($isInternational)
        <p>Your payment has been cancelled.</p>
        <p>Your information was submitted to SIRHCM2026's Organizer.</p>
        <p>If you have any trouble during the registration process and paying the conference fee, please feel free to contact us at <a href="mailto:sirhcm2024@gmail.com">sirhcm2024@gmail.com</a>.</p>
      @else
        <p>Việc thanh toán của Quý Đại biểu đã bị huỷ.</p>
        <p>Thông tin của Quý Đại biểu đã được gửi cho Ban tổ chức SIRHCM2026.</p>
        <p>Nếu Quý Đại biểu gặp bất cứ vấn đề nào về việc đăng ký hoặc về việc thanh toán chi phí cho hội nghị, vui lòng liên hệ với chúng tôi tại email: <a href="mailto:sirhcm2024@gmail.com">sirhcm2024@gmail.com</a>.</p>
      @endif
      @if ($registration)
        <p><strong>{{ $isInternational ? 'Registration ID' : 'Mã đăng ký' }}:</strong> {{ $registration->guest_code }}</p>
      @endif
      <p><a href="{{ $registrationRoute }}" class="result-action-btn">{{ $isInternational ? 'Back to registration' : 'Quay lại đăng ký' }}</a></p>
    @endcomponent
  </section>
@endsection
