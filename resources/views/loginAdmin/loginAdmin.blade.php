<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login | AllnGrow</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="css/loginAdmin/admin-login.css">
</head>
<body>
  <!-- Animated Background -->
  <div class="animated-background">
    <div class="gradient-orb orb-1"></div>
    <div class="gradient-orb orb-2"></div>
    <div class="gradient-orb orb-3"></div>
    <div class="grid-overlay"></div>
  </div>

  <!-- Login Container -->
  <main class="login-container">
    <div class="login-card">
      <!-- Logo Section -->
      <div class="logo-section">
        <div class="logo-wrapper">
          <div class="logo-icon">
            <i class="fas fa-shield-alt"></i>
          </div>
          <h1 class="logo-text">AllnGrow</h1>
        </div>
        <span class="admin-badge">Admin Panel</span>
      </div>

      <!-- Title -->
      <div class="title-section">
        <h2>Welcome Back</h2>
        <p>Sign in to access the admin dashboard</p>
      </div>

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
        <div style="background:#f8d7da;border:1px solid #f5c6cb;color:#721c24;padding:12px;margin:12px 0;border-radius:4px;">
          <ul style="margin:0;padding-left:20px;">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <!-- Login Form -->
      <form class="login-form" method="POST" action="{{ route('admin.login.post') }}">
        @csrf
        <!-- Email Input -->
        <div class="input-group">
          <label for="email">Email Address</label>
          <div class="input-wrapper">
            <i class="fas fa-envelope input-icon"></i>
            <input 
              type="email" 
              id="email" 
              name="email" 
              placeholder="admin@allngrow.com" 
              required 
              autocomplete="email"
              value="{{ old('email') }}"
            >
          </div>
        </div>

        <!-- Password Input -->
        <div class="input-group">
          <label for="password">Password</label>
          <div class="input-wrapper">
            <i class="fas fa-lock input-icon"></i>
            <input 
              type="password" 
              id="password" 
              name="password" 
              placeholder="••••••••" 
              required 
              autocomplete="current-password"
            >
            <button type="button" class="toggle-password" onclick="togglePassword()">
              <i class="fas fa-eye" id="toggleIcon"></i>
            </button>
          </div>
        </div>

        <!-- Remember & Forgot -->
        <div class="form-options">
          <label class="checkbox-label">
            <input type="checkbox" name="remember">
            <span class="checkmark"></span>
            <span class="label-text">Remember me</span>
          </label>
          <a href="#" class="forgot-link">Forgot Password?</a>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn-login">
          <span>Sign In</span>
          <i class="fas fa-arrow-right"></i>
        </button>
      </form>

      <!-- Security Notice -->
      <div class="security-notice">
        <i class="fas fa-info-circle"></i>
        <span>This is a secure admin area. All activities are monitored and logged.</span>
      </div>
    </div>

    <!-- Footer -->
    <footer class="login-footer">
      <p>&copy; 2025 AllnGrow. All rights reserved.</p>
      <div class="footer-links">
        <a href="#">Privacy Policy</a>
        <span>•</span>
        <a href="#">Terms of Service</a>
      </div>
    </footer>
  </main>

  <script>
    // Toggle password visibility
    function togglePassword() {
      const passwordInput = document.getElementById('password');
      const toggleIcon = document.getElementById('toggleIcon');
      
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
      } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
      }
    }

    // Form submission
    document.querySelector('.login-form').addEventListener('submit', (e) => {
      e.preventDefault();
      // Add your login logic here
      console.log('Form submitted');
    });

    // Add floating animation to orbs
    const orbs = document.querySelectorAll('.gradient-orb');
    orbs.forEach((orb, index) => {
      orb.style.animationDelay = `${index * 2}s`;
    });
  </script>
</body>
</html>