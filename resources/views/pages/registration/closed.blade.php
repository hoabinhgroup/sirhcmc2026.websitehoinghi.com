@extends('layout.index')
@section('title', 'Registration Closed')

@push('styles')
  <link rel="stylesheet" href="{{ Storage::url('css/registration-form.css') }}" type="text/css">
@endpush

@section('content')
  @include('pages.registration.partials.breadcrumb', ['breadcrumbCurrent' => 'Registration Closed'])

  <section class="registration-form about-section spad">
    <div class="registration-info-container" style="max-width:1200px;margin:0 auto;min-height:76vh;">
      <div class="notice-message">
        <h2>Đăng ký đã đóng / Registration Closed</h2>
        <p>Thời hạn đăng ký tham dự SIRHCM 2026 đã kết thúc.</p>
        <p>Vui lòng liên hệ Ban Tổ chức qua <a href="mailto:sirhcm2024@gmail.com">sirhcm2024@gmail.com</a> nếu cần hỗ trợ.</p>
        <p><a href="{{ route('home') }}" class="submit-button primary-btn">Về trang chủ</a></p>
      </div>
    </div>
  </section>
@endsection
