<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Settings - AllnGrow</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="css/dashboardSiswa/settings.css">
</head>
<body>
  <div class="app">
    <!-- Sidebar -->
    <aside class="sidebar">
      <div class="logo">AllnGrow</div>
      <nav>
        <a href="dashboardSiswa"><i class="fas fa-home"></i> Dashboard</a>
        <a href="myCourses"><i class="fas fa-book"></i> My Courses</a>
        <a href="schedule"><i class="fas fa-calendar"></i> Schedule</a>
        <a href="progress"><i class="fas fa-chart-line"></i> Progress</a>
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
            <div class="user-avatar">AR</div>
            <div class="user-info">
              <div class="user-name">Ahmad Rizki</div>
              <div class="user-role">Student</div>
            </div>
          </div>
        </div>
      </header>

      <!-- Settings Tabs -->
      <div class="settings-tabs">
        <button class="tab active" data-tab="profile">
          <i class="fas fa-user"></i> Profile
        </button>
        <button class="tab" data-tab="account">
          <i class="fas fa-shield-alt"></i> Account
        </button>
        <button class="tab" data-tab="notifications">
          <i class="fas fa-bell"></i> Notifications
        </button>
        <button class="tab" data-tab="preferences">
          <i class="fas fa-sliders-h"></i> Preferences
        </button>
      </div>

      <!-- Profile Settings -->
      <div class="tab-content active" id="profile">
        <section class="settings-section">
          <h2>Profile Information</h2>
          
          <div class="profile-photo-section">
            <div class="profile-photo">
              <div class="photo-placeholder">AR</div>
              <button class="photo-edit-btn">
                <i class="fas fa-camera"></i>
              </button>
            </div>
            <div class="photo-info">
              <h3>Profile Photo</h3>
              <p>Upload a new profile photo or avatar</p>
              <button class="btn-secondary">Change Photo</button>
            </div>
          </div>

          <div class="form-grid">
            <div class="form-group">
              <label>Full Name</label>
              <input type="text" value="Ahmad Rizki" placeholder="Enter your full name">
            </div>

            <div class="form-group">
              <label>Email Address</label>
              <input type="email" value="ahmad.rizki@example.com" placeholder="Enter your email">
            </div>

            <div class="form-group">
              <label>Phone Number</label>
              <input type="tel" value="+62 812 3456 7890" placeholder="Enter your phone number">
            </div>

            <div class="form-group">
              <label>Student ID</label>
              <input type="text" value="STD-2024-001" placeholder="Student ID" disabled>
            </div>

            <div class="form-group full-width">
              <label>Bio</label>
              <textarea rows="4" placeholder="Tell us about yourself">Passionate learner interested in web development and data science.</textarea>
            </div>
          </div>

          <div class="form-actions">
            <button class="btn-primary">Save Changes</button>
            <button class="btn-secondary">Cancel</button>
          </div>
        </section>
      </div>

      <!-- Account Settings -->
      <div class="tab-content" id="account">
        <section class="settings-section">
          <h2>Account Security</h2>
          
          <div class="security-item">
            <div class="security-info">
              <h3>Password</h3>
              <p>Last changed 30 days ago</p>
            </div>
            <button class="btn-secondary">Change Password</button>
          </div>

          <div class="security-item">
            <div class="security-info">
              <h3>Two-Factor Authentication</h3>
              <p>Add an extra layer of security to your account</p>
            </div>
            <label class="toggle">
              <input type="checkbox">
              <span class="toggle-slider"></span>
            </label>
          </div>

          <div class="security-item">
            <div class="security-info">
              <h3>Active Sessions</h3>
              <p>Manage devices where you're logged in</p>
            </div>
            <button class="btn-secondary">View Sessions</button>
          </div>
        </section>

        <section class="settings-section">
          <h2>Connected Accounts</h2>
          
          <div class="connected-account">
            <div class="account-icon google">
              <i class="fab fa-google"></i>
            </div>
            <div class="account-info">
              <h3>Google</h3>
              <p>Connected</p>
            </div>
            <button class="btn-disconnect">Disconnect</button>
          </div>

          <div class="connected-account">
            <div class="account-icon github">
              <i class="fab fa-github"></i>
            </div>
            <div class="account-info">
              <h3>GitHub</h3>
              <p>Not connected</p>
            </div>
            <button class="btn-secondary">Connect</button>
          </div>
        </section>

        <section class="settings-section danger-zone">
          <h2>Danger Zone</h2>
          <div class="danger-item">
            <div class="danger-info">
              <h3>Delete Account</h3>
              <p>Permanently delete your account and all data</p>
            </div>
            <button class="btn-danger">Delete Account</button>
          </div>
        </section>
      </div>

      <!-- Notifications Settings -->
      <div class="tab-content" id="notifications">
        <section class="settings-section">
          <h2>Email Notifications</h2>
          
          <div class="notification-item">
            <div class="notification-info">
              <h3>Course Updates</h3>
              <p>Receive emails about new course content and updates</p>
            </div>
            <label class="toggle">
              <input type="checkbox" checked>
              <span class="toggle-slider"></span>
            </label>
          </div>

          <div class="notification-item">
            <div class="notification-info">
              <h3>Assignment Reminders</h3>
              <p>Get reminded about upcoming assignments and deadlines</p>
            </div>
            <label class="toggle">
              <input type="checkbox" checked>
              <span class="toggle-slider"></span>
            </label>
          </div>

          <div class="notification-item">
            <div class="notification-info">
              <h3>Weekly Progress Report</h3>
              <p>Receive weekly summary of your learning progress</p>
            </div>
            <label class="toggle">
              <input type="checkbox" checked>
              <span class="toggle-slider"></span>
            </label>
          </div>

          <div class="notification-item">
            <div class="notification-info">
              <h3>Marketing Emails</h3>
              <p>Receive promotional content and special offers</p>
            </div>
            <label class="toggle">
              <input type="checkbox">
              <span class="toggle-slider"></span>
            </label>
          </div>
        </section>

        <section class="settings-section">
          <h2>Push Notifications</h2>
          
          <div class="notification-item">
            <div class="notification-info">
              <h3>Live Session Alerts</h3>
              <p>Notify when a live session is about to start</p>
            </div>
            <label class="toggle">
              <input type="checkbox" checked>
              <span class="toggle-slider"></span>
            </label>
          </div>

          <div class="notification-item">
            <div class="notification-info">
              <h3>Messages and Comments</h3>
              <p>Get notified about new messages and comments</p>
            </div>
            <label class="toggle">
              <input type="checkbox" checked>
              <span class="toggle-slider"></span>
            </label>
          </div>
        </section>
      </div>

      <!-- Preferences Settings -->
      <div class="tab-content" id="preferences">
        <section class="settings-section">
          <h2>Display Settings</h2>
          
          <div class="form-group">
            <label>Language</label>
            <select>
              <option>English</option>
              <option selected>Bahasa Indonesia</option>
              <option>日本語</option>
            </select>
          </div>

          <div class="form-group">
            <label>Timezone</label>
            <select>
              <option selected>Asia/Jakarta (GMT+7)</option>
              <option>Asia/Singapore (GMT+8)</option>
              <option>Asia/Tokyo (GMT+9)</option>
            </select>
          </div>

          <div class="notification-item">
            <div class="notification-info">
              <h3>Dark Mode</h3>
              <p>Switch to dark theme for better viewing at night</p>
            </div>
            <label class="toggle">
              <input type="checkbox">
              <span class="toggle-slider"></span>
            </label>
          </div>
        </section>

        <section class="settings-section">
          <h2>Learning Preferences</h2>
          
          <div class="form-group">
            <label>Video Playback Speed</label>
            <select>
              <option>0.5x</option>
              <option>0.75x</option>
              <option selected>1x (Normal)</option>
              <option>1.25x</option>
              <option>1.5x</option>
              <option>2x</option>
            </select>
          </div>

          <div class="form-group">
            <label>Subtitle Language</label>
            <select>
              <option selected>English</option>
              <option>Bahasa Indonesia</option>
              <option>None</option>
            </select>
          </div>

          <div class="notification-item">
            <div class="notification-info">
              <h3>Auto-play Next Video</h3>
              <p>Automatically play the next video when current video ends</p>
            </div>
            <label class="toggle">
              <input type="checkbox" checked>
              <span class="toggle-slider"></span>
            </label>
          </div>

          <div class="notification-item">
            <div class="notification-info">
              <h3>Download Quality</h3>
              <p>Choose default quality for downloading course videos</p>
            </div>
            <select class="inline-select">
              <option>720p</option>
              <option selected>1080p</option>
              <option>Auto</option>
            </select>
          </div>
        </section>
      </div>

    </main>
  </div>

  <script>
    // Tab switching functionality
    const tabs = document.querySelectorAll('.tab');
    const tabContents = document.querySelectorAll('.tab-content');

    tabs.forEach(tab => {
      tab.addEventListener('click', () => {
        const targetTab = tab.dataset.tab;
        
        // Remove active class from all tabs and contents
        tabs.forEach(t => t.classList.remove('active'));
        tabContents.forEach(tc => tc.classList.remove('active'));
        
        // Add active class to clicked tab and corresponding content
        tab.classList.add('active');
        document.getElementById(targetTab).classList.add('active');
      });
    });
  </script>
</body>
</html>