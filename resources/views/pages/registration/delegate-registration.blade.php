@extends('layout.index')
@section('title', 'Delegate Registration')

@push('styles')
  <link rel="stylesheet" href="{{ Storage::url('css/registration-form.css') }}" type="text/css">
@endpush

@if ($recaptchaSiteKey)
  @push('header')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  @endpush
@endif

@section('content')
  @include('pages.registration.partials.breadcrumb', ['breadcrumbCurrent' => 'Delegate Registration'])

  <section class="registration-form about-section spad">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-title">
            <h2>Đăng ký tham dự / Delegate Registration</h2>
            <p class="f-para">Vui lòng điền đầy đủ thông tin bên dưới.</p>
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
        <input type="hidden" name="category" value="LOCAL REGISTRATION">
        <input type="hidden" name="country" value="VN">
        <input type="hidden" name="total_amount" id="total_amount" value="{{ old('total_amount', 0) }}">

        {{-- Thông tin chung --}}
        <div class="form-section">
          <h3>Thông tin chung / General Information</h3>

          <div class="form-group">
            <label>Danh xưng / Title <sup>*</sup></label>
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
                <span>Khác / Other</span>
              </label>
            </div>
            <div class="other-input-wrap" id="title-other-wrap" style="{{ old('title') == 'other' ? '' : 'display:none' }}">
              <input type="text"
                     name="titleOther"
                     id="titleOther"
                     class="form-control"
                     value="{{ old('titleOther') }}"
                     placeholder="Nhập danh xưng khác"
                     @disabled(old('title') !== 'other')>
            </div>
            @error('title')<span class="text-danger d-block">{{ $message }}</span>@enderror
            @error('titleOther')<span class="text-danger d-block">{{ $message }}</span>@enderror
          </div>

          <div class="form-group">
            <label for="fullname">Họ tên / Full name <sup>*</sup></label>
            <input type="text" id="fullname" name="fullname" class="form-control" value="{{ old('fullname') }}" required>
            @error('fullname')<span class="text-danger">{{ $message }}</span>@enderror
          </div>

          <div class="form-group">
            <label for="affiliation">Đơn vị công tác / Affiliation <sup>*</sup></label>
            <input type="text" id="affiliation" name="affiliation" class="form-control" value="{{ old('affiliation') }}" required>
            @error('affiliation')<span class="text-danger">{{ $message }}</span>@enderror
          </div>

          <div class="form-group">
            <label for="position">Chức vụ / Position</label>
            <input type="text" id="position" name="position" class="form-control" value="{{ old('position') }}">
          </div>

          <div class="form-group">
            <label>Ngày sinh / Date of birth <sup>*</sup></label>
            <div class="date-group">
              <select name="day" class="form-control" required>
                <option value="">Ngày</option>
                @for ($d = 1; $d <= 31; $d++)
                  <option value="{{ $d }}" @selected((int) old('day') === $d)>{{ $d }}</option>
                @endfor
              </select>
              <select name="month" class="form-control" required>
                <option value="">Tháng</option>
                @for ($m = 1; $m <= 12; $m++)
                  <option value="{{ $m }}" @selected((int) old('month') === $m)>{{ $m }}</option>
                @endfor
              </select>
              <select name="year" class="form-control" required>
                <option value="">Năm</option>
                @for ($y = date('Y'); $y >= 1940; $y--)
                  <option value="{{ $y }}" @selected((int) old('year') === $y)>{{ $y }}</option>
                @endfor
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="phone">Điện thoại / Phone <sup>*</sup></label>
            <input type="tel" id="phone" name="phone" class="form-control" value="{{ old('phone') }}" required>
          </div>

          <div class="form-group">
            <label for="email">Email <sup>*</sup></label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
          </div>

          <div class="form-group">
            <label>Bằng cấp / Degree file (PDF, JPG, PNG) <sup>*</sup></label>
            <label for="degree_file" class="file-upload-label">Tải file / Upload</label>
            <input type="file" id="degree_file" name="degree_file" accept=".pdf,.jpg,.jpeg,.png" required>
            <span id="degree_file_name" class="file-name"></span>
            @error('degree_file')<span class="text-danger">{{ $message }}</span>@enderror
          </div>
        </div>

        {{-- Ăn kiêng --}}
        <div class="form-section">
          <h3>Ăn kiêng / Dietary requirements</h3>
          <div class="form-group">
            <div class="radio-group">
              @foreach ($dietaryOptions as $value => $label)
                @if ($value !== 'other')
                  <label class="radio-inline">
                    <input type="radio" name="dietary" value="{{ $value }}" @checked(old('dietary', 'Không có') == $value) required>
                    <span>{{ $label }}</span>
                  </label>
                @endif
              @endforeach
              <label class="radio-inline">
                <input type="radio" name="dietary" value="other" id="dietary_other_radio" @checked(old('dietary') == 'other')>
                <span>Khác / Other</span>
                <input type="text"
                       name="dietaryOther"
                       id="dietaryOther"
                       class="other-input"
                       value="{{ old('dietaryOther') }}"
                       placeholder="Yêu cầu ăn kiêng khác"
                       @disabled(old('dietary') !== 'other')>
              </label>
            </div>
            @error('dietary')<span class="text-danger d-block">{{ $message }}</span>@enderror
          </div>
        </div>

        {{-- Bảng phí --}}
        <div class="form-section" id="fee_section_early">
          <h3>Phí tham dự / Conference fees</h3>
          <table class="fee-table">
            <thead>
              <tr>
                <th>Chọn</th>
                <th>Gói phí / Package</th>
                <th>Giá (VND)</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($fees as $slug => $fee)
                <tr onclick="document.getElementById('fee_{{ $slug }}').click();">
                  <td>
                    <input type="radio"
                           id="fee_{{ $slug }}"
                           name="conference_checklist_item"
                           value="{{ $slug }}"
                           class="fee-radio"
                           data-fee-type="early"
                           data-fee-amount="{{ $fee['amount'] }}"
                           data-requires-proof="{{ $fee['requires_proof'] ? '1' : '0' }}"
                           @checked(old('conference_checklist_item') == $slug)
                           required>
                  </td>
                  <td>{{ $fee['label_vi'] }} / {{ $fee['label_en'] }}</td>
                  <td>{{ number_format($fee['amount'], 0, '.', ',') }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>

          <div class="form-group mt-3" id="young-ir-proof-wrap" style="display:none">
            <label>Giấy tờ xác nhận bác sĩ trẻ / Young IR proof <sup>*</sup></label>
            <label for="young_ir_proof_early" class="file-upload-label">Tải file / Upload</label>
            <input type="file" id="young_ir_proof_early" name="young_ir_proof_early" accept=".pdf,.jpg,.jpeg,.png">
            <span id="young_ir_proof_name" class="file-name"></span>
            @error('young_ir_proof_early')<span class="text-danger">{{ $message }}</span>@enderror
          </div>

          <div class="form-group mt-3">
            <label class="radio-inline">
              <input type="checkbox"
                     name="galadinner_fee"
                     id="galadinner_fee"
                     value="1"
                     data-fee-type="early"
                     @checked(old('galadinner_fee'))>
              <span>Gala Dinner — {{ number_format($galadinnerFee, 0, '.', ',') }} VND</span>
            </label>
          </div>

          <p class="total-summary">
            Tổng cộng / Total: <span id="total_early">0</span> VND
          </p>
        </div>

        {{-- Thanh toán --}}
        <div class="form-section">
          <h3>Phương thức thanh toán / Payment method</h3>
          <div class="payment-method-group">
            <label class="radio-inline d-block mb-2">
              <input type="radio" name="payment_method" value="onepay" @checked(old('payment_method', 'onepay') == 'onepay') required>
              <span>Thanh toán online OnePay (cộng thêm 6% phí giao dịch)</span>
            </label>
            <label class="radio-inline d-block">
              <input type="radio" name="payment_method" value="bank-transfer" id="payment_bank_transfer" @checked(old('payment_method') == 'bank-transfer')>
              <span>Chuyển khoản ngân hàng / Bank transfer</span>
            </label>
          </div>

          <div id="bank-transfer-note" class="note-box">
            <p><strong>Thông tin chuyển khoản:</strong></p>
            <p>Tên tài khoản / Account name: {{ $bank['account_name'] }}</p>
            @if (! empty($bank['account_short_name']))
              <p>Tên viết tắt / Short name: {{ $bank['account_short_name'] }}</p>
            @endif
            <p>Số tài khoản / Account number: {{ $bank['account_number'] ?: '—' }}</p>
            <p>Ngân hàng / Bank: {{ $bank['bank_name'] }}</p>
            <p>Địa chỉ ngân hàng / Bank address: {{ $bank['bank_address'] ?? '' }}</p>
            @if ($bank['swift'])
              <p>SWIFT code: {{ $bank['swift'] }}</p>
            @endif
            <p>Nội dung chuyển khoản / Transfer content: <em>{Họ tên} – {Mã đăng ký} | Đóng phí SIRHCM2026</em></p>
          </div>
        </div>

        @if ($recaptchaSiteKey)
          <div class="form-group">
            <div class="g-recaptcha" data-sitekey="{{ $recaptchaSiteKey }}"></div>
            @error('g-recaptcha-response')<span class="text-danger d-block">{{ $message }}</span>@enderror
          </div>
        @endif

        <div class="form-submit-wrap">
          <button type="submit" class="submit-button primary-btn">Gửi đăng ký / Submit</button>
        </div>
      </form>
    </div>
  </section>
@endsection

@push('scripts')
  <script>
    (function () {
      const galadinnerFee = {{ (int) $galadinnerFee }};
      const totalInput = document.getElementById('total_amount');
      const totalDisplay = document.getElementById('total_early');
      const youngIrWrap = document.getElementById('young-ir-proof-wrap');
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

      function calculateTotal() {
        let total = 0;
        const radio = document.querySelector('input[name="conference_checklist_item"][data-fee-type="early"]:checked');
        if (radio) {
          total += parseInt(radio.getAttribute('data-fee-amount') || '0', 10);
          const requiresProof = radio.getAttribute('data-requires-proof') === '1';
          youngIrWrap.style.display = requiresProof ? 'block' : 'none';
        }
        if (document.getElementById('galadinner_fee').checked) {
          total += galadinnerFee;
        }
        return total;
      }

      function updateTotals() {
        const total = calculateTotal();
        totalInput.value = total;
        totalDisplay.textContent = formatVnd(total);
      }

      function toggleTitleOther() {
        const enabled = titleOtherRadio && titleOtherRadio.checked;
        if (titleOtherWrap) {
          titleOtherWrap.style.display = enabled ? 'block' : 'none';
        }
        if (titleOther) {
          titleOther.disabled = !enabled;
          if (!enabled) {
            titleOther.value = '';
          }
        }
      }

      function toggleOtherInput(radio, input) {
        if (!radio || !input) return;
        const enabled = radio.checked;
        input.disabled = !enabled;
        if (!enabled) input.value = '';
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

      document.querySelectorAll('.fee-radio, #galadinner_fee').forEach(function (el) {
        el.addEventListener('change', updateTotals);
      });

      document.querySelectorAll('input[name="title"]').forEach(function (el) {
        el.addEventListener('change', toggleTitleOther);
      });

      document.querySelectorAll('input[name="dietary"]').forEach(function (el) {
        el.addEventListener('change', function () {
          toggleOtherInput(dietaryOtherRadio, dietaryOther);
        });
      });

      document.querySelectorAll('input[name="payment_method"]').forEach(function (el) {
        el.addEventListener('change', toggleBankNote);
      });

      bindFileLabel('degree_file', 'degree_file_name');
      bindFileLabel('young_ir_proof_early', 'young_ir_proof_name');

      toggleTitleOther();
      toggleOtherInput(dietaryOtherRadio, dietaryOther);
      toggleBankNote();
      updateTotals();
    })();
  </script>
@endpush
