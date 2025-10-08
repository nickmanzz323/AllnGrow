<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login | HinGrow - Secure Access to Your Account</title>
  <meta name="description" content="Sign in to your HinGrow account securely. Access your dashboard with email/password or continue with Google. New users can sign up easily." />
  <meta name="keywords" content="HinGrow login, sign in, user authentication, secure access, account login" />

  <meta property="og:type" content="website" />
  <meta property="og:title" content="Login | HinGrow - Secure Access to Your Account" />
  <meta property="og:description" content="Sign in to your HinGrow account securely. Access your dashboard with email/password or continue with Google." />

<link rel="stylesheet" href="{{ asset('css/login.css') }}">

</head>
<body>
  <main class="login-container">
    <section class="logo-section">
      <img src="{{ asset('images/companyLogo.png') }}" alt="AllnGrow Logo" class="logo" />
      <h1 class="login-title">Login</h1>
    </section>
    
    <form class="form-container">
      <div class="form-fields">
        <div class="input-group">
          <label for="email" class="input-label">Email</label>
          <div class="input-wrapper">
            <img src="{{ asset('images/mailLogo.png') }}" alt="" class="input-icon" />
            <input type="email" id="email" class="input-field" placeholder="example@gmail.com" />
          </div>
        </div>
        
        <div class="input-group">
          <label for="password" class="input-label">Password</label>
          <div class="input-wrapper">
            <img src="{{ asset('images/lockPicture.png') }}"alt="" class="input-icon" />
            <input type="password" id="password" class="input-field password-field" placeholder="••••••••" />
          </div>
        </div>
        
        <div class="remember-forgot-row">
          <div class="checkbox-wrapper">
            <input type="checkbox" id="remember" class="checkbox" />
            <label for="remember" class="checkbox-label">Remember me</label>
          </div>
          <a href="#" class="forgot-link">Forgot Password?</a>
        </div>
      </div>
      
      <button type="submit" class="sign-in-btn">Sign in</button>
    </form>
    
    <div class="signup-section">
      <span class="signup-text">Don't have an account yet?</span>
      <a href="#" class="signup-link">Sign up</a>
    </div>
    
    <div class="divider-section">
      <div class="divider-row">
        <div class="divider-line"></div>
        <span class="divider-text">Or continue with</span>
        <div class="divider-line"></div>
      </div>
      
      <button type="button" class="google-btn">
        <img src="{{ asset('images/googleIcon.png') }}" alt="" class="google-icon" />
        Sign in with Google
      </button>
    </div>
  </main>
</body>
</html>