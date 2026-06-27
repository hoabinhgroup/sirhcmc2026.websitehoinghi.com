@extends('layout.index')
@section('title', $isInternational ? 'Abstract Submission' : 'Nộp Abstract')

@push('styles')
  <link rel="stylesheet" href="{{ Storage::url('css/registration-form.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('css/trap-button.css') }}" type="text/css">
@endpush

@if ($recaptchaSiteKey)
  @push('header')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  @endpush
@endif

@section('content')
  @include('pages.registration.partials.breadcrumb', [
    'breadcrumbCurrent' => $isInternational ? 'Abstract Submission' : 'Nộp Abstract',
  ])

  <section class="registration-form about-section spad">
    <div class="container">
      <div class="section-title">
        <h2>{{ $isInternational ? 'Abstract Submission' : 'Nộp bài báo cáo tóm tắt / Abstract Submission' }}</h2>
        <p class="f-para">
          {{ $isInternational
              ? 'Deadline: 01/09/2026 23:59 (GMT+7). Abstract should be 500–1000 words.'
              : 'Hạn nộp: 01/09/2026 23:59 (GMT+7). Bài tóm tắt từ 500–1000 từ.' }}
        </p>
      </div>

      @if ($errors->any())
        <div class="alert alert-danger mb-4">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('registration.abstract-submission.submit') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="scope" value="{{ $scope }}">

        <div class="form-section">
          <h3>{{ $isInternational ? 'Abstract category' : 'Chủ đề / Abstract category' }} <sup>*</sup></h3>
          <div class="form-group">
            <select name="abstract_category" class="form-control" required>
              <option value="">{{ $isInternational ? 'Select category' : 'Chọn chủ đề' }}</option>
              @foreach ($categories as $slug => $label)
                <option value="{{ $slug }}" @selected(old('abstract_category') == $slug)>{{ $label }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-section">
          <h3>{{ $isInternational ? 'Presenter information' : 'Thông tin báo cáo viên' }}</h3>

          <div class="form-group">
            <label>{{ $isInternational ? 'Title' : 'Danh xưng / Title' }} <sup>*</sup></label>
            <div class="radio-group">
              @foreach ($titles as $value => $label)
                @if ($value !== 'other')
                  <label class="radio-inline">
                    <input type="radio" name="title" value="{{ $value }}" @checked(old('title') == $value) required>
                    <span>{{ $label }}</span>
                  </label>
                @endif
              @endforeach
              <label class="radio-inline">
                <input type="radio" name="title" value="other" id="title_other_radio" @checked(old('title') == 'other')>
                <span>{{ $isInternational ? 'Other' : 'Khác' }}</span>
              </label>
            </div>
            <input type="text" name="titleOther" id="titleOther" class="form-control mt-2"
                   value="{{ old('titleOther') }}" style="{{ old('title') == 'other' ? '' : 'display:none' }}"
                   placeholder="{{ $isInternational ? 'Enter title' : 'Nhập danh xưng' }}">
          </div>

          <div class="form-group">
            <label for="fullname">{{ $isInternational ? 'Full name' : 'Họ và tên' }} <sup>*</sup></label>
            <input type="text" id="fullname" name="fullname" class="form-control" value="{{ old('fullname') }}" required>
          </div>

          <div class="form-group">
            <label for="affiliation">{{ $isInternational ? 'Affiliation' : 'Đơn vị công tác' }} <sup>*</sup></label>
            <input type="text" id="affiliation" name="affiliation" class="form-control" value="{{ old('affiliation') }}" required>
          </div>

          <div class="form-group">
            <label for="position">{{ $isInternational ? 'Position' : 'Chức vụ' }}</label>
            <input type="text" id="position" name="position" class="form-control" value="{{ old('position') }}">
          </div>

          @if ($isInternational)
            <div class="form-group">
              <label for="country">Country/Region <sup>*</sup></label>
              <input type="text" id="country" name="country" class="form-control" value="{{ old('country') }}" required>
            </div>
          @else
            <div class="form-group">
              <label for="citizen_id">Số Căn cước công dân <sup>*</sup></label>
              <input type="text" id="citizen_id" name="citizen_id" class="form-control"
                     value="{{ old('citizen_id') }}" pattern="\d{12}" maxlength="12" required>
            </div>
          @endif

          <div class="form-group">
            <label>{{ $isInternational ? 'Date of birth' : 'Ngày tháng năm sinh' }} <sup>*</sup></label>
            <div class="date-group">
              <select name="day" class="form-control" required>
                <option value="">{{ $isInternational ? 'Day' : 'Ngày' }}</option>
                @for ($d = 1; $d <= 31; $d++)
                  <option value="{{ $d }}" @selected((int) old('day') === $d)>{{ $d }}</option>
                @endfor
              </select>
              <select name="month" class="form-control" required>
                <option value="">{{ $isInternational ? 'Month' : 'Tháng' }}</option>
                @for ($m = 1; $m <= 12; $m++)
                  <option value="{{ $m }}" @selected((int) old('month') === $m)>{{ $m }}</option>
                @endfor
              </select>
              <select name="year" class="form-control" required>
                <option value="">{{ $isInternational ? 'Year' : 'Năm' }}</option>
                @for ($y = date('Y'); $y >= 1940; $y--)
                  <option value="{{ $y }}" @selected((int) old('year') === $y)>{{ $y }}</option>
                @endfor
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="phone">{{ $isInternational ? 'Mobile number' : 'Số điện thoại' }} <sup>*</sup></label>
            <input type="tel" id="phone" name="phone" class="form-control" value="{{ old('phone') }}" required>
          </div>

          <div class="form-group">
            <label for="email">Email <sup>*</sup></label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
          </div>
        </div>

        <div class="form-section">
          <h3>{{ $isInternational ? 'Upload files' : 'Tải file' }}</h3>

          <div class="row upload-files-grid">
            <div class="col-md-6">
              <div class="form-group">
                <label for="abstract_file">{{ $isInternational ? 'Abstract file' : 'Bài báo cáo tóm tắt' }} <sup>*</sup></label>
                <label for="abstract_file" class="button-vietnam">{{ $isInternational ? 'Upload file' : 'Tải file / Upload' }}</label>
                <input type="file" id="abstract_file" name="abstract_file" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" required>
                <span id="abstract_file_name" class="file-name"></span>
                @error('abstract_file')<span class="text-danger d-block">{{ $message }}</span>@enderror
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="cv_file">CV <sup>*</sup></label>
                <label for="cv_file" class="button-vietnam">{{ $isInternational ? 'Upload file' : 'Tải file / Upload' }}</label>
                <input type="file" id="cv_file" name="cv_file" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" required>
                <span id="cv_file_name" class="file-name"></span>
                @error('cv_file')<span class="text-danger d-block">{{ $message }}</span>@enderror
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="headshot_file">{{ $isInternational ? 'Headshot' : 'Ảnh chân dung' }} <sup>*</sup></label>
                <label for="headshot_file" class="button-vietnam">{{ $isInternational ? 'Upload image' : 'Tải ảnh / Upload' }}</label>
                <input type="file" id="headshot_file" name="headshot_file" accept=".jpg,.jpeg,.png" required>
                <span id="headshot_file_name" class="file-name"></span>
                @error('headshot_file')<span class="text-danger d-block">{{ $message }}</span>@enderror
              </div>
            </div>

            @unless ($isInternational)
              <div class="col-md-6">
                <div class="form-group">
                  <label for="degree_file">Bằng cấp phục vụ CME <sup>*</sup></label>
                  <label for="degree_file" class="button-vietnam">Tải file / Upload</label>
                  <input type="file" id="degree_file" name="degree_file" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" required>
                  <span id="degree_file_name" class="file-name"></span>
                  @error('degree_file')<span class="text-danger d-block">{{ $message }}</span>@enderror
                </div>
              </div>
            @endunless
          </div>
        </div>

        <div class="form-section">
          <h3>{{ $isInternational ? 'Special dietary requirement' : 'Ăn kiêng' }}</h3>
          <div class="radio-group">
            @foreach ($dietaryOptions as $value => $label)
              @if ($value !== 'other')
                <label class="radio-inline">
                  <input type="radio" name="dietary" value="{{ $value }}" @checked(old('dietary', array_key_first($dietaryOptions)) == $value)>
                  <span>{{ $label }}</span>
                </label>
              @endif
            @endforeach
            <label class="radio-inline">
              <input type="radio" name="dietary" value="other" @checked(old('dietary') == 'other')>
              <span>{{ $isInternational ? 'Other' : 'Khác' }}</span>
            </label>
          </div>
          <input type="text" name="dietaryOther" class="form-control mt-2" value="{{ old('dietaryOther') }}"
                 placeholder="{{ $isInternational ? 'Other dietary requirement' : 'Yêu cầu ăn kiêng khác' }}">
        </div>

        @if ($recaptchaSiteKey)
          <div class="form-group">
            <div class="g-recaptcha" data-sitekey="{{ $recaptchaSiteKey }}"></div>
          </div>
        @endif

        <div class="form-submit-wrap">
          <button type="submit" class="submit-button primary-btn">
            {{ $isInternational ? 'Submit abstract' : 'Gửi abstract / Submit' }}
          </button>
        </div>
      </form>
    </div>
  </section>
@endsection

@push('scripts')
  <script>
    document.getElementById('title_other_radio')?.addEventListener('change', function () {
      const input = document.getElementById('titleOther');
      if (input) input.style.display = this.checked ? 'block' : 'none';
    });
    document.querySelectorAll('input[name="title"]:not(#title_other_radio)').forEach(function (el) {
      el.addEventListener('change', function () {
        const input = document.getElementById('titleOther');
        if (input) input.style.display = 'none';
      });
    });

    function bindFileLabel(inputId, nameId) {
      const input = document.getElementById(inputId);
      const nameEl = document.getElementById(nameId);
      if (!input || !nameEl) return;
      input.addEventListener('change', function () {
        nameEl.textContent = input.files.length ? input.files[0].name : '';
      });
    }

    bindFileLabel('abstract_file', 'abstract_file_name');
    bindFileLabel('cv_file', 'cv_file_name');
    bindFileLabel('headshot_file', 'headshot_file_name');
    bindFileLabel('degree_file', 'degree_file_name');
  </script>
@endpush
