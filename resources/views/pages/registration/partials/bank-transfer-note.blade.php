@php
  $isInternational = $isInternational ?? false;
  $bank = $bank ?? config('registration.bank_transfer', []);
@endphp

<div id="bank-transfer-note" class="note-box">
  <p><strong>{{ $isInternational ? 'Bank transfer details:' : 'Thông tin chuyển khoản:' }}</strong></p>
  <p>{{ $isInternational ? 'Account name' : 'Tên tài khoản' }}: {{ $bank['account_name'] ?? '' }}</p>
  <p>{{ $isInternational ? 'Account number' : 'Số tài khoản' }}: {{ ($bank['account_number'] ?? '') ?: '—' }}</p>
  <p>{{ $isInternational ? 'Bank' : 'Ngân hàng' }}: {{ $bank['bank_name'] ?? '' }}</p>
  @if (! empty($bank['swift']))
    <p>SWIFT: {{ $bank['swift'] }}</p>
  @endif
  @if (! empty($bank['bank_code']))
    <p>{{ $isInternational ? 'Bank code' : 'Mã ngân hàng' }}: {{ $bank['bank_code'] }}</p>
  @endif
  <p>{{ $isInternational ? 'Transfer content' : 'Nội dung chuyển khoản' }}: <em>{Full name} – {Registration ID} | SIRHCM2026</em></p>

  <b>{{ $isInternational ? 'Please send the screenshot of the bank transfer receipt to the email: sirhcm2024@gmail.com' : 'Quý đại biểu vui lòng gửi ảnh chụp sao kê đến email: sirhcm2024@gmail.com' }}</b>
</div>
