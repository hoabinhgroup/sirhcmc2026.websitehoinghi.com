@extends('layout.index')
@section('title', $isInternational ? 'International Registration' : 'Delegate Registration')

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
    'breadcrumbCurrent' => $isInternational ? 'International Registration' : 'Delegate Registration',
  ])

  <section class="registration-form about-section spad">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-title">
            <h2>{{ $isInternational ? 'International Registration' : 'Đăng ký tham dự / Delegate Registration' }}</h2>
            <p class="f-para">
              @if ($isInternational)
                Please complete the form below. All fees are in VND.
              @else
                Vui lòng điền đầy đủ thông tin bên dưới. Mọi khoản phí tính bằng VND.
              @endif
            </p>
            @if ($pricePeriod === 'early')
              <p class="f-para text-success">
                {{ $isInternational
                    ? 'Early bird rate applies for payments on or before '.$earlyDeadline.'.'
                    : 'Đang áp dụng mức phí ưu đãi (early bird) cho thanh toán trước hoặc đến hết '.$earlyDeadline.'.' }}
              </p>
            @else
              <p class="f-para">
                {{ $isInternational
                    ? 'Standard/on-site rate applies from 16/09/2026.'
                    : 'Đang áp dụng mức phí tiêu chuẩn/tại hội nghị từ 16/09/2026.' }}
              </p>
            @endif
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      @if ($errors->any())
        <div class="alert alert-danger mb-4">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('registration.submit') }}"
            id="payment-registration"
            method="POST"
            enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="scope" value="{{ $scope }}">
        <input type="hidden" name="total_amount" id="total_amount" value="{{ old('total_amount', 0) }}">
        @unless ($isInternational)
          <input type="hidden" name="country" value="VN">
        @endunless

        <div class="form-section">
          <h3>{{ $isInternational ? 'General Information' : 'Thông tin chung / General Information' }}</h3>

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
                <span>{{ $isInternational ? 'Other' : 'Khác / Other' }}</span>
              </label>
            </div>
            <div class="other-input-wrap" id="title-other-wrap" style="{{ old('title') == 'other' ? '' : 'display:none' }}">
              <input type="text" name="titleOther" id="titleOther" class="form-control"
                     value="{{ old('titleOther') }}" placeholder="{{ $isInternational ? 'Enter title' : 'Nhập danh xưng khác' }}"
                     @disabled(old('title') !== 'other')>
            </div>
          </div>

          <div class="form-group">
            <label for="fullname">{{ $isInternational ? 'Full name' : 'Họ tên / Full name' }} <sup>*</sup></label>
            <input type="text" id="fullname" name="fullname" class="form-control" value="{{ old('fullname') }}" required>
          </div>

          <div class="form-group">
            <label for="affiliation">{{ $isInternational ? 'Affiliation' : 'Đơn vị công tác / Affiliation' }} <sup>*</sup></label>
            <input type="text" id="affiliation" name="affiliation" class="form-control" value="{{ old('affiliation') }}" required>
          </div>

          <div class="form-group">
            <label for="position">{{ $isInternational ? 'Position' : 'Chức vụ / Position' }}</label>
            <input type="text" id="position" name="position" class="form-control" value="{{ old('position') }}">
          </div>

          @if ($isInternational)
            <div class="form-group">
              <label for="country">Country/Region <sup>*</sup></label>
              <input type="text" id="country" name="country" class="form-control" value="{{ old('country') }}" required>
            </div>
          @endif

          <div class="form-group">
            <label>{{ $isInternational ? 'Date of birth' : 'Ngày sinh / Date of birth' }} <sup>*</sup></label>
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
            <label for="phone">{{ $isInternational ? 'Mobile number' : 'Điện thoại / Phone' }} <sup>*</sup></label>
            <input type="tel" id="phone" name="phone" class="form-control" value="{{ old('phone') }}" required>
          </div>

          <div class="form-group">
            <label for="email">Email <sup>*</sup></label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
          </div>

          <div class="form-group">
            <label>{{ $isInternational ? 'Degree file (PDF, JPG, PNG, DOC, DOCX)' : 'Bằng cấp / Degree file' }} <sup>*</sup></label>
            <label for="degree_file" class="button-vietnam">{{ $isInternational ? 'Upload file' : 'Tải file / Upload' }}</label>
            <input type="file" id="degree_file" name="degree_file" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" required>
            <span id="degree_file_name" class="file-name"></span>
          </div>
        </div>

        <div class="form-section">
          <h3>{{ $isInternational ? 'Special dietary requirement' : 'Ăn kiêng / Dietary requirements' }}</h3>
          <div class="form-group">
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
                <input type="radio" name="dietary" value="other" id="dietary_other_radio" @checked(old('dietary') == 'other')>
                <span>{{ $isInternational ? 'Other' : 'Khác / Other' }}</span>
                <input type="text" name="dietaryOther" id="dietaryOther" class="other-input"
                       value="{{ old('dietaryOther') }}" @disabled(old('dietary') !== 'other')>
              </label>
            </div>
          </div>
        </div>

        <div class="form-section" id="fee_section">
          <h3>{{ $isInternational ? 'Conference type & fees' : 'Loại đại biểu / Conference fees' }}</h3>
          <table class="fee-table">
            <thead>
              <tr>
                <th>{{ $isInternational ? 'Select' : 'Chọn' }}</th>
                <th>{{ $isInternational ? 'Delegate category' : 'Loại đại biểu / Category' }}</th>
                <th>{{ $isInternational ? 'Fee (VND)' : 'Giá (VND)' }}</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($fees as $slug => $fee)
                <tr onclick="document.getElementById('fee_{{ $slug }}').click();">
                  <td>
                    <input type="radio" id="fee_{{ $slug }}" name="conference_checklist_item"
                           value="{{ $slug }}" class="fee-radio"
                           data-fee-amount="{{ $fee['amount'] }}"
                           data-fee-waiver="{{ $fee['fee_waiver'] ? '1' : '0' }}"
                           @checked(old('conference_checklist_item') == $slug) required>
                  </td>
                  <td>{{ $isInternational ? $fee['label_en'] : $fee['label_vi'] }}</td>
                  <td>{{ number_format($fee['amount'], 0, '.', ',') }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>

          <div class="form-group mt-3">
            <label class="radio-inline">
              <input type="checkbox" name="galadinner_fee" id="galadinner_fee" value="1" @checked(old('galadinner_fee'))>
              <span>Gala Dinner (17/10/2026) — {{ number_format($galadinnerFee, 0, '.', ',') }} VND</span>
            </label>
          </div>

          <p class="total-summary">
            {{ $isInternational ? 'Subtotal' : 'Tạm tính / Subtotal' }}: <span id="subtotal_display">0</span> VND
          </p>
          <p class="total-summary" id="transaction_fee_row" style="display:none">
            {{ $isInternational ? 'Online transaction fee (6%)' : 'Phí giao dịch online (6%)' }}: <span id="transaction_fee_display">0</span> VND
          </p>
          <p class="total-summary">
            <strong>{{ $isInternational ? 'Total' : 'Tổng cộng / Total' }}: <span id="total_display">0</span> VND</strong>
          </p>
        </div>

        <div class="form-section" id="payment_section">
          <h3>{{ $isInternational ? 'Payment method' : 'Phương thức thanh toán / Payment method' }}</h3>
          <div class="payment-method-group">
            <label class="radio-inline d-block mb-2">
              <input type="radio" name="payment_method" value="onepay" @checked(old('payment_method', 'onepay') == 'onepay')>
              <span>{{ $isInternational ? 'Online Payment (OnePay, +6% transaction fee)' : 'Thanh toán online OnePay (cộng thêm 6% phí giao dịch)' }}</span>
            </label>
            <label class="radio-inline d-block">
              <input type="radio" name="payment_method" value="bank-transfer" id="payment_bank_transfer" @checked(old('payment_method') == 'bank-transfer')>
              <span>{{ $isInternational ? 'Wire/Bank Transfer' : 'Chuyển khoản ngân hàng / Bank transfer' }}</span>
            </label>
          </div>

          <div id="bank-transfer-note" class="note-box">
            <p><strong>{{ $isInternational ? 'Bank transfer details:' : 'Thông tin chuyển khoản:' }}</strong></p>
            <p>{{ $isInternational ? 'Account name' : 'Tên tài khoản' }}: {{ $bank['account_name'] }}</p>
            <p>{{ $isInternational ? 'Account number' : 'Số tài khoản' }}: {{ $bank['account_number'] ?: '—' }}</p>
            <p>{{ $isInternational ? 'Bank' : 'Ngân hàng' }}: {{ $bank['bank_name'] }}</p>
            @if ($bank['swift'])
              <p>SWIFT: {{ $bank['swift'] }}</p>
            @endif
            @if (! empty($bank['bank_code']))
              <p>{{ $isInternational ? 'Bank code' : 'Mã ngân hàng' }}: {{ $bank['bank_code'] }}</p>
            @endif
            <p>{{ $isInternational ? 'Transfer content' : 'Nội dung chuyển khoản' }}: <em>{Full name} – {Registration ID} | SIRHCM2026</em></p>
          </div>
        </div>

        @if ($recaptchaSiteKey)
          <div class="form-group">
            <div class="g-recaptcha" data-sitekey="{{ $recaptchaSiteKey }}"></div>
          </div>
        @endif

        <div class="form-submit-wrap">
          <button type="submit" class="submit-button primary-btn">
            {{ $isInternational ? 'Submit registration' : 'Gửi đăng ký / Submit' }}
          </button>
        </div>
      </form>
    </div>
  </section>
@endsection

@push('scripts')
  <script>
    (function () {
      const galadinnerFee = {{ (int) $galadinnerFee }};
      const onlineFeePercent = {{ (int) config('registration.online_transaction_fee_percent', 6) }};
      const totalInput = document.getElementById('total_amount');
      const subtotalDisplay = document.getElementById('subtotal_display');
      const transactionFeeDisplay = document.getElementById('transaction_fee_display');
      const transactionFeeRow = document.getElementById('transaction_fee_row');
      const totalDisplay = document.getElementById('total_display');
      const paymentSection = document.getElementById('payment_section');
      const titleOther = document.getElementById('titleOther');
      const titleOtherRadio = document.getElementById('title_other_radio');
      const titleOtherWrap = document.getElementById('title-other-wrap');
      const dietaryOther = document.getElementById('dietaryOther');
      const dietaryOtherRadio = document.getElementById('dietary_other_radio');
      const bankNote = document.getElementById('bank-transfer-note');
      const bankTransferRadio = document.getElementById('payment_bank_transfer');

      function formatVnd(amount) {
        return amount.toLocaleString('vi-VN');
      }

      function calculateFees() {
        let subtotal = 0;
        const radio = document.querySelector('input[name="conference_checklist_item"]:checked');
        if (radio) {
          subtotal += parseInt(radio.getAttribute('data-fee-amount') || '0', 10);
        }
        if (document.getElementById('galadinner_fee').checked) {
          subtotal += galadinnerFee;
        }
        const paymentMethod = document.querySelector('input[name="payment_method"]:checked');
        const isOnepay = paymentMethod && paymentMethod.value === 'onepay';
        const transactionFee = isOnepay ? Math.round(subtotal * onlineFeePercent / 100) : 0;
        const total = subtotal + transactionFee;
        return { subtotal, transactionFee, total, isOnepay };
      }

      function updateTotals() {
        const { subtotal, transactionFee, total, isOnepay } = calculateFees();
        totalInput.value = total;
        subtotalDisplay.textContent = formatVnd(subtotal);
        transactionFeeDisplay.textContent = formatVnd(transactionFee);
        transactionFeeRow.style.display = isOnepay && subtotal > 0 ? 'block' : 'none';
        totalDisplay.textContent = formatVnd(total);

        if (paymentSection) {
          paymentSection.style.display = total > 0 ? 'block' : 'none';
          document.querySelectorAll('input[name="payment_method"]').forEach(function (el) {
            el.required = total > 0;
          });
        }
      }

      function toggleTitleOther() {
        const enabled = titleOtherRadio && titleOtherRadio.checked;
        if (titleOtherWrap) titleOtherWrap.style.display = enabled ? 'block' : 'none';
        if (titleOther) {
          titleOther.disabled = !enabled;
          if (!enabled) titleOther.value = '';
        }
      }

      function toggleOtherInput(radio, input) {
        if (!radio || !input) return;
        input.disabled = !radio.checked;
        if (!radio.checked) input.value = '';
      }

      function bindFileLabel(inputId, nameId) {
        const input = document.getElementById(inputId);
        const nameEl = document.getElementById(nameId);
        if (!input || !nameEl) return;
        input.addEventListener('change', function () {
          nameEl.textContent = input.files.length ? input.files[0].name : '';
        });
      }

      function toggleBankNote() {
        if (!bankNote) return;
        bankNote.style.display = bankTransferRadio && bankTransferRadio.checked ? 'block' : 'none';
      }

      document.querySelectorAll('.fee-radio, #galadinner_fee, input[name="payment_method"]').forEach(function (el) {
        el.addEventListener('change', function () {
          updateTotals();
          toggleBankNote();
        });
      });

      document.querySelectorAll('input[name="title"]').forEach(function (el) {
        el.addEventListener('change', toggleTitleOther);
      });

      document.querySelectorAll('input[name="dietary"]').forEach(function (el) {
        el.addEventListener('change', function () {
          toggleOtherInput(dietaryOtherRadio, dietaryOther);
        });
      });

      bindFileLabel('degree_file', 'degree_file_name');
      toggleTitleOther();
      toggleOtherInput(dietaryOtherRadio, dietaryOther);
      toggleBankNote();
      updateTotals();
    })();
  </script>
@endpush
