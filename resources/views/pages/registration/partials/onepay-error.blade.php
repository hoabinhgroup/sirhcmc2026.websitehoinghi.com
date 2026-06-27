@extends('layout.index')
@php
  $isInternational = $registration?->is_international ?? false;
  $registrationRoute = $isInternational
      ? route('registration.international-registration')
      : route('registration.delegate-registration');
@endphp
@section('title', $isInternational ? 'Payment Failed' : 'Thanh toán không thành công')

@push('styles')
  <link rel="stylesheet" href="{{ Storage::url('css/registration-payment-result.css') }}" type="text/css">
@endpush

@section('content')
  @include('pages.registration.partials.breadcrumb', [
    'breadcrumbCurrent' => $isInternational ? 'Payment Failed' : 'Thanh toán không thành công',
  ])

  <section class="registration-result about-section spad">
    @component('pages.registration.partials.payment-result-card', [
      'iconClass' => 'error',
      'titleClass' => 'error',
      'title' => $isInternational ? 'Unfortunately, Your Payment Has Failed' : 'Thanh toán không thành công',
      'contact' => null,
    ])
      @if ($isInternational)
        <p>Unfortunately, your payment has failed.</p>
        <p>Your information was submitted to SIRHCM2026's Organizer.</p>
        <p>If you have any trouble during the registration process and paying the conference fee, please feel free to contact us at <a href="mailto:sirhcm2024@gmail.com">sirhcm2024@gmail.com</a>.</p>
      @else
        <p>Thật không may, thanh toán của Quý Đại biểu đã thất bại.</p>
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
