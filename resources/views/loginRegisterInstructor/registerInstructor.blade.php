<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register | AllnGrow - Become an Instructor</title>
  <meta name="description" content="Join AllnGrow as an instructor. Share your knowledge and teach students worldwide." />
  <link rel="stylesheet" href="css/registerInstructor.css">
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
  <!-- Simple Background -->
  <div class="slider-thumb"></div>
  <div class="slider-thumb1"></div>
  <div class="slider-thumb2"></div>
  <div class="slider-thumb3"></div>
  <div class="slider-thumb4"></div>
  <div class="slider-thumb5"></div>

  <main class="login-container">
    <div class="logo-section">
      <div class="logo">AllnGrow</div>
      <h1 class="login-title">Instructor Registration</h1>
      <p style="color: #a3a3a3; font-size: 0.9rem; margin-top: 0.5rem;">Start teaching and inspiring students today</p>
    </div>

    <!-- Alerts -->
    @if(session('success'))
      <div class="alert alert-success">
        <strong>Success!</strong> {{ session('success') }}
      </div>
    @endif

    @if(session('error') || $errors->any())
      <div class="alert alert-warning">
        <strong>Registration failed</strong>
        @if(session('error'))
          <div style="margin-top: 6px;">{{ session('error') }}</div>
        @endif
        @if($errors->any())
          <ul>
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        @endif
      </div>
    @endif

    <!-- Registration Form -->
    <form class="form-container" method="POST" action="{{ route('register.instructor.step1') }}">
      @csrf
      <div class="form-fields">
        <!-- Name -->
        <div class="input-group">
          <label for="name" class="input-label">Full Name</label>
          <div class="input-wrapper">
            <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/>
              <circle cx="12" cy="7" r="4"/>
            </svg>
            <input
              type="text"
              id="name"
              name="name"
              class="input-field"
              placeholder="John Doe"
              value="{{ old('name') }}"
              required
              autocomplete="name"
            />
          </div>
        </div>

        <!-- Email -->
        <div class="input-group">
          <label for="email" class="input-label">Email Address</label>
          <div class="input-wrapper">
            <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <rect x="3" y="5" width="18" height="14" rx="2"/>
              <path d="m22 7-8.975 5.25L3 7"/>
            </svg>
            <input
              type="email"
              id="email"
              name="email"
              class="input-field"
              placeholder="example@gmail.com"
              value="{{ old('email') }}"
              required
              autocomplete="email"
            />
          </div>
        </div>

        <!-- Password -->
        <div class="input-group">
          <label for="password" class="input-label">Password</label>
          <div class="input-wrapper">
            <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <rect x="3" y="11" width="18" height="11" rx="2"/>
              <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
            </svg>
            <input
              type="password"
              id="password"
              name="password"
              class="input-field"
              placeholder="••••••••"
              required
              autocomplete="new-password"
            />
          </div>
        </div>

        <!-- Confirm Password -->
        <div class="input-group">
          <label for="password_confirmation" class="input-label">Confirm Password</label>
          <div class="input-wrapper">
            <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <rect x="3" y="11" width="18" height="11" rx="2"/>
              <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
            </svg>
            <input
              type="password"
              id="password_confirmation"
              name="password_confirmation"
              class="input-field"
              placeholder="••••••••"
              required
              autocomplete="new-password"
            />
          </div>
        </div>

        <!-- Terms & Privacy -->
        <div class="terms-and-privacy">
          <div class="checkbox-wrapper">
            <input type="checkbox" id="agree-terms" name="agree_terms" class="checkbox" required />
            <label for="agree-terms" class="checkbox-label">
              I agree with <a href="#">Terms</a> and <a href="#">Privacy Policy</a>
            </label>
          </div>
        </div>
      </div>

      <button type="submit" class="sign-in-btn">Create Instructor Account</button>
    </form>

    <!-- Divider -->
    <div class="divider-section" style="margin-top: 2rem;">
      <div class="divider-row">
        <div class="divider-line"></div>
        <span class="divider-text">Or sign up with</span>
        <div class="divider-line"></div>
      </div>

      <button type="button" class="google-btn" onclick="alert('Google Sign-Up not implemented yet')">
        <img src="images/googleIcon.png" alt="Google" class="google-icon" />
        Sign up with Google
      </button>
    </div>

    <!-- Sign In Link -->
    <div class="signup-section">
      <a href="/loginInstructor" class="signup-link" style="font-size: 1.1rem; font-weight: 600;">Sign In</a>
    </div>
  </main>
</body>
</html>
