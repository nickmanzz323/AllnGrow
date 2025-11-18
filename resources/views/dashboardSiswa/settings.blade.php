<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Settings - AllnGrow</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/dashboardSiswa/dashboardSiswa.css') }}">
</head>
<body>
  <div class="app">
    <!-- Sidebar -->
    <aside class="sidebar">
      <div class="logo">AllnGrow</div>
      <nav>
        <a href="{{ route('dashboardSiswa') }}"><i class="fas fa-home"></i> Dashboard</a>
        <a href="{{ route('student.my-courses') }}"><i class="fas fa-book"></i> My Courses</a>
        <a href="{{ route('student.browse-courses') }}"><i class="fas fa-search"></i> Browse Courses</a>
        <a href="{{ route('schedule') }}"><i class="fas fa-calendar"></i> Schedule</a>
        <a href="{{ route('progress') }}"><i class="fas fa-chart-line"></i> Progress</a>
        <a class="active"><i class="fas fa-cog"></i> Settings</a>
        <div style="margin-top: auto; padding-top: 2rem; border-top: 1px solid #262626;">
          <form method="POST" action="{{ route('student.logout') }}">
            @csrf
            <button type="submit" style="width: 100%; text-align: left; background: none; border: none; color: #f5f5f5; cursor: pointer; font: inherit; padding: 0.75rem 1rem; display: flex; align-items: center; gap: 0.75rem; transition: all 0.2s; border-radius: 8px;" onmouseover="this.style.background='#1a1a1a'; this.style.color='#ef4444'" onmouseout="this.style.background=''; this.style.color='#f5f5f5'">
              <i class="fas fa-sign-out-alt"></i> Logout
            </button>
          </form>
        </div>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="main">
      <!-- Header -->
      <header class="header">
        <div class="header-left">
          <h1>Settings</h1>
          <p class="muted">Manage your account and preferences</p>
        </div>
        <div class="header-right">
          <button class="icon-btn"><i class="fas fa-bell"></i></button>
          <div class="user">
            <div class="user-avatar">
              @php
                $name = $student->detail->fullname ?? $student->email;
                $words = explode(' ', $name);
                $initials = '';
                foreach(array_slice($words, 0, 2) as $word) {
                  $initials .= strtoupper(substr($word, 0, 1));
                }
                echo $initials;
              @endphp
            </div>
            <div class="user-info">
              <div class="user-name">{{ $student->detail->fullname ?? 'Student' }}</div>
              <div class="user-role">Student</div>
            </div>
          </div>
        </div>
      </header>

      @if(session('success'))
        <div style="padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.75rem; background: #0d3b0d; border: 1px solid #1a5a1a; color: #4ade80;">
          <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
      @endif

      @if(session('error'))
        <div style="padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.75rem; background: #3b0d0d; border: 1px solid #5a1a1a; color: #f87171;">
          <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
        </div>
      @endif

      @if($errors->any())
        <div style="padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; background: #3b0d0d; border: 1px solid #5a1a1a; color: #f87171;">
          <ul style="margin: 0; padding-left: 1.5rem;">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <!-- Settings Sections -->
      <section class="section">
        <!-- Profile Information -->
        <div style="background: #0d0d0d; border: 1px solid #262626; border-radius: 12px; padding: 1.5rem; margin-bottom: 1.5rem;">
          <h2 style="font-size: 1.25rem; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
            <i class="fas fa-user"></i> Profile Information
          </h2>
          <form method="POST" action="{{ route('student.update-profile') }}">
            @csrf
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
              <div>
                <label style="display: block; margin-bottom: 0.5rem; color: #a3a3a3; font-size: 0.9rem;">Full Name</label>
                <input type="text" name="fullname" value="{{ $student->detail->fullname ?? '' }}" required style="width: 100%; padding: 0.75rem; background: #000; border: 1px solid #262626; border-radius: 8px; color: #f5f5f5;">
              </div>
              <div>
                <label style="display: block; margin-bottom: 0.5rem; color: #a3a3a3; font-size: 0.9rem;">Phone</label>
                <input type="text" name="phone" value="{{ $student->detail->phone ?? '' }}" required style="width: 100%; padding: 0.75rem; background: #000; border: 1px solid #262626; border-radius: 8px; color: #f5f5f5;">
              </div>
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
              <div>
                <label style="display: block; margin-bottom: 0.5rem; color: #a3a3a3; font-size: 0.9rem;">Gender</label>
                <select name="gender" required style="width: 100%; padding: 0.75rem; background: #000; border: 1px solid #262626; border-radius: 8px; color: #f5f5f5; cursor: pointer;">
                  <option value="male" {{ ($student->detail->gender ?? '') == 'male' ? 'selected' : '' }}>Male</option>
                  <option value="female" {{ ($student->detail->gender ?? '') == 'female' ? 'selected' : '' }}>Female</option>
                </select>
              </div>
              <div>
                <label style="display: block; margin-bottom: 0.5rem; color: #a3a3a3; font-size: 0.9rem;">Date of Birth</label>
                <input type="date" name="dob" value="{{ $student->detail->dob ?? '' }}" required style="width: 100%; padding: 0.75rem; background: #000; border: 1px solid #262626; border-radius: 8px; color: #f5f5f5;">
              </div>
            </div>
            <div style="margin-bottom: 1rem;">
              <label style="display: block; margin-bottom: 0.5rem; color: #a3a3a3; font-size: 0.9rem;">Country</label>
              <input type="text" name="country" value="{{ $student->detail->country ?? '' }}" required style="width: 100%; padding: 0.75rem; background: #000; border: 1px solid #262626; border-radius: 8px; color: #f5f5f5;">
            </div>
            <div>
              <label style="display: block; margin-bottom: 0.5rem; color: #a3a3a3; font-size: 0.9rem;">Email</label>
              <input type="email" value="{{ $student->email }}" disabled style="width: 100%; padding: 0.75rem; background: #1a1a1a; border: 1px solid #262626; border-radius: 8px; color: #737373; cursor: not-allowed;">
              <small style="color: #737373; font-size: 0.85rem;">Email cannot be changed</small>
            </div>
            <button type="submit" style="margin-top: 1rem; padding: 0.75rem 1.5rem; background: #fff; color: #000; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; transition: all 0.2s;">
              <i class="fas fa-save"></i> Save Changes
            </button>
          </form>
        </div>

        <!-- Change Password -->
        <div style="background: #0d0d0d; border: 1px solid #262626; border-radius: 12px; padding: 1.5rem; margin-bottom: 1.5rem;">
          <h2 style="font-size: 1.25rem; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
            <i class="fas fa-lock"></i> Change Password
          </h2>
          <form method="POST" action="{{ route('student.update-password') }}">
            @csrf
            <div style="margin-bottom: 1rem;">
              <label style="display: block; margin-bottom: 0.5rem; color: #a3a3a3; font-size: 0.9rem;">Current Password</label>
              <input type="password" name="current_password" required style="width: 100%; padding: 0.75rem; background: #000; border: 1px solid #262626; border-radius: 8px; color: #f5f5f5;">
            </div>
            <div style="margin-bottom: 1rem;">
              <label style="display: block; margin-bottom: 0.5rem; color: #a3a3a3; font-size: 0.9rem;">New Password</label>
              <input type="password" name="new_password" required minlength="8" style="width: 100%; padding: 0.75rem; background: #000; border: 1px solid #262626; border-radius: 8px; color: #f5f5f5;">
              <small style="color: #737373; font-size: 0.85rem;">Minimum 8 characters</small>
            </div>
            <div style="margin-bottom: 1rem;">
              <label style="display: block; margin-bottom: 0.5rem; color: #a3a3a3; font-size: 0.9rem;">Confirm New Password</label>
              <input type="password" name="new_password_confirmation" required minlength="8" style="width: 100%; padding: 0.75rem; background: #000; border: 1px solid #262626; border-radius: 8px; color: #f5f5f5;">
            </div>
            <button type="submit" style="padding: 0.75rem 1.5rem; background: #fff; color: #000; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; transition: all 0.2s;">
              <i class="fas fa-key"></i> Update Password
            </button>
          </form>
        </div>

        <!-- Delete Account -->
        <div style="background: #3b0d0d; border: 1px solid #5a1a1a; border-radius: 12px; padding: 1.5rem;">
          <h2 style="font-size: 1.25rem; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.5rem; color: #f87171;">
            <i class="fas fa-exclamation-triangle"></i> Danger Zone
          </h2>
          <p style="color: #f87171; margin-bottom: 1rem;">Once you delete your account, there is no going back. Please be certain.</p>
          <button onclick="document.getElementById('deleteModal').style.display='flex'" style="padding: 0.75rem 1.5rem; background: #ef4444; color: #fff; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; transition: all 0.2s;">
            <i class="fas fa-trash"></i> Delete Account
          </button>
        </div>
      </section>
    </main>
  </div>

  <!-- Delete Confirmation Modal -->
  <div id="deleteModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); align-items: center; justify-content: center; z-index: 1000;">
    <div style="background: #0d0d0d; border: 1px solid #262626; border-radius: 12px; padding: 2rem; max-width: 500px; width: 90%;">
      <h3 style="font-size: 1.5rem; margin-bottom: 1rem; color: #f87171;">
        <i class="fas fa-exclamation-triangle"></i> Delete Account
      </h3>
      <p style="color: #a3a3a3; margin-bottom: 1rem;">This action cannot be undone. All your data, courses, and progress will be permanently deleted.</p>
      <form method="POST" action="{{ route('student.delete-account') }}">
        @csrf
        <div style="margin-bottom: 1rem;">
          <label style="display: block; margin-bottom: 0.5rem; color: #a3a3a3; font-size: 0.9rem;">Enter your password to confirm</label>
          <input type="password" name="password" required style="width: 100%; padding: 0.75rem; background: #000; border: 1px solid #262626; border-radius: 8px; color: #f5f5f5;">
        </div>
        <div style="display: flex; gap: 0.75rem; justify-content: flex-end;">
          <button type="button" onclick="document.getElementById('deleteModal').style.display='none'" style="padding: 0.75rem 1.5rem; background: #262626; color: #f5f5f5; border: none; border-radius: 8px; font-weight: 600; cursor: pointer;">
            Cancel
          </button>
          <button type="submit" style="padding: 0.75rem 1.5rem; background: #ef4444; color: #fff; border: none; border-radius: 8px; font-weight: 600; cursor: pointer;">
            Yes, Delete My Account
          </button>
        </div>
      </form>
    </div>
  </div>

  <script>
    // Auto-dismiss alerts
    setTimeout(() => {
      document.querySelectorAll('[style*="background: #0d3b0d"], [style*="background: #3b0d0d"]').forEach(alert => {
        if (!alert.closest('#deleteModal')) {
          alert.style.transition = 'opacity 0.3s';
          alert.style.opacity = '0';
          setTimeout(() => alert.remove(), 300);
        }
      });
    }, 5000);

    // Close modal when clicking outside
    document.getElementById('deleteModal').addEventListener('click', function(e) {
      if (e.target === this) {
        this.style.display = 'none';
      }
    });
  </script>
</body>
</html>
