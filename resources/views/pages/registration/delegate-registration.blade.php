@extends('layout.index')
@section('title', 'Delegate Registration')
@section('content')
  @include('pages.registration.partials.breadcrumb', ['breadcrumbCurrent' => 'Delegate Registration'])
  <section id="delegate-registration" class="about-section spad">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-title">
            <h2>Đăng ký tham dự / Delegate Registration</h2>
            <x-content-updating text="Nội dung đăng ký tham dự sẽ được cập nhật sau." />
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
