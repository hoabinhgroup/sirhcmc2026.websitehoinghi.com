@extends('layout.index')
@section('title', 'Travel Support — Transportation')
@section('content')
  @include('pages.travel-support.partials.breadcrumb', ['breadcrumbCurrent' => 'Transportation'])
  <section id="transportation" class="about-section spad">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-title">
            <h2>Di chuyển / Transportation</h2>
            <p class="f-para">Thông tin di chuyển — cập nhật sau.</p>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
