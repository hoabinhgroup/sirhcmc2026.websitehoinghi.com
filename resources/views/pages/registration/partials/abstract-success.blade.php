@extends('layout.index')
@section('title', $submission->isDomestic() ? 'Nộp abstract thành công' : 'Abstract Submitted')

@push('styles')
  <link rel="stylesheet" href="{{ Storage::url('css/registration-payment-result.css') }}" type="text/css">
@endpush

@section('content')
  @include('pages.registration.partials.breadcrumb', [
    'breadcrumbCurrent' => $submission->isDomestic() ? 'Nộp abstract thành công' : 'Abstract Submitted',
  ])

  <section class="registration-result about-section spad">
    @component('pages.registration.partials.payment-result-card', [
      'iconClass' => 'success',
      'titleClass' => 'success',
      'title' => $submission->isDomestic() ? 'Nộp abstract thành công' : 'Abstract Submitted Successfully',
      'contact' => null,
    ])
      @if ($submission->isDomestic())
        <p>Cảm ơn Quý Đại biểu đã đăng ký <strong>{{ config('registration.event.name_vi') }}</strong>.</p>
        <p>Quý Đại biểu sẽ nhận được email xác nhận. Vui lòng kiểm tra cả hộp thư spam.</p>
        <p>Nếu Quý Đại biểu cần hỗ trợ thêm, vui lòng liên hệ với chúng tôi qua email: <a href="mailto:sirhcm2024@gmail.com">sirhcm2024@gmail.com</a>.</p>
      @else
        <p>Thank you for registering for <strong>{{ config('registration.event.name_en') }}</strong>.</p>
        <p>You will receive a confirmation email shortly. Please check your spam folder if needed.</p>
        <p>If you require additional assistance, please contact us at <a href="mailto:sirhcm2024@gmail.com">sirhcm2024@gmail.com</a>.</p>
      @endif
      <p><strong>{{ $submission->isDomestic() ? 'Mã submission' : 'Submission ID' }}:</strong> {{ $submission->submission_code }}</p>
      <p><strong>{{ $submission->isDomestic() ? 'Chủ đề' : 'Category' }}:</strong> {{ $submission->category_label }}</p>
      <p><a href="{{ route('home') }}" class="result-action-btn">{{ $submission->isDomestic() ? 'Về trang chủ' : 'Back to home' }}</a></p>
    @endcomponent
  </section>
@endsection
