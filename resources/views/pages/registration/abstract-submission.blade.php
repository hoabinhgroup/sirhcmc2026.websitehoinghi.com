@extends('layout.index')
@section('title', 'Abstract submission')
@section('content')
  @include('pages.registration.partials.breadcrumb', ['breadcrumbCurrent' => 'Abstract submission'])
  <section id="abstract-submission" class="about-section spad">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-title">
            <h2>Đăng ký báo cáo Abstract / Abstract submission</h2>
            <x-content-updating text="Nội dung gửi abstract sẽ được cập nhật sau." />
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
