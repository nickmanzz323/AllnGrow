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
        <a href="{{ route('dashboardSiswa') }}"><i class="fas fa-home"></i> Dashboard</a>
        <a href="{{ route('student.my-courses') }}"><i class="fas fa-book"></i> My Courses</a>
        <a href="{{ route('student.browse-courses') }}"><i class="fas fa-search"></i> Browse Courses</a>
        <a href="{{ route('schedule') }}"><i class="fas fa-calendar"></i> Schedule</a>
        <a class="active" href="{{ route('progress') }}"><i class="fas fa-chart-line"></i> Progress</a>
        <a href="{{ route('settings') }}"><i class="fas fa-cog"></i> Settings</a>
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

      <!-- Stats Overview -->
      <section class="stats-overview">
        <div class="stat-card">
          <div class="stat-icon"><i class="fas fa-graduation-cap"></i></div>
          <div class="stat-content">
            <div class="stat-value">{{ $completedCourses }}</div>
            <div class="stat-label">Courses Completed</div>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-icon"><i class="fas fa-certificate"></i></div>
          <div class="stat-content">
            <div class="stat-value">{{ $completedCourses }}</div>
            <div class="stat-label">Certificates Earned</div>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-icon"><i class="fas fa-clock"></i></div>
          <div class="stat-content">
            <div class="stat-value">{{ $totalCourses }}</div>
            <div class="stat-label">Total Enrolled</div>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-icon"><i class="fas fa-trophy"></i></div>
          <div class="stat-content">
            <div class="stat-value">{{ count($achievements) }}</div>
            <div class="stat-label">Achievements</div>
          </div>
        </div>
      </section>

      <!-- Overall Progress -->
      <section class="section">
        <h2>Overall Progress</h2>
        @if($totalCourses > 0)
          <div class="overall-progress-card">
            <div class="progress-circle">
              @php
                $circumference = 2 * 3.14159 * 54;
                $offset = $circumference - ($averageCompletion / 100) * $circumference;
              @endphp
              <svg viewBox="0 0 120 120">
                <circle cx="60" cy="60" r="54" class="progress-bg"></circle>
                <circle cx="60" cy="60" r="54" class="progress-fill" style="stroke-dasharray: {{ $circumference - $offset }} {{ $circumference }};"></circle>
              </svg>
              <div class="progress-percent">{{ number_format($averageCompletion, 0) }}%</div>
            </div>
            <div class="progress-details">
              <h3>
                @if($averageCompletion >= 80)
                  Excellent progress!
                @elseif($averageCompletion >= 50)
                  Keep up the great work!
                @else
                  Keep learning!
                @endif
              </h3>
              <p>You've completed {{ $completedCourses }} out of {{ $totalCourses }} courses. Continue your learning journey to reach your goals.</p>
              <div class="progress-stats">
                <div class="progress-stat-item">
                  <span class="stat-num">{{ $inProgressCourses }}</span>
                  <span class="stat-text">In Progress</span>
                </div>
                <div class="progress-stat-item">
                  <span class="stat-num">{{ $completedCourses }}</span>
                  <span class="stat-text">Completed</span>
                </div>
                <div class="progress-stat-item">
                  <span class="stat-num">{{ $totalCourses }}</span>
                  <span class="stat-text">Total Courses</span>
                </div>
              </div>
            </div>
          </div>
        @else
          <div style="text-align: center; padding: 3rem 2rem; background: #0f0f0f; border-radius: 12px; color: #a3a3a3;">
            <i class="fas fa-chart-line" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.3;"></i>
            <p style="font-size: 1.1rem; margin-bottom: 0.5rem;">Tidak ada progress untuk ditampilkan</p>
            <p style="font-size: 0.9rem; margin-bottom: 1.5rem;">Mulai belajar dengan mendaftar courses yang tersedia</p>
            <a href="{{ route('student.browse-courses') }}" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.75rem 1.5rem; background: #fff; color: #000; text-decoration: none; border-radius: 8px; font-weight: 600; transition: all 0.2s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
              <i class="fas fa-search"></i> Browse Courses
            </a>
          </div>
        @endif
      </section>

      <!-- Course Progress -->
      <section class="section">
        <h2>Course Progress Details</h2>
        @if($enrolledCourses->count() > 0)
          <div class="course-progress-list">
            @foreach($enrolledCourses as $course)
              <div class="course-progress-item">
                <div class="course-info">
                  <h3>{{ $course->title }}</h3>
                  <p class="course-meta">
                    <span><i class="fas fa-user-circle"></i> {{ $course->instructor->detail->fullname ?? $course->instructor->name ?? $course->instructor->email }}</span>
                    <span><i class="fas fa-video"></i> {{ $course->subcourses->count() }} Lessons</span>
                    @if($course->pivot->completed)
                      <span style="color: #4ade80;"><i class="fas fa-check-circle"></i> Completed</span>
                    @endif
                  </p>
                </div>
                <div class="course-progress-bar">
                  <div class="progress-info">
                    <span class="progress-label">Progress</span>
                    <span class="progress-percentage">{{ $course->pivot->completion }}%</span>
                  </div>
                  <div class="progress-bar-container">
                    <div class="progress-bar-fill" style="width: {{ $course->pivot->completion }}%"></div>
                  </div>
                  @php
                    $completedLessons = ceil(($course->pivot->completion / 100) * $course->subcourses->count());
                  @endphp
                  <div class="progress-details-text">{{ $completedLessons }} of {{ $course->subcourses->count() }} lessons completed</div>
                </div>
              </div>
            @endforeach
          </div>
        @else
          <div style="text-align: center; padding: 3rem 2rem; background: #0f0f0f; border-radius: 12px; color: #a3a3a3;">
            <i class="fas fa-book-open" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.3;"></i>
            <p style="font-size: 1.1rem; margin-bottom: 0.5rem;">Tidak ada courses yang diambil</p>
            <p style="font-size: 0.9rem; margin-bottom: 1.5rem;">Daftar courses untuk melihat progress Anda</p>
            <a href="{{ route('student.browse-courses') }}" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.75rem 1.5rem; background: #fff; color: #000; text-decoration: none; border-radius: 8px; font-weight: 600; transition: all 0.2s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
              <i class="fas fa-search"></i> Browse Courses
            </a>
          </div>
        @endif
      </section>

      <!-- Recent Achievements -->
      <section class="section">
        <h2>Recent Achievements</h2>
        @if(count($achievements) > 0)
          <div class="achievements-grid">
            @foreach($achievements as $achievement)
              <div class="achievement-card">
                <div class="achievement-icon gold">
                  <i class="fas {{ $achievement['icon'] }}"></i>
                </div>
                <h3>{{ $achievement['title'] }}</h3>
                <p>{{ $achievement['description'] }}</p>
                @if($achievement['date'])
                  <span class="achievement-date">{{ \Carbon\Carbon::parse($achievement['date'])->format('M d, Y') }}</span>
                @endif
              </div>
            @endforeach
          </div>
        @else
          <div style="text-align: center; padding: 3rem 2rem; background: #0f0f0f; border-radius: 12px; color: #a3a3a3;">
            <i class="fas fa-trophy" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.3;"></i>
            <p style="font-size: 1.1rem; margin-bottom: 0.5rem;">Belum ada achievements</p>
            <p style="font-size: 0.9rem; margin-bottom: 1.5rem;">Selesaikan courses untuk mendapatkan achievements</p>
            <a href="{{ route('student.browse-courses') }}" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.75rem 1.5rem; background: #fff; color: #000; text-decoration: none; border-radius: 8px; font-weight: 600; transition: all 0.2s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
              <i class="fas fa-search"></i> Browse Courses
            </a>
          </div>
        @endif
      </section>

    </main>
  </div>
</body>
</html>