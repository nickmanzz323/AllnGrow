<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Progress - AllnGrow</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="css/dashboardSiswa/progress.css">
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
        <a class="active"><i class="fas fa-chart-line"></i> Progress</a>
        <a href="settings"><i class="fas fa-cog"></i> Settings</a>
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
          <h1>Learning Progress</h1>
          <p class="muted">Track your learning journey and achievements</p>
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

      <!-- Stats Overview -->
      <section class="stats-overview">
        <div class="stat-card">
          <div class="stat-icon"><i class="fas fa-graduation-cap"></i></div>
          <div class="stat-content">
            <div class="stat-value">8</div>
            <div class="stat-label">Courses Completed</div>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-icon"><i class="fas fa-certificate"></i></div>
          <div class="stat-content">
            <div class="stat-value">8</div>
            <div class="stat-label">Certificates Earned</div>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-icon"><i class="fas fa-clock"></i></div>
          <div class="stat-content">
            <div class="stat-value">124h</div>
            <div class="stat-label">Total Learning Time</div>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-icon"><i class="fas fa-trophy"></i></div>
          <div class="stat-content">
            <div class="stat-value">15</div>
            <div class="stat-label">Achievements</div>
          </div>
        </div>
      </section>

      <!-- Overall Progress -->
      <section class="section">
        <h2>Overall Progress</h2>
        <div class="overall-progress-card">
          <div class="progress-circle">
            <svg viewBox="0 0 120 120">
              <circle cx="60" cy="60" r="54" class="progress-bg"></circle>
              <circle cx="60" cy="60" r="54" class="progress-fill" style="stroke-dasharray: 230 339;"></circle>
            </svg>
            <div class="progress-percent">68%</div>
          </div>
          <div class="progress-details">
            <h3>Keep up the great work!</h3>
            <p>You've completed 8 out of 12 courses. Continue your learning journey to reach your goals.</p>
            <div class="progress-stats">
              <div class="progress-stat-item">
                <span class="stat-num">4</span>
                <span class="stat-text">In Progress</span>
              </div>
              <div class="progress-stat-item">
                <span class="stat-num">8</span>
                <span class="stat-text">Completed</span>
              </div>
              <div class="progress-stat-item">
                <span class="stat-num">12</span>
                <span class="stat-text">Total Courses</span>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Course Progress -->
      <section class="section">
        <h2>Course Progress Details</h2>
        <div class="course-progress-list">
          
          <!-- Course Item 1 -->
          <div class="course-progress-item">
            <div class="course-info">
              <h3>Web Development Fundamentals</h3>
              <p class="course-meta">
                <span><i class="fas fa-user-circle"></i> Dr. Sarah Johnson</span>
                <span><i class="fas fa-video"></i> 24 Videos</span>
                <span><i class="fas fa-clock"></i> 12h 30m</span>
              </p>
            </div>
            <div class="course-progress-bar">
              <div class="progress-info">
                <span class="progress-label">Progress</span>
                <span class="progress-percentage">65%</span>
              </div>
              <div class="progress-bar-container">
                <div class="progress-bar-fill" style="width: 65%"></div>
              </div>
              <div class="progress-details-text">16 of 24 videos completed</div>
            </div>
          </div>

          <!-- Course Item 2 -->
          <div class="course-progress-item">
            <div class="course-info">
              <h3>Data Science Basics</h3>
              <p class="course-meta">
                <span><i class="fas fa-user-circle"></i> Prof. Michael Chen</span>
                <span><i class="fas fa-video"></i> 32 Videos</span>
                <span><i class="fas fa-clock"></i> 18h 45m</span>
              </p>
            </div>
            <div class="course-progress-bar">
              <div class="progress-info">
                <span class="progress-label">Progress</span>
                <span class="progress-percentage">40%</span>
              </div>
              <div class="progress-bar-container">
                <div class="progress-bar-fill" style="width: 40%"></div>
              </div>
              <div class="progress-details-text">13 of 32 videos completed</div>
            </div>
          </div>

          <!-- Course Item 3 -->
          <div class="course-progress-item">
            <div class="course-info">
              <h3>UI/UX Design Principles</h3>
              <p class="course-meta">
                <span><i class="fas fa-user-circle"></i> Emma Williams</span>
                <span><i class="fas fa-video"></i> 28 Videos</span>
                <span><i class="fas fa-clock"></i> 15h 20m</span>
              </p>
            </div>
            <div class="course-progress-bar">
              <div class="progress-info">
                <span class="progress-label">Progress</span>
                <span class="progress-percentage">85%</span>
              </div>
              <div class="progress-bar-container">
                <div class="progress-bar-fill" style="width: 85%"></div>
              </div>
              <div class="progress-details-text">24 of 28 videos completed</div>
            </div>
          </div>

          <!-- Course Item 4 -->
          <div class="course-progress-item">
            <div class="course-info">
              <h3>Mobile App Development</h3>
              <p class="course-meta">
                <span><i class="fas fa-user-circle"></i> John Anderson</span>
                <span><i class="fas fa-video"></i> 36 Videos</span>
                <span><i class="fas fa-clock"></i> 20h 15m</span>
              </p>
            </div>
            <div class="course-progress-bar">
              <div class="progress-info">
                <span class="progress-label">Progress</span>
                <span class="progress-percentage">30%</span>
              </div>
              <div class="progress-bar-container">
                <div class="progress-bar-fill" style="width: 30%"></div>
              </div>
              <div class="progress-details-text">11 of 36 videos completed</div>
            </div>
          </div>

        </div>
      </section>

      <!-- Recent Achievements -->
      <section class="section">
        <h2>Recent Achievements</h2>
        <div class="achievements-grid">
          
          <div class="achievement-card">
            <div class="achievement-icon gold">
              <i class="fas fa-trophy"></i>
            </div>
            <h3>First Course Completed</h3>
            <p>Completed your first course successfully</p>
            <span class="achievement-date">Oct 15, 2024</span>
          </div>

          <div class="achievement-card">
            <div class="achievement-icon silver">
              <i class="fas fa-fire"></i>
            </div>
            <h3>7 Day Streak</h3>
            <p>Learned for 7 consecutive days</p>
            <span class="achievement-date">Nov 10, 2024</span>
          </div>

          <div class="achievement-card">
            <div class="achievement-icon bronze">
              <i class="fas fa-star"></i>
            </div>
            <h3>Fast Learner</h3>
            <p>Completed 3 courses in one month</p>
            <span class="achievement-date">Nov 1, 2024</span>
          </div>

          <div class="achievement-card">
            <div class="achievement-icon gold">
              <i class="fas fa-medal"></i>
            </div>
            <h3>Certificate Master</h3>
            <p>Earned 5 certificates</p>
            <span class="achievement-date">Oct 28, 2024</span>
          </div>

        </div>
      </section>

    </main>
  </div>
</body>
</html>