<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Metadata dasar -->
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  
  <!-- Judul halaman -->
  <title>Login | HinGrow - Secure Access to Your Account</title>
  <meta name="description" content="Sign in to your AllnGrow account securely. Access your dashboard with email/password or continue with Google. New users can sign up easily." />
  <meta name="keywords" content="AllnGrow login, sign in, user authentication, secure access, account login" />
  
  <!-- Metadata Open Graph untuk sosial media -->
  <meta property="og:type" content="website" />
  <meta property="og:title" content="Login | HinGrow - Secure Access to Your Account" />
  <meta property="og:description" content="Sign in to your HinGrow account securely. Access your dashboard with email/password or continue with Google." />

  <!-- Hubungkan file CSS eksternal -->
  <link rel="stylesheet" href="css/login.css">
</head>
<body>
  <!-- Kontainer utama halaman login -->
  <main class="login-container">

    <!-- Bagian logo dan judul halaman -->
    <section class="logo-section">
      <img src="images/companyLogo.png" alt="HinGrow Logo" class="logo" />
      <h1 class="login-title">Login</h1>
    </section>
    
    <!-- Form login -->
    <form class="form-container">
      <div class="form-fields">

        <!-- Input Email -->
        <div class="input-group">
          <label for="email" class="input-label">Email</label>
          <div class="input-wrapper">
            <img src="images/mailLogo.png" alt="Email Icon" class="input-icon" />
            <input type="email" id="email" class="input-field" placeholder="example@gmail.com" required />
          </div>
        </div>
        
        <!-- Input Password -->
        <div class="input-group">
          <label for="password" class="input-label">Password</label>
          <div class="input-wrapper">
            <img src="images/lockPicture.png" alt="Lock Icon" class="input-icon" />
            <input type="password" id="password" class="input-field password-field" placeholder="••••••••" required />
          </div>
        </div>
        
        <!-- Checkbox Remember me & Forgot Password -->
        <div class="remember-forgot-row">
          <div class="checkbox-wrapper">
            <input type="checkbox" id="remember" class="checkbox" />
            <label for="remember" class="checkbox-label">Remember me</label>
          </div>
          <a href="#" class="forgot-link">Forgot Password?</a>
        </div>
      </div>
      
      <!-- Tombol Sign in -->
      <button type="submit" class="sign-in-btn">Sign in</button>
    </form>
    
    <!-- Link untuk Sign Up -->
    <div class="signup-section">
      <span class="signup-text">Don't have an account yet?</span>
      <a href="/register" class="signup-link">Sign up</a>
    </div>
    
    <!-- Divider / Pemisah -->
    <div class="divider-section">
      <div class="divider-row">
        <div class="divider-line"></div>
        <span class="divider-text">Or continue with</span>
        <div class="divider-line"></div>
      </div>
      
      <!-- Tombol Sign in dengan Google -->
      <button type="button" class="google-btn">
        <img src="images/googleIcon.png" alt="Google Icon" class="google-icon" />
        Sign in with Google
      </button>
    </div>
  </main>
</body>
</html>
