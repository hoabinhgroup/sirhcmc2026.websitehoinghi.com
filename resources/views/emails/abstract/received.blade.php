@extends('emails.layout')

@section('content')
  @if ($submission->isDomestic())
    <p style="margin:0 0 16px;color:#171822;">
      Kính gửi <strong>{{ $submission->title }} {{ $submission->fullname }}</strong>,
    </p>
    <p style="margin:0 0 20px;">
      Ban Tổ chức xác nhận đã nhận abstract của Quý Đại biểu cho <strong>SIRHCM 2026</strong>.
    </p>
  @else
    <p style="margin:0 0 16px;color:#171822;">
      Dear <strong>{{ $submission->title }} {{ $submission->fullname }}</strong>,
    </p>
    <p style="margin:0 0 20px;">
      This email confirms receipt of your abstract submission for <strong>SIRHCM 2026</strong>.
    </p>
  @endif

  <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="margin:0 0 24px;background:#f8f9fb;border-left:4px solid #ec1f23;">
    <tr>
      <td style="padding:16px 18px;">
        <p style="margin:0 0 8px;"><strong>{{ $submission->isDomestic() ? 'Mã submission' : 'Submission ID' }}:</strong> {{ $submission->submission_code }}</p>
        <p style="margin:0 0 8px;"><strong>{{ $submission->isDomestic() ? 'Chủ đề' : 'Category' }}:</strong> {{ $submission->category_label }}</p>
        <p style="margin:0 0 8px;"><strong>{{ $submission->isDomestic() ? 'Đơn vị' : 'Affiliation' }}:</strong> {{ $submission->affiliation }}</p>
        <p style="margin:0 0 8px;"><strong>Email:</strong> {{ $submission->email }}</p>
      </td>
    </tr>
  </table>

  <p style="margin:0 0 16px;">
    {{ $submission->isDomestic()
        ? 'Kết quả chấp nhận abstract dự kiến công bố trước 15/09/2026.'
        : 'Abstract acceptance results are expected to be announced by 15/09/2026.' }}
  </p>

  <p style="margin:24px 0 0;color:#171822;">
    {{ $submission->isDomestic() ? 'Trân trọng' : 'Best regards' }},<br>
    <strong>SIRHCM 2026 Secretariat</strong>
  </p>
@endsection
