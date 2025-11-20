<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Your Password</title>
  <style>
    body {
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
      line-height: 1.6;
      color: #333;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 600px;
      margin: 40px auto;
      background: #ffffff;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .header {
      background: linear-gradient(135deg, #0d2b01 0%, #264440 100%);
      padding: 40px 30px;
      text-align: center;
    }
    .header h1 {
      color: #ffffff;
      margin: 0;
      font-size: 28px;
      font-weight: 600;
    }
    .content {
      padding: 40px 30px;
    }
    .content h2 {
      color: #333;
      font-size: 20px;
      margin: 0 0 20px 0;
    }
    .content p {
      color: #666;
      margin: 0 0 15px 0;
      font-size: 16px;
    }
    .button-container {
      text-align: center;
      margin: 30px 0;
    }
    .button {
      display: inline-block;
      padding: 14px 32px;
      background: #0d2b01;
      color: #ffffff;
      text-decoration: none;
      border-radius: 6px;
      font-weight: 600;
      font-size: 16px;
      transition: background 0.3s;
    }
    .button:hover {
      background: #264440;
    }
    .info-box {
      background: #f8f9fa;
      border-left: 4px solid #0d2b01;
      padding: 15px 20px;
      margin: 20px 0;
      border-radius: 4px;
    }
    .info-box p {
      margin: 0;
      font-size: 14px;
      color: #555;
    }
    .footer {
      background: #f8f9fa;
      padding: 30px;
      text-align: center;
      font-size: 14px;
      color: #999;
    }
    .footer p {
      margin: 5px 0;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>AllnGrow</h1>
    </div>

    <div class="content">
      <h2>Hello {{ $name }},</h2>

      <p>We received a request to reset the password for your AllnGrow student account.</p>

      <p>Click the button below to reset your password:</p>

      <div class="button-container">
        <a href="{{ $resetUrl }}" class="button">Reset Password</a>
      </div>

      <div class="info-box">
        <p><strong>This link will expire in 60 minutes.</strong></p>
        <p>If you didn't request a password reset, you can safely ignore this email. Your password will remain unchanged.</p>
      </div>

      <p>If the button above doesn't work, copy and paste this link into your browser:</p>
      <p style="word-break: break-all; color: #0d2b01; font-size: 14px;">{{ $resetUrl }}</p>
    </div>

    <div class="footer">
      <p>This is an automated email from AllnGrow</p>
      <p>&copy; {{ date('Y') }} AllnGrow. All rights reserved.</p>
    </div>
  </div>
</body>
</html>
