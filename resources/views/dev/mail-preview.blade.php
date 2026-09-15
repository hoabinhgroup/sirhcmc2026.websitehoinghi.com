<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Preview mail xác nhận SIRHCM 2026</title>
  <style>
    body { margin: 0; background: #eef1f4; font-family: Arial, Helvetica, sans-serif; color: #171822; }
    .toolbar { position: sticky; top: 0; z-index: 2; background: #171822; color: #fff; padding: 16px 20px; }
    .toolbar h1 { margin: 0 0 10px; font-size: 18px; font-weight: 600; }
    .toolbar a, .toolbar span { display: inline-block; margin: 0 8px 8px 0; padding: 6px 12px; border-radius: 4px; font-size: 13px; text-decoration: none; }
    .toolbar a { background: #3a3b4a; color: #fff; }
    .toolbar a.active, .toolbar span.active { background: #ec1f23; }
    .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; padding: 20px; }
    .card { background: #fff; border: 1px solid #d9dde3; border-radius: 6px; overflow: hidden; min-width: 0; }
    .meta { padding: 14px 16px; border-bottom: 1px solid #eee; font-size: 13px; line-height: 1.6; background: #fafbfc; }
    .meta strong { display: inline-block; min-width: 72px; color: #6a6b7c; }
    .frame { background: #f4f6f8; }
    iframe { display: block; width: 100%; height: 920px; border: 0; background: #f4f6f8; }
    @media (max-width: 1100px) { .grid { grid-template-columns: 1fr; } iframe { height: 780px; } }
  </style>
</head>
<body>
  <div class="toolbar">
    <h1>Preview 2 mail xác nhận (dữ liệu mẫu, không gửi thật)</h1>
    <div>
      <span>Ngôn ngữ:</span>
      <a class="{{ $locale === 'vi' ? 'active' : '' }}" href="{{ route('dev.mail-preview', ['locale' => 'vi', 'registration' => $registrationTemplate]) }}">Tiếng Việt</a>
      <a class="{{ $locale === 'en' ? 'active' : '' }}" href="{{ route('dev.mail-preview', ['locale' => 'en', 'registration' => $registrationTemplate]) }}">English</a>
      <span>Mail đăng ký:</span>
      <a class="{{ $registrationTemplate === 'bank_transfer' ? 'active' : '' }}" href="{{ route('dev.mail-preview', ['locale' => $locale, 'registration' => 'bank_transfer']) }}">Chuyển khoản</a>
      <a class="{{ $registrationTemplate === 'online_payment' ? 'active' : '' }}" href="{{ route('dev.mail-preview', ['locale' => $locale, 'registration' => 'online_payment']) }}">OnePay</a>
      <a class="{{ $registrationTemplate === 'fee_waived' ? 'active' : '' }}" href="{{ route('dev.mail-preview', ['locale' => $locale, 'registration' => 'fee_waived']) }}">Miễn phí</a>
    </div>
  </div>

  <div class="grid">
    <section class="card">
      <div class="meta">
        <div><strong>Mail</strong> Nộp abstract thành công</div>
        <div><strong>To</strong> {{ $locale === 'en' ? 'jane.doe@example.com' : 'tranthib@example.com' }}</div>
        <div><strong>Subject</strong> {{ $abstractSubject }}</div>
      </div>
      <div class="frame">
        <iframe title="Abstract received email" srcdoc="{{ $abstractHtml }}"></iframe>
      </div>
    </section>

    <section class="card">
      <div class="meta">
        <div><strong>Mail</strong> Đăng ký thành công</div>
        <div><strong>To</strong> {{ $locale === 'en' ? 'john.smith@example.com' : 'nguyenvana@example.com' }}</div>
        <div><strong>Subject</strong> {{ $registrationSubject }}</div>
      </div>
      <div class="frame">
        <iframe title="Registration confirmation email" srcdoc="{{ $registrationHtml }}"></iframe>
      </div>
    </section>
  </div>
</body>
</html>
