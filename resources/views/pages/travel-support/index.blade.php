@extends('layout.index')
@section('title', 'Travel Support')
@section('content')
  @include('pages.travel-support.partials.breadcrumb')
  <section class="about-section spad">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-title">
            <h2>Hỗ trợ hậu cần / Travel Support</h2>
            <p class="f-para">Chọn mục cần xem.</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 mb-4">
          <div class="about-text">
            <h3>Thị thực nhập cảnh</h3>
            <p><a href="{{ route('travel-support.vietnam-visa') }}" class="primary-btn">Vietnam Visa</a></p>
          </div>
        </div>
        <div class="col-md-6 mb-4">
          <div class="about-text">
            <h3>Di chuyển</h3>
            <p><a href="{{ route('travel-support.transportation') }}" class="primary-btn">Transportation</a></p>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
