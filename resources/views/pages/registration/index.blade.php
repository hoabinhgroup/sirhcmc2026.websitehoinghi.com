@extends('layout.index')
@section('title', 'Registration')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/trap-button.css') }}" type="text/css">
@endpush

@section('content')
  @include('pages.registration.partials.breadcrumb')
  <section class="about-section spad registration-hub"
           x-data="registrationHub({
             registration: {
               domestic: @js(route('registration.delegate-registration')),
               international: @js(route('registration.international-registration')),
             },
             abstract: {
               domestic: @js(route('registration.abstract-submission')),
               international: @js(route('registration.abstract-submission.international')),
             },
           })">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <nav class="registration-steps" aria-label="Registration steps">
            <div class="registration-step" :class="{ 'is-active': step === 1, 'is-done': step > 1 }">
              <span class="registration-step__num">1</span>
              <span class="registration-step__label">Loại hình thức / Type</span>
            </div>
            <div class="registration-step__line" :class="{ 'is-done': step > 1 }"></div>
            <div class="registration-step" :class="{ 'is-active': step === 2, 'is-done': step > 2 }">
              <span class="registration-step__num">2</span>
              <span class="registration-step__label">Phạm vi / Scope</span>
            </div>
          </nav>
        </div>
      </div>

      {{-- Bước 1 --}}
      <div class="row" x-show="step === 1" x-cloak>
        <div class="col-lg-12 registration-hub-block">
          <h3 class="registration-hub-step-title">Bước 1 — Bạn muốn làm gì? / What would you like to do?</h3>
          <p class="f-para">Chọn một thẻ bên dưới. / Select one of the cards below.</p>

          <div class="row registration-choice-cards">
            <div class="col-md-6">
              <button type="button"
                      class="registration-choice-card registration-choice-card--registration"
                      @click="selectType('registration')">
                <h4 class="registration-choice-card__title">Đăng ký tham dự hội nghị</h4>
                <p class="registration-choice-card__sub">Conference Registration</p>
                <p class="registration-choice-card__desc">
                  Đăng ký làm đại biểu, chọn gói phí, thanh toán (nếu có) và nhận email xác nhận.
                </p>
                <span class="registration-choice-card__action">Chọn thẻ này →</span>
              </button>
            </div>
            <div class="col-md-6">
              <button type="button"
                      class="registration-choice-card registration-choice-card--abstract"
                      @click="selectType('abstract')">
                <h4 class="registration-choice-card__title">Nộp abstract</h4>
                <p class="registration-choice-card__sub">Abstract Submission</p>
                <p class="registration-choice-card__desc">
                  Gửi bài báo cáo tóm tắt, CV và tài liệu đính kèm. Hạn: 01/09/2026 23:59 (GMT+7).
                </p>
                <span class="registration-choice-card__action">Chọn thẻ này →</span>
              </button>
            </div>
          </div>
        </div>
      </div>

      {{-- Bước 2 --}}
      <div class="row" x-show="step === 2" x-cloak>
        <div class="col-lg-12 registration-hub-block">
          <button type="button" class="registration-hub-back" @click="goBack()">
            ← Quay lại bước 1 / Back to step 1
          </button>

          <h3 class="registration-hub-step-title" x-text="step2Heading"></h3>
          <p class="f-para" x-text="step2Description"></p>

          <div class="registration-hub-summary" x-show="selectedLabel">
            <strong>Đã chọn / Selected:</strong> <span x-text="selectedLabel"></span>
          </div>

          <div class="row registration-choice-cards">
            <div class="col-md-6">
              <a :href="urls.domestic"
                 class="registration-choice-card registration-choice-card--domestic">
                <h4 class="registration-choice-card__title" x-text="domesticTitle"></h4>
                <p class="registration-choice-card__sub" x-text="domesticSub"></p>
                <p class="registration-choice-card__desc" x-text="domesticDesc"></p>
                <span class="registration-choice-card__action">Mở form →</span>
              </a>
            </div>
            <div class="col-md-6">
              <a :href="urls.international"
                 class="registration-choice-card registration-choice-card--international">
                <h4 class="registration-choice-card__title" x-text="internationalTitle"></h4>
                <p class="registration-choice-card__sub" x-text="internationalSub"></p>
                <p class="registration-choice-card__desc" x-text="internationalDesc"></p>
                <span class="registration-choice-card__action">Open form →</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('scripts')
  <script>
    document.addEventListener('alpine:init', () => {
      Alpine.data('registrationHub', (routes) => ({
        step: 1,
        type: null,
        routes,

        selectType(type) {
          this.type = type;
          this.step = 2;
        },

        goBack() {
          this.step = 1;
        },

        get urls() {
          return this.routes[this.type] || { domestic: '#', international: '#' };
        },

        get step2Heading() {
          return this.type === 'abstract'
            ? 'Bước 2 — Phạm vi nộp abstract / Abstract scope'
            : 'Bước 2 — Loại đại biểu / Delegate type';
        },

        get step2Description() {
          return this.type === 'abstract'
            ? 'Chọn thẻ phù hợp để mở form tiếng Việt hoặc tiếng Anh.'
            : 'Chọn thẻ phù hợp để mở form đăng ký. Mọi khoản phí tính bằng VND.';
        },

        get domesticTitle() {
          return this.type === 'abstract' ? 'Báo cáo viên trong nước' : 'Đại biểu trong nước';
        },

        get domesticSub() {
          return this.type === 'abstract' ? 'Domestic presenter · Tiếng Việt' : 'Domestic delegate · Tiếng Việt';
        },

        get domesticDesc() {
          return this.type === 'abstract'
            ? 'Form nộp abstract bằng tiếng Việt, dành cho báo cáo viên tại Việt Nam.'
            : 'Form đăng ký tiếng Việt cho đại biểu Việt Nam.';
        },

        get internationalTitle() {
          return this.type === 'abstract' ? 'International presenters' : 'International delegates';
        },

        get internationalSub() {
          return this.type === 'abstract' ? 'English form' : 'English form';
        },

        get internationalDesc() {
          return this.type === 'abstract'
            ? 'Abstract submission form in English for international presenters.'
            : 'Registration form in English for international participants.';
        },

        get selectedLabel() {
          if (this.type === 'registration') {
            return 'Đăng ký tham dự hội nghị / Conference Registration';
          }
          if (this.type === 'abstract') {
            return 'Nộp abstract / Abstract Submission';
          }
          return '';
        },
      }));
    });
  </script>
@endpush
