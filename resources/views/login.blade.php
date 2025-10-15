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
  <link rel="stylesheet" href="css/login.css">
</head>

<body>
  <div class="animated-bg">
    <svg preserveAspectRatio="xMidYMid slice" viewBox="10 10 80 80">
      <defs>
        <style>
          .out-top { animation: rotate 25s linear infinite; transform-origin: 13px 25px; }
          .in-top { animation: rotate 15s linear infinite; transform-origin: 13px 25px; }
          .out-bottom { animation: rotate 30s linear infinite; transform-origin: 84px 93px; }
          .in-bottom { animation: rotate 20s linear infinite; transform-origin: 84px 93px; }
        </style>
      </defs>
      <path fill="rgba(13, 43, 1, 1)" class="out-top" d="M37-5C25.1-14.7,5.7-19.1-9.2-10-28.5,1.8-32.7,31.1-19.8,49c15.5,21.5,52.6,22,67.2,2.3C59.4,35,53.7,8.5,37-5Z"/>
      <path fill="rgba(255, 255, 255, 1)" class="in-top" d="M20.6,4.1C11.6,1.5-1.9,2.5-8,11.2-16.3,23.1-8.2,45.6,7.4,50S42.1,38.9,41,24.5C40.2,14.1,29.4,6.6,20.6,4.1Z"/>
      <path fill="rgba(1, 164, 55, 1)" class="out-bottom" d="M105.9,48.6c-12.4-8.2-29.3-4.8-39.4.8-23.4,12.8-37.7,51.9-19.1,74.1s63.9,15.3,76-5.6c7.6-13.3,1.8-31.1-2.3-43.8C117.6,63.3,114.7,54.3,105.9,48.6Z"/>
      <path fill="rgba(255, 255, 255, 1)" class="in-bottom" d="M102,67.1c-9.6-6.1-22-3.1-29.5,2-15.4,10.7-19.6,37.5-7.6,47.8s35.9,3.9,44.5-12.5C115.5,92.6,113.9,74.6,102,67.1Z"/>
    </svg>
  </div>

  <main class="login-container">
    <section class="logo-section">
      <div class="logo">AllnGrow</div>
      <h1 class="login-title">Login</h1>
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
