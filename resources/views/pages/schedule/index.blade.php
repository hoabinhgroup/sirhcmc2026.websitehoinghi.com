@extends('layout.index')
@section('content')
  @include('pages.schedule.partials.breadcrumb')
  <section id="transportation" class="about-section spad">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-title">
            <h2>CHƯƠNG TRÌNH / Program</h2>
            <p class="f-para">Thông tin chương trình — cập nhật sau.</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  {{-- @include('pages.schedule.partials.schedule')
  @include('pages.schedule.partials.newslatter')
  @include('pages.schedule.partials.contact') --}}
@endsection