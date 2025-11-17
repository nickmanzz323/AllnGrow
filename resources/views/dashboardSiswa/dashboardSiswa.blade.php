<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AllnGrow - Dashboard Siswa</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="css/dashboardSiswa.css">
</head>
<body>
  <div class="app">
    <!-- Sidebar -->
    <aside class="sidebar">
      <div class="logo">AllnGrow</div>
      <nav>
        <a class="active"><i class="fas fa-home"></i> Dashboard</a>
        <a href="myCourses"><i class="fas fa-book"></i> My Courses</a>
        <a href="schedule"><i class="fas fa-calendar"></i> Schedule</a>
        <a href="progress"><i class="fas fa-chart-line"></i> Progress</a>
        <a href="settings"><i class="fas fa-chart-line"></i> Settings</a>
        <form method="POST" action="{{ route('student.logout') }}">
            @csrf
            
            <a href="{{ route('student.logout') }}"
              onclick="event.preventDefault();
                        this.closest('form').submit();">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                Logout
            </a>
        </form>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="main">
      <!-- Header -->
      <header class="header">
        <div class="header-left">
          <h1>Welcome back, Ahmad!</h1>
          <p class="muted">Continue your learning journey with AllnGrow</p>
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

      <!-- Overview Cards -->
      <section class="overview">
        <div class="overview-card">
          <div class="card-title">Enrolled Courses</div>
          <div class="card-value">12</div>
          <div class="card-sub">Active learning paths</div>
        </div>
        <div class="overview-card">
          <div class="card-title">Completed</div>
          <div class="card-value">8</div>
          <div class="card-sub">Certificates earned</div>
        </div>
        <div class="overview-card">
          <div class="card-title">In Progress</div>
          <div class="card-value">4</div>
          <div class="card-sub">Courses ongoing</div>
        </div>
      </section>

      <!-- Courses Section -->
      <section class="section">
        <h2>My Courses</h2>
        <div class="course-grid">
          <!-- Course 1 -->
          <article class="course">
            <div class="thumb">Image</div>
            <div class="course-body">
              <h3>Web Development Fundamentals</h3>
              <p class="meta">Dr. Sarah Johnson</p>
              <div class="progress">
                <div class="progress-bar">
                  <div style="width: 65%"></div>
                </div>
                <div class="progress-num">65%</div>
              </div>
            </div>
          </article>

          <!-- Course 2 -->
          <article class="course">
            <div class="thumb">Image</div>
            <div class="course-body">
              <h3>Data Science Basics</h3>
              <p class="meta">Prof. Michael Chen</p>
              <div class="progress">
                <div class="progress-bar">
                  <div style="width: 40%"></div>
                </div>
                <div class="progress-num">40%</div>
              </div>
            </div>
          </article>

          <!-- Course 3 -->
          <article class="course">
            <div class="thumb">Image</div>
            <div class="course-body">
              <h3>UI/UX Design Principles</h3>
              <p class="meta">Emma Williams</p>
              <div class="progress">
                <div class="progress-bar">
                  <div style="width: 85%"></div>
                </div>
                <div class="progress-num">85%</div>
              </div>
            </div>
          </article>

          <!-- Course 4 -->
          <article class="course">
            <div class="thumb">Image</div>
            <div class="course-body">
              <h3>Mobile App Development</h3>
              <p class="meta">John Anderson</p>
              <div class="progress">
                <div class="progress-bar">
                  <div style="width: 30%"></div>
                </div>
                <div class="progress-num">30%</div>
              </div>
            </div>
          </article>
        </div>
      </section>
    </main>
  </div>
</body>
</html>