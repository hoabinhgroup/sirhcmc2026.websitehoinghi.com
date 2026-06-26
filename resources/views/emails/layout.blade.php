<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $subject ?? 'SIRHCM 2026' }}</title>
</head>
<body style="margin:0;padding:0;background:#f4f6f8;font-family:Arial,Helvetica,sans-serif;color:#171822;">
  <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:#f4f6f8;padding:24px 12px;">
    <tr>
      <td align="center">
        <table role="presentation" width="600" cellspacing="0" cellpadding="0" style="max-width:600px;width:100%;background:#ffffff;border:1px solid #e5e5e5;border-radius:2px;overflow:hidden;">
          <tr>
            <td style="background:linear-gradient(to right,#f9488b 0%,#ec1f23 100%);padding:20px 28px;">
              <h1 style="margin:0;font-size:22px;font-weight:600;color:#ffffff;">SIRHCM 2026</h1>
              <p style="margin:6px 0 0;font-size:14px;color:rgba(255,255,255,0.9);">Xác nhận đăng ký / Registration Confirmation</p>
            </td>
          </tr>
          <tr>
            <td style="padding:28px;font-size:15px;line-height:1.7;color:#6a6b7c;">
              @yield('content')
            </td>
          </tr>
          <tr>
            <td style="padding:16px 28px 24px;border-top:1px solid #e5e5e5;font-size:13px;color:#a0a1b5;text-align:center;">
              Ban Tổ chức SIRHCM 2026 &middot;
              <a href="mailto:sirhcm2024@gmail.com" style="color:#ec1f23;text-decoration:none;">sirhcm2024@gmail.com</a>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
