<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Schedule - AllnGrow</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="css/dashboardSiswa/schedule.css">
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
        <a class="active" href="{{ route('schedule') }}"><i class="fas fa-calendar"></i> Schedule</a>
        <a href="{{ route('progress') }}"><i class="fas fa-chart-line"></i> Progress</a>
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
          <h1>My Schedule</h1>
          <p class="muted">Manage your classes and learning sessions</p>
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

      <!-- Calendar Header -->
      <div class="calendar-header">
        <div class="calendar-nav">
          <button class="nav-btn"><i class="fas fa-chevron-left"></i></button>
          <h2 class="current-month">{{ date('F Y') }}</h2>
          <button class="nav-btn"><i class="fas fa-chevron-right"></i></button>
        </div>
        <button class="btn-today">Today</button>
      </div>

      <!-- Week Days -->
      <div class="week-days">
        <div class="day-label">Mon</div>
        <div class="day-label">Tue</div>
        <div class="day-label">Wed</div>
        <div class="day-label">Thu</div>
        <div class="day-label">Fri</div>
        <div class="day-label">Sat</div>
        <div class="day-label">Sun</div>
      </div>

      <!-- Calendar Grid -->
      <div class="calendar-grid">
        @php
          $today = date('j');
          $month = date('n');
          $year = date('Y');
          $firstDay = mktime(0, 0, 0, $month, 1, $year);
          $daysInMonth = date('t', $firstDay);
          $dayOfWeek = date('N', $firstDay);

          // Previous month days
          $prevMonth = $month == 1 ? 12 : $month - 1;
          $prevYear = $month == 1 ? $year - 1 : $year;
          $daysInPrevMonth = date('t', mktime(0, 0, 0, $prevMonth, 1, $prevYear));

          // Print previous month days
          for ($i = $dayOfWeek - 1; $i > 0; $i--) {
            echo '<div class="day other-month">' . ($daysInPrevMonth - $i + 1) . '</div>';
          }

          // Print current month days
          for ($day = 1; $day <= $daysInMonth; $day++) {
            $class = 'day';
            if ($day == $today) {
              $class .= ' today';
            }
            if ($enrolledCourses->count() > 0) {
              $class .= ' has-event';
            }
            echo '<div class="' . $class . '">' . $day;
            if ($enrolledCourses->count() > 0) {
              echo '<div class="event-dot"></div>';
            }
            echo '</div>';
          }

          // Fill remaining cells with next month days
          $remainingCells = 42 - ($dayOfWeek - 1 + $daysInMonth);
          for ($i = 1; $i <= $remainingCells; $i++) {
            echo '<div class="day other-month">' . $i . '</div>';
          }
        @endphp
      </div>

      <!-- Upcoming Classes -->
      <section class="section">
        <h2>My Enrolled Courses</h2>

        @if($enrolledCourses->count() > 0)
          <div class="timeline">
            @foreach($enrolledCourses as $index => $course)
              <div class="timeline-item">
                <div class="timeline-date">
                  <div class="date-day">{{ date('d', strtotime($course->pivot->created_at)) }}</div>
                  <div class="date-info">
                    <div class="date-month">{{ date('M', strtotime($course->pivot->created_at)) }}</div>
                    <div class="date-label">Enrolled</div>
                  </div>
                </div>

                <div class="timeline-events">
                  <div class="event-card">
                    <div class="event-time">
                      <i class="fas fa-clock"></i>
                      @if($course->subcourses->count() > 0)
                        {{ $course->subcourses->count() }} Lessons
                      @else
                        No lessons yet
                      @endif
                    </div>
                    <div class="event-content">
                      <h3>{{ $course->title }}</h3>
                      <p class="event-instructor">
                        <i class="fas fa-user-circle"></i> {{ $course->instructor->detail->fullname ?? $course->instructor->name ?? $course->instructor->email }}
                      </p>
                      <div class="event-meta">
                        <span><i class="fas fa-book"></i> {{ $course->category->name ?? 'General' }}</span>
                        <span><i class="fas fa-chart-line"></i> {{ $course->pivot->completion }}% Complete</span>
                      </div>
                      <div style="margin-top: 0.75rem;">
                        <div style="background: #1a1a1a; border-radius: 8px; height: 8px; overflow: hidden;">
                          <div style="width: {{ $course->pivot->completion }}%; background: #4ade80; height: 100%; transition: width 0.3s;"></div>
                        </div>
                      </div>
                    </div>
                    <a href="{{ route('student.view-course', $course->courseID) }}" class="btn-join" style="text-decoration: none; display: flex; align-items: center; justify-content: center;">
                      @if($course->pivot->completed)
                        <i class="fas fa-check-circle"></i> Review
                      @else
                        <i class="fas fa-play"></i> Continue
                      @endif
                    </a>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        @else
          <div style="text-align: center; padding: 3rem 2rem; color: #a3a3a3;">
            <i class="fas fa-calendar-times" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.3;"></i>
            <p style="font-size: 1.1rem; margin-bottom: 0.5rem;">Tidak ada courses yang diambil</p>
            <p style="font-size: 0.9rem; margin-bottom: 1.5rem;">Mulai belajar dengan mendaftar courses yang tersedia</p>
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