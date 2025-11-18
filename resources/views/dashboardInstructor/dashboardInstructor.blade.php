<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AllnGrow - Instructor Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="css/dashboardInstructor/dashboardInstructor.css">
</head>
<body>
  <div class="app">
    <!-- Sidebar -->
    <aside class="sidebar">
      <div class="logo">AllnGrow</div>
      <nav>
        <a href="{{ route('dashboardinstructor') }}" class="nav-link active">
          <i class="fas fa-home"></i> Dashboard
        </a>
        <a href="{{ route('instructor.myCourses') }}" class="nav-link">
          <i class="fas fa-book"></i> My Courses
        </a>
        <a href="{{ route('instructor.createCourse') }}" class="nav-link">
          <i class="fas fa-plus-circle"></i> Add Course
        </a>
        <a href="{{ route('instructor.student-purchases') }}" class="nav-link">
          <i class="fas fa-shopping-cart"></i> Student Purchases
        </a>
        <a href="{{ route('settingsInstructor') }}" class="nav-link">
          <i class="fas fa-cog"></i> Settings
        </a>
        <div style="margin-top: auto; padding-top: 2rem; border-top: 1px solid #262626;">
          <form method="POST" action="{{ route('instructor.logout') }}" id="logout-form">
            @csrf
            <button type="submit" class="nav-link" style="width: 100%; text-align: left; background: none; border: none; color: inherit; cursor: pointer; font: inherit; padding: 0.75rem 1rem; display: flex; align-items: center; gap: 0.75rem; transition: all 0.2s;" onmouseover="this.style.background='#1a1a1a'; this.style.color='#ef4444'" onmouseout="this.style.background=''; this.style.color=''">
              <i class="fas fa-sign-out-alt"></i> Logout
            </button>
          </form>
        </div>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="main">
      <!-- Dashboard Content -->
      <div class="tab-content active" id="dashboard">
        <header class="header">
          <div class="header-left">
            <h1>Welcome back, {{ $instructor->detail->fullname ?? $instructor->name ?? $instructor->email }}!</h1>
            <p class="muted">Here's what's happening with your courses today</p>
          </div>
          <div class="header-right">
            <button class="icon-btn"><i class="fas fa-bell"></i></button>
            <div class="user">
              @php
                $name = $instructor->detail->fullname ?? $instructor->name ?? $instructor->email;
                $initials = collect(explode(' ', $name))->map(fn($word) => strtoupper(substr($word, 0, 1)))->take(2)->join('');
                if (empty($initials)) $initials = strtoupper(substr($instructor->email, 0, 2));
              @endphp
              <div class="user-avatar">{{ $initials }}</div>
              <div class="user-info">
                <div class="user-name">{{ $instructor->detail->fullname ?? $instructor->name ?? $instructor->email }}</div>
                <div class="user-role">Instructor</div>
              </div>
            </div>
          </div>
        </header>

        <!-- Stats Grid -->
        <div class="stats-grid">
          <div class="stat-card">
            <div class="stat-header">
              <div class="stat-icon"><i class="fas fa-book"></i></div>
            </div>
            <div class="stat-value">{{ $totalCourses ?? 0 }}</div>
            <div class="stat-label">Total Courses</div>
          </div>

          <div class="stat-card">
            <div class="stat-header">
              <div class="stat-icon"><i class="fas fa-users"></i></div>
            </div>
            <div class="stat-value">{{ $totalStudents ?? 0 }}</div>
            <div class="stat-label">Total Students</div>
          </div>

          <div class="stat-card">
            <div class="stat-header">
              <div class="stat-icon"><i class="fas fa-clock"></i></div>
            </div>
            <div class="stat-value">
              {{ \App\Models\Course::where('instructorID', $instructor->id)->where('status', 'pending')->count() }}
            </div>
            <div class="stat-label">Pending Approval</div>
          </div>

          <div class="stat-card">
            <div class="stat-header">
              <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
            </div>
            <div class="stat-value">
              {{ \App\Models\Course::where('instructorID', $instructor->id)->where('status', 'approved')->count() }}
            </div>
            <div class="stat-label">Approved Courses</div>
          </div>
        </div>

        <!-- Recent Courses -->
        <section class="section">
          <div class="section-header">
            <h2>Recent Courses</h2>
            <a href="{{ route('instructor.courses.index') }}" class="btn-primary">
              View All
            </a>
          </div>

          <div class="course-table">
            @if(isset($recentCourses) && $recentCourses->count() > 0)
              <table class="table">
                <thead>
                  <tr>
                    <th>Course Name</th>
                    <th>Modules</th>
                    <th>Students</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($recentCourses as $course)
                    <tr>
                      <td><strong>{{ $course->title }}</strong></td>
                      <td>{{ $course->subcourses_count }} modules</td>
                      <td>{{ $course->students_count }} students</td>
                      <td>
                        @if($course->price > 0)
                          Rp {{ number_format($course->price, 0, ',', '.') }}
                        @else
                          Free
                        @endif
                      </td>
                      <td>
                        @if($course->status === 'approved')
                          <span class="status-badge published">Approved</span>
                        @elseif($course->status === 'pending')
                          <span class="status-badge pending">Pending</span>
                        @else
                          <span class="status-badge draft">{{ ucfirst($course->status) }}</span>
                        @endif
                      </td>
                      <td>
                        <div class="action-btns">
                          <a href="{{ route('instructor.courses.edit', $course->courseID) }}" class="action-btn" title="Edit">
                            <i class="fas fa-edit"></i>
                          </a>
                          <form method="POST" action="{{ route('instructor.courses.destroy', $course->courseID) }}" style="display: inline;" onsubmit="return confirm('Delete this course?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn" title="Delete">
                              <i class="fas fa-trash"></i>
                            </button>
                          </form>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            @else
              <div style="text-align: center; padding: 40px; color: #737373;">
                <i class="fas fa-book" style="font-size: 48px; margin-bottom: 16px; opacity: 0.3;"></i>
                <p>No courses yet. <a href="{{ route('instructor.courses.create') }}" style="color: #fff;">Create your first course</a></p>
              </div>
            @endif
          </div>
        </section>
      </div>
    </main>
  </div>
</body>
</html>
