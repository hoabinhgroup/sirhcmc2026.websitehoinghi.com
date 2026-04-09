@extends('layout.index')
@section('title', 'Registration')
@section('content')
  @include('pages.registration.partials.breadcrumb')
  <section class="about-section spad">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-title">
            <h2>Đăng ký / Registration</h2>
            <p class="f-para">Chọn mục cần xem.</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 mb-4">
          <div class="about-text">
            <h3>Đăng ký tham dự</h3>
            <p><a href="{{ route('registration.delegate-registration') }}" class="primary-btn">Delegate Registration</a></p>
          </div>
        </div>
        <div class="col-md-6 mb-4">
          <div class="about-text">
            <h3>Đăng ký báo cáo Abstract</h3>
            <p><a href="{{ route('registration.abstract-submission') }}" class="primary-btn">Abstract submission</a></p>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
