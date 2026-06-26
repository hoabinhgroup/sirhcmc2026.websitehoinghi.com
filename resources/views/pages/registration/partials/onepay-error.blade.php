@extends('layout.index')
@section('title', 'Payment Error')

@push('styles')
  <link rel="stylesheet" href="{{ Storage::url('css/registration-payment-result.css') }}" type="text/css">
@endpush

@section('content')
  @include('pages.registration.partials.breadcrumb', ['breadcrumbCurrent' => 'Payment Error'])

  <section class="registration-result about-section spad">
    @component('pages.registration.partials.payment-result-card', [
      'iconClass' => 'error',
      'titleClass' => 'error',
      'title' => 'Thanh toán không thành công / Payment Failed',
      'contact' => '<p>Liên hệ Ban Tổ chức: <a href="mailto:sirhcm2024@gmail.com">sirhcm2024@gmail.com</a></p>',
    ])
      <p>Đã xảy ra lỗi trong quá trình thanh toán. Vui lòng thử lại hoặc liên hệ Ban Tổ chức.</p>
      @if ($registration)
        <p><strong>Mã đăng ký:</strong> {{ $registration->guest_code }}</p>
      @endif
      <p><a href="{{ route('registration.delegate-registration') }}" class="result-action-btn">Quay lại đăng ký</a></p>
    @endcomponent
  </section>
@endsection
