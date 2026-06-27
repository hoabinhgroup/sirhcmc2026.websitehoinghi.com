@extends('layout.index')
@section('title', 'Abstract Submission Closed')

@section('content')
  @include('pages.registration.partials.breadcrumb', ['breadcrumbCurrent' => 'Abstract Submission Closed'])

  <section class="about-section spad">
    <div class="container">
      <div class="section-title">
        <h2>Hạn nộp abstract đã kết thúc / Abstract submission closed</h2>
        <p class="f-para">
          Hạn nộp abstract là 01/09/2026 23:59 (GMT+7).<br>
          The abstract submission deadline was 01/09/2026 23:59 (GMT+7).
        </p>
        <p class="f-para">
          Liên hệ Ban Tổ chức: <a href="mailto:sirhcm2024@gmail.com">sirhcm2024@gmail.com</a>
        </p>
      </div>
    </div>
  </section>
@endsection
