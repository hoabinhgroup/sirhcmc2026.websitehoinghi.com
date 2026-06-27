@extends('emails.layout')

@section('content')
  @php
    $isAccepted = $result === 'accepted';
    $isRejected = $result === 'rejected';
  @endphp

  @if ($submission->isDomestic())
    <p style="margin:0 0 16px;">Kính gửi <strong>{{ $submission->title }} {{ $submission->fullname }}</strong>,</p>
    @if ($isAccepted)
      <p style="margin:0 0 20px;">Ban Tổ chức <strong style="color:#16a34a;">chấp nhận</strong> abstract của Quý Đại biểu cho <strong>SIRHCM 2026</strong>.</p>
    @elseif ($isRejected)
      <p style="margin:0 0 20px;">Ban Tổ chức rất tiếc phải thông báo abstract của Quý Đại biểu <strong style="color:#dc2626;">không được chấp nhận</strong>.</p>
    @else
      <p style="margin:0 0 20px;">Ban Tổ chức <strong>yêu cầu chỉnh sửa/bổ sung</strong> abstract của Quý Đại biểu.</p>
    @endif
  @else
    <p style="margin:0 0 16px;">Dear <strong>{{ $submission->title }} {{ $submission->fullname }}</strong>,</p>
    @if ($isAccepted)
      <p style="margin:0 0 20px;">We are pleased to inform you that your abstract for <strong>SIRHCM 2026</strong> has been <strong style="color:#16a34a;">accepted</strong>.</p>
    @elseif ($isRejected)
      <p style="margin:0 0 20px;">We regret to inform you that your abstract for <strong>SIRHCM 2026</strong> was <strong style="color:#dc2626;">not accepted</strong>.</p>
    @else
      <p style="margin:0 0 20px;">We request <strong>revision</strong> of your abstract submission for <strong>SIRHCM 2026</strong>.</p>
    @endif
  @endif

  <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="margin:0 0 24px;background:#f8f9fb;border-left:4px solid #ec1f23;">
    <tr>
      <td style="padding:16px 18px;">
        <p style="margin:0 0 8px;"><strong>{{ $submission->isDomestic() ? 'Mã submission' : 'Submission ID' }}:</strong> {{ $submission->submission_code }}</p>
        <p style="margin:0 0 8px;"><strong>{{ $submission->isDomestic() ? 'Chủ đề' : 'Category' }}:</strong> {{ $submission->category_label }}</p>
        @if ($submission->review_note)
          <p style="margin:0 0 8px;"><strong>{{ $submission->isDomestic() ? 'Ghi chú' : 'Note' }}:</strong> {{ $submission->review_note }}</p>
        @endif
      </td>
    </tr>
  </table>

  <p style="margin:16px 0 0;">{{ $submission->isDomestic() ? 'Liên hệ' : 'Contact' }}: <a href="mailto:sirhcm2024@gmail.com">sirhcm2024@gmail.com</a></p>

  <p style="margin:24px 0 0;">
    {{ $submission->isDomestic() ? 'Trân trọng' : 'Best regards' }},<br>
    <strong>SIRHCM 2026 Secretariat</strong>
  </p>
@endsection
