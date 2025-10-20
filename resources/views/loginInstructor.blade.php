<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login | AllnGrow - Secure Access to Your Account</title>
  <meta name="description" content="Sign in to your AllnGrow account securely. Access your dashboard with email/password or continue with Google. New users can sign up easily." />
  <meta name="keywords" content="AllnGrow login, sign in, user authentication, secure access, account login" />
  <meta property="og:type" content="website" />
  <meta property="og:title" content="Login | AllnGrow - Secure Access to Your Account" />
  <meta property="og:description" content="Sign in to your AllnGrow account securely. Access your dashboard with email/password or continue with Google." />
  <link rel="stylesheet" href="css/loginInstructor.css">
</head>

<body>

  <!-- Background Blobs -->
  <div class="slider-thumb"></div>
  <div class="slider-thumb1"></div>
  <div class="slider-thumb2"></div>
  <div class="slider-thumb3"></div>
  <div class="slider-thumb4"></div>
  <div class="slider-thumb5"></div>

  
  <main class="login-container">
    <section class="logo-section">
      <div class="logo">AllnGrow</div>
      <h1 class="login-title">Login As Instructor</h1>
    </section>

    @if(session('success'))
      <div style="background:#d4edda;border:1px solid #c3e6cb;color:#155724;padding:12px;margin:12px 0;border-radius:4px;font-weight:600;">
        {{ session('success') }}
      </div>
    @endif
    @if(session('error'))
      <div style="background:#fff3cd;border:1px solid #ffeeba;color:#856404;padding:12px;margin:12px 0;border-radius:4px;font-weight:600;">
        {{ session('error') }}
      </div>
    @endif
    @if($errors->any())
      <div class="error-messages">
        <ul>
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form class="form-container" method="POST" action="{{ route('postlogin') }}">
      @csrf
      <div class="form-fields">
        <div class="input-group">
          <label for="email" class="input-label">Email</label>
          <div class="input-wrapper">
            <img src="images/mailLogo.png" alt="Email Icon" class="input-icon" />
            <input type="email" name='email' id="email" class="input-field" placeholder="example@gmail.com" value="{{ old('email') }}" required />
          </div>
        </div>
        
        <div class="input-group">
          <label for="password" class="input-label">Password</label>
          <div class="input-wrapper">
            <img src="images/lockPicture.png" alt="Lock Icon" class="input-icon" />
            <input type="password" name='password' id="password" class="input-field password-field" placeholder="••••••••" required />
          </div>
        </div>
        
        <div class="remember-forgot-row">
          <div class="checkbox-wrapper">
            <input type="checkbox" id="remember" name="remember" class="checkbox" />
            <label for="remember" class="checkbox-label">Remember me</label>
          </div>
          <a href="#" class="forgot-link">Forgot Password?</a>
        </div>
      </div>
      
      <button type="submit" class="sign-in-btn">Sign in</button>
    </form>
    
    <div class="signup-section">
      <span class="signup-text">Don't have an account yet?</span>
      <a href="/register" class="signup-link">Sign up</a>
    </div>
    
    <div class="divider-section">
      <div class="divider-row">
        <div class="divider-line"></div>
        <span class="divider-text">Or continue with</span>
        <div class="divider-line"></div>
      </div>
    
      <button type="button" class="google-btn">
        <img src="images/googleIcon.png" alt="Google Icon" class="google-icon" />
        Sign in with Google
      </button>
    </div>
  </main>
</body>
</html>
