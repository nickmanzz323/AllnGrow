<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AllnGrow - Dashboard Siswa</title>
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
        <a class="active" href="{{ route('dashboardSiswa') }}"><i class="fas fa-home"></i> Dashboard</a>
        <a href="{{ route('student.my-courses') }}"><i class="fas fa-book"></i> My Courses</a>
        <a href="{{ route('student.browse-courses') }}"><i class="fas fa-search"></i> Browse Courses</a>
        <a href="{{ route('schedule') }}"><i class="fas fa-calendar"></i> Schedule</a>
        <a href="{{ route('progress') }}"><i class="fas fa-chart-line"></i> Progress</a>
        <a href="{{ route('settings') }}"><i class="fas fa-cog"></i> Settings</a>
        <div style="margin-top: auto; padding-top: 2rem; border-top: 1px solid #262626;">
          <form method="POST" action="{{ route('student.logout') }}" id="logout-form">
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
          <h1>Welcome back, {{ explode(' ', $student->detail->fullname ?? $student->email)[0] }}!</h1>
          <p class="muted">Continue your learning journey with AllnGrow</p>
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

      <!-- Overview Cards -->
      <section class="overview">
        <div class="overview-card">
          <div class="card-title">Enrolled Courses</div>
          <div class="card-value">{{ $totalCourses }}</div>
          <div class="card-sub">Active learning paths</div>
        </div>
        <div class="overview-card">
          <div class="card-title">Completed</div>
          <div class="card-value">{{ $completedCourses }}</div>
          <div class="card-sub">Certificates earned</div>
        </div>
        <div class="overview-card">
          <div class="card-title">Average Progress</div>
          <div class="card-value">{{ number_format($averageCompletion, 0) }}%</div>
          <div class="card-sub">Overall completion</div>
        </div>
      </section>

      <!-- Courses Section -->
      <section class="section">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
          <h2 style="margin: 0;">My Courses</h2>
          <a href="{{ route('student.browse-courses') }}" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; background: #fff; color: #000; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 0.9rem; transition: all 0.2s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
            <i class="fas fa-search"></i> Browse Courses
          </a>
        </div>
        
        @if($enrolledCourses->count() > 0)
          <div class="course-grid">
            @foreach($enrolledCourses as $course)
              <article class="course" style="cursor: {{ $course->pivot->payment_status === 'paid' ? 'pointer' : 'default' }};" onclick="@if($course->pivot->payment_status === 'paid') window.location='{{ route('student.view-course', $course->courseID ?? $course->id) }}' @endif">
                <div class="thumb" style="position: relative; overflow: hidden;">
                  @if($course->thumbnail)
                    <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="{{ $course->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                  @else
                    <i class="fas fa-book" style="font-size: 3rem; color: #404040;"></i>
                  @endif
                  @if($course->pivot->payment_status === 'pending')
                    <div style="position: absolute; top: 0.5rem; right: 0.5rem; background: #fbbf24; color: #000; padding: 0.25rem 0.5rem; border-radius: 6px; font-size: 0.7rem; font-weight: 600; white-space: nowrap; z-index: 10;">
                      Pending Payment
                    </div>
                  @endif
                </div>
                <div class="course-body">
                  <h3>{{ $course->title }}</h3>
                  <p class="meta">{{ $course->instructor->name ?? $course->instructor->email }}</p>
                  <div class="progress">
                    <div class="progress-bar">
                      <div style="width: {{ $course->pivot->completion }}%; background: #4ade80;"></div>
                    </div>
                    <div class="progress-num">{{ $course->pivot->completion }}%</div>
                  </div>
                  @if($course->pivot->payment_status === 'pending')
                    <p style="font-size: 0.8rem; color: #fbbf24; margin-top: 0.5rem;">
                      <i class="fas fa-clock"></i> Waiting for instructor confirmation
                    </p>
                  @else
                    <p style="font-size: 0.8rem; color: #4ade80; margin-top: 0.5rem;">
                      <i class="fas fa-play-circle"></i> Click to continue learning
                    </p>
                  @endif
                </div>
              </article>
            @endforeach
          </div>
        @else
          <div style="text-align: center; padding: 3rem 2rem; color: #a3a3a3;">
            <i class="fas fa-book-open" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.3;"></i>
            <p style="font-size: 1.1rem; margin-bottom: 0.5rem;">Tidak ada courses yang diambil</p>
            <p style="font-size: 0.9rem; margin-bottom: 1.5rem;">Mulai perjalanan belajar Anda dengan mendaftar courses yang tersedia</p>
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