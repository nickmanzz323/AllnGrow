<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Forgot Password | AllnGrow - Instructor Portal</title>
  <meta name="description" content="Reset your AllnGrow instructor account password." />
  <link rel="stylesheet" href="{{ asset('css/loginInstructor.css') }}">
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
  </style>
</head>

<body>
  <!-- Simple Background -->
  <div class="slider-thumb"></div>
  <div class="slider-thumb1"></div>
  <div class="slider-thumb2"></div>
  <div class="slider-thumb3"></div>
  <div class="slider-thumb4"></div>
  <div class="slider-thumb5"></div>

  <main class="login-container">
    <section class="logo-section">
      <div class="logo">AllnGrow</div>
      <h1 class="login-title">Forgot Password</h1>
      <p style="color: #a3a3a3; font-size: 0.9rem; margin-top: 0.5rem;">Enter your email to reset your password</p>
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

    <!-- Forgot Password Form -->
    <form class="form-container" method="POST" action="{{ route('instructor.password.email') }}">
      @csrf
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
      </div>

      <button type="submit" class="sign-in-btn">Send Reset Link</button>
    </form>

    <!-- Back to Login Link -->
    <div class="signup-section">
      <a href="{{ route('instructor.login') }}" class="signup-link" style="font-size: 1.1rem; font-weight: 600;">Back to Login</a>
    </div>
  </main>
</body>
</html>
