<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Courses - AllnGrow</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/dashboardSiswa/myCourses.css') }}">
</head>
<body>
  <div class="app">
    <!-- Sidebar -->
    <aside class="sidebar">
      <div class="logo">AllnGrow</div>
      <nav>
        <a href="{{ route('dashboardSiswa') }}"><i class="fas fa-home"></i> Dashboard</a>
        <a class="active"><i class="fas fa-book"></i> My Courses</a>
        <a href="{{ route('student.browse-courses') }}"><i class="fas fa-search"></i> Browse Courses</a>
        <a href="{{ route('schedule') }}"><i class="fas fa-calendar"></i> Schedule</a>
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
          <h1>My Courses</h1>
          <p class="muted">Manage and track all your learning courses</p>
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
        <div class="alert alert-success">
          <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
      @endif

      @if(session('error'))
        <div class="alert alert-error">
          <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
        </div>
      @endif

      <!-- Filter Tabs -->
      <div class="filter-tabs">
        <button class="tab active" onclick="filterCourses('all')">All Courses ({{ $enrolledCourses->count() }})</button>
        <button class="tab" onclick="filterCourses('progress')">In Progress ({{ $enrolledCourses->where('pivot.completed', false)->count() }})</button>
        <button class="tab" onclick="filterCourses('completed')">Completed ({{ $enrolledCourses->where('pivot.completed', true)->count() }})</button>
      </div>

      <!-- Courses Grid -->
      <section class="courses-section">
        @if($enrolledCourses->count() > 0)
          <div class="course-grid">
            @foreach($enrolledCourses as $course)
              <article class="course" data-status="{{ $course->pivot->completed ? 'completed' : 'progress' }}">
                <div class="course-thumb">
                  @if($course->thumbnail)
                    <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="{{ $course->title }}">
                  @else
                    <div style="width: 100%; height: 200px; background: #1a1a1a; display: flex; align-items: center; justify-content: center;">
                      <i class="fas fa-book" style="font-size: 3rem; color: #404040;"></i>
                    </div>
                  @endif
                  
                  @if($course->pivot->payment_status === 'pending')
                    <span class="course-badge pending">Pending Payment</span>
                  @elseif($course->pivot->completed)
                    <span class="course-badge completed">Completed</span>
                  @else
                    <span class="course-badge ongoing">Ongoing</span>
                  @endif
                </div>
                <div class="course-body">
                  <div class="course-category">{{ $course->category->name ?? 'Uncategorized' }}</div>
                  <h3>{{ $course->title }}</h3>
                  <p class="course-instructor">
                    <i class="fas fa-user-circle"></i> {{ $course->instructor->name ?? $course->instructor->email }}
                  </p>
                  <div class="course-stats">
                    <span><i class="fas fa-book-open"></i> {{ $course->subcourses->count() }} Modules</span>
                    <span><i class="fas fa-users"></i> {{ $course->students->count() }} Students</span>
                  </div>
                  <div class="progress">
                    <div class="progress-bar">
                      <div style="width: {{ $course->pivot->completion }}%; background: {{ $course->pivot->payment_status === 'paid' ? '#4ade80' : '#fbbf24' }};"></div>
                    </div>
                    <div class="progress-num">{{ $course->pivot->completion }}%</div>
                  </div>
                  
                  @if($course->pivot->payment_status === 'pending')
                    <button class="btn-continue" disabled style="opacity: 0.5; cursor: not-allowed;">
                      <i class="fas fa-lock"></i> Waiting Payment Confirmation
                    </button>
                  @else
                    <a href="#" class="btn-continue">Continue Learning</a>
                  @endif
                </div>
              </article>
            @endforeach
          </div>
        @else
          <div style="text-align: center; padding: 4rem 2rem; color: #a3a3a3;">
            <i class="fas fa-book-open" style="font-size: 4rem; margin-bottom: 1rem; opacity: 0.3;"></i>
            <p style="font-size: 1.1rem; margin-bottom: 1rem;">You haven't enrolled in any courses yet</p>
            <a href="{{ route('student.browse-courses') }}" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.75rem 1.5rem; background: #fff; color: #000; text-decoration: none; border-radius: 8px; font-weight: 600; transition: all 0.2s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
              <i class="fas fa-search"></i> Browse Courses
            </a>
          </div>
        @endif
      </section>
    </main>
  </div>

  <style>
    .alert {
      padding: 1rem;
      border-radius: 8px;
      margin-bottom: 1.5rem;
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }
    .alert-success {
      background: #0d3b0d;
      border: 1px solid #1a5a1a;
      color: #4ade80;
    }
    .alert-error {
      background: #3b0d0d;
      border: 1px solid #5a1a1a;
      color: #f87171;
    }
    .course-badge.pending {
      background: #fbbf24;
      color: #000;
    }
  </style>

  <script>
    function filterCourses(status) {
      const courses = document.querySelectorAll('.course');
      const tabs = document.querySelectorAll('.tab');
      
      tabs.forEach((tab, index) => {
        tab.classList.remove('active');
        if ((status === 'all' && index === 0) || 
            (status === 'progress' && index === 1) || 
            (status === 'completed' && index === 2)) {
          tab.classList.add('active');
        }
      });
      
      courses.forEach(course => {
        if (status === 'all') {
          course.style.display = 'block';
        } else {
          course.style.display = course.dataset.status === status ? 'block' : 'none';
        }
      });
    }
    
    // Auto-dismiss alerts
    setTimeout(() => {
      document.querySelectorAll('.alert').forEach(alert => {
        alert.style.transition = 'opacity 0.3s';
        alert.style.opacity = '0';
        setTimeout(() => alert.remove(), 300);
      });
    }, 5000);
  </script>
</body>
</html>
