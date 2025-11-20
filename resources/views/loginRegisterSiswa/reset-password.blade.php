<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Reset Password | AllnGrow - Student Portal</title>
  <meta name="description" content="Create a new password for your AllnGrow student account." />
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
  <style>
    /* Simple Alert Styling */
    .alert {
      padding: 14px 16px;
      margin: 16px 0;
      border-radius: 8px;
      font-size: 0.9rem;
      line-height: 1.5;
    }
    .alert-success {
      background: #d4edda;
      border: 1px solid #c3e6cb;
      color: #155724;
    }
    .alert-warning {
      background: #fff3cd;
      border: 1px solid #ffeeba;
      color: #856404;
    }
    .alert-error {
      background: #f8d7da;
      border: 1px solid #f5c6cb;
      color: #721c24;
    }
    .alert ul {
      margin: 8px 0 0 0;
      padding-left: 20px;
    }
    .alert li {
      margin: 4px 0;
    }
  </style>
</head>

<body>
  <!-- Simple Animated Background -->
  <div class="animated-bg">
    <svg preserveAspectRatio="xMidYMid slice" viewBox="10 10 80 80">
      <defs>
        <style>
          @keyframes rotate { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
          .out-top { animation: rotate 25s linear infinite; transform-origin: 13px 25px; }
          .in-top { animation: rotate 15s linear infinite; transform-origin: 13px 25px; }
          .out-bottom { animation: rotate 30s linear infinite; transform-origin: 84px 93px; }
          .in-bottom { animation: rotate 20s linear infinite; transform-origin: 84px 93px; }
        </style>
      </defs>
      <path fill="rgba(13, 43, 1, 1)" class="out-top" d="M37-5C25.1-14.7,5.7-19.1-9.2-10-28.5,1.8-32.7,31.1-19.8,49c15.5,21.5,52.6,22,67.2,2.3C59.4,35,53.7,8.5,37-5Z"/>
      <path fill="rgba(255, 255, 255, 1)" class="in-top" d="M20.6,4.1C11.6,1.5-1.9,2.5-8,11.2-16.3,23.1-8.2,45.6,7.4,50S42.1,38.9,41,24.5C40.2,14.1,29.4,6.6,20.6,4.1Z"/>
      <path fill="rgba(38, 64, 68, 1)" class="out-bottom" d="M105.9,48.6c-12.4-8.2-29.3-4.8-39.4.8-23.4,12.8-37.7,51.9-19.1,74.1s63.9,15.3,76-5.6c7.6-13.3,1.8-31.1-2.3-43.8C117.6,63.3,114.7,54.3,105.9,48.6Z"/>
      <path fill="rgba(255, 255, 255, 1)" class="in-bottom" d="M102,67.1c-9.6-6.1-22-3.1-29.5,2-15.4,10.7-19.6,37.5-7.6,47.8s35.9,3.9,44.5-12.5C115.5,92.6,113.9,74.6,102,67.1Z"/>
    </svg>
  </div>

  <main class="login-container">
    <section class="logo-section">
      <div class="logo">
        <img src="{{ asset('images/AllnGrowDark.svg') }}" alt="AllnGrow Logo" width="155" height="auto">
      </div>
      <h1 class="login-title">Reset Password</h1>
      <p style="color: #a3a3a3; font-size: 0.9rem; margin-top: 0.5rem;">Enter your new password</p>
    </section>

    <!-- Alerts -->
    @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    @if(session('error'))
      <div class="alert alert-warning">
        {{ session('error') }}
      </div>
    @endif

    @if($errors->any())
      <div class="alert alert-error">
        <strong>Please fix the following errors:</strong>
        <ul>
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <!-- Reset Password Form -->
    <form class="form-container" method="POST" action="{{ route('student.password.update') }}">
      @csrf
      <input type="hidden" name="token" value="{{ $token }}">

      <div class="form-fields">
        <!-- Email -->
        <div class="input-group">
          <label for="email" class="input-label">Email Address</label>
          <div class="input-wrapper">
            <img src="{{ asset('images/mailLogo.png') }}" alt="Email" class="input-icon" />
            <input
              type="email"
              name="email"
              id="email"
              class="input-field"
              placeholder="example@gmail.com"
              value="{{ old('email') }}"
              required
              autocomplete="email"
            />
          </div>
        </div>

        <!-- New Password -->
        <div class="input-group">
          <label for="password" class="input-label">New Password</label>
          <div class="input-wrapper">
            <img src="{{ asset('images/lockPicture.png') }}" alt="Password" class="input-icon" />
            <input
              type="password"
              name="password"
              id="password"
              class="input-field"
              placeholder="••••••••"
              required
              autocomplete="new-password"
            />
          </div>
        </div>

        <!-- Confirm New Password -->
        <div class="input-group">
          <label for="password_confirmation" class="input-label">Confirm New Password</label>
          <div class="input-wrapper">
            <img src="{{ asset('images/lockPicture.png') }}" alt="Password" class="input-icon" />
            <input
              type="password"
              name="password_confirmation"
              id="password_confirmation"
              class="input-field"
              placeholder="••••••••"
              required
              autocomplete="new-password"
            />
          </div>
        </div>
      </div>

      <button type="submit" class="sign-in-btn">Reset Password</button>
    </form>

    <!-- Back to Login Link -->
    <div class="signup-section">
      <a href="{{ route('student.login') }}" class="signup-link" style="font-size: 1.1rem; font-weight: 600;">Back to Login</a>
    </div>
  </main>
</body>
</html>
