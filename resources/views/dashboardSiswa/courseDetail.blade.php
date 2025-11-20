<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $course->title }} - AllnGrow</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/dashboardSiswa/dashboardSiswa.css') }}">
  <style>
    .course-header {
      background: linear-gradient(135deg, #0d0d0d 0%, #1a1a1a 100%);
      border: 1px solid #262626;
      border-radius: 12px;
      padding: 2rem;
      margin-bottom: 2rem;
    }
    .course-meta {
      display: flex;
      gap: 2rem;
      margin-top: 1rem;
      color: #a3a3a3;
      flex-wrap: wrap;
    }
    .course-meta span {
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }
    .progress-section {
      background: #0d0d0d;
      border: 1px solid #262626;
      border-radius: 12px;
      padding: 1.5rem;
      margin-bottom: 2rem;
    }
    .progress-bar-large {
      height: 12px;
      background: #262626;
      border-radius: 6px;
      overflow: hidden;
      margin-top: 0.5rem;
    }
    .progress-bar-large > div {
      height: 100%;
      background: #4ade80;
      transition: width 0.3s;
    }
    .curriculum-section {
      background: #0d0d0d;
      border: 1px solid #262626;
      border-radius: 12px;
      padding: 1.5rem;
    }
    .chapter-card {
      background: #000;
      border: 1px solid #262626;
      border-radius: 10px;
      margin-bottom: 1rem;
      overflow: hidden;
    }
    .chapter-header {
      padding: 1rem 1.25rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      cursor: pointer;
      transition: all 0.2s;
    }
    .chapter-header:hover {
      background: #0a0a0a;
    }
    .chapter-title {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      font-weight: 600;
    }
    .chapter-number {
      background: #3b82f6;
      color: #fff;
      padding: 0.25rem 0.6rem;
      border-radius: 6px;
      font-size: 0.75rem;
      font-weight: 600;
    }
    .chapter-meta {
      font-size: 0.85rem;
      color: #737373;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }
    .chapter-lessons {
      border-top: 1px solid #262626;
      display: none;
    }
    .chapter-lessons.active {
      display: block;
    }
    .lesson-item {
      display: flex;
      align-items: center;
      gap: 1rem;
      padding: 1rem 1.25rem;
      border-bottom: 1px solid #1a1a1a;
      transition: all 0.2s;
      cursor: pointer;
    }
    .lesson-item:last-child {
      border-bottom: none;
    }
    .lesson-item:hover {
      background: #0a0a0a;
    }
    .lesson-number {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 32px;
      height: 32px;
      background: #1a1a1a;
      border-radius: 6px;
      font-size: 0.8rem;
      font-weight: 600;
      color: #4ade80;
    }
    .lesson-content {
      flex: 1;
    }
    .lesson-title {
      font-weight: 500;
      font-size: 0.95rem;
      margin-bottom: 0.25rem;
    }
    .lesson-meta {
      font-size: 0.8rem;
      color: #737373;
      display: flex;
      gap: 1rem;
    }
    .lesson-meta span {
      display: flex;
      align-items: center;
      gap: 0.35rem;
    }
    .lesson-badge {
      background: #22c55e;
      color: #fff;
      padding: 0.15rem 0.4rem;
      border-radius: 4px;
      font-size: 0.65rem;
      font-weight: 600;
    }
    .btn-back {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      padding: 0.75rem 1.5rem;
      background: #262626;
      color: #f5f5f5;
      text-decoration: none;
      border-radius: 8px;
      font-weight: 600;
      transition: all 0.2s;
      border: 1px solid #262626;
    }
    .btn-back:hover {
      background: #1a1a1a;
      border-color: #4ade80;
    }
  </style>
</head>
<body>
  <div class="app">
    <!-- Sidebar -->
    <aside class="sidebar">
      <div class="logo">AllnGrow</div>
      <nav>
        <a href="{{ route('dashboardSiswa') }}"><i class="fas fa-home"></i> Dashboard</a>
        <a href="{{ route('student.my-courses') }}" class="active"><i class="fas fa-book"></i> My Courses</a>
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
          <a href="{{ route('student.my-courses') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> Back to My Courses
          </a>
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

      <!-- Course Header -->
      <div class="course-header">
        <div style="font-size: 0.9rem; color: #4ade80; font-weight: 600; margin-bottom: 0.5rem;">
          {{ $course->category->name ?? 'Uncategorized' }}
        </div>
        <h1 style="font-size: 2rem; margin-bottom: 0.5rem;">{{ $course->title }}</h1>
        <p style="color: #a3a3a3; margin-bottom: 1rem;">{{ $course->description }}</p>
        <div class="course-meta">
          <span>
            <i class="fas fa-user-circle"></i>
            {{ $course->instructor->detail->fullname ?? $course->instructor->email }}
          </span>
          <span>
            <i class="fas fa-book"></i>
            {{ $course->chapters->count() }} Bab
          </span>
          <span>
            <i class="fas fa-play-circle"></i>
            {{ $course->total_lessons }} Materi
          </span>
          @if($course->formatted_duration != '-')
          <span>
            <i class="fas fa-clock"></i>
            {{ $course->formatted_duration }}
          </span>
          @endif
          <span>
            <i class="fas {{ $course->teaching_mode_icon }}"></i>
            {{ $course->teaching_mode_label }}
          </span>
        </div>

        @if($course->has_live_sessions)
          <div style="margin-top: 1.5rem; padding: 1rem; background: #111; border-radius: 8px; border: 1px solid #262626;">
            <h3 style="font-size: 0.9rem; font-weight: 600; margin-bottom: 0.75rem; display: flex; align-items: center; gap: 0.5rem;">
              <i class="fas {{ $course->is_online ? 'fa-video' : 'fa-map-marker-alt' }}" style="color: #3b82f6;"></i>
              {{ $course->teaching_mode_label }} Course Info
            </h3>

            @if($course->is_online && $course->default_meeting_link)
              <p style="font-size: 0.85rem; color: #a3a3a3; margin-bottom: 0.5rem;">
                <strong>Platform:</strong> {{ ucfirst(str_replace('_', ' ', $course->meeting_platform ?? 'Online')) }}
              </p>
            @endif

            @if($course->is_offline && $course->location_name)
              <p style="font-size: 0.85rem; color: #a3a3a3; margin-bottom: 0.5rem;">
                <strong>Location:</strong> {{ $course->location_name }}
                @if($course->location_city)
                  , {{ $course->location_city }}
                @endif
              </p>
              @if($course->location_address)
                <p style="font-size: 0.8rem; color: #737373;">
                  {{ $course->location_address }}
                </p>
              @endif
            @endif

            @if($course->max_participants)
              <p style="font-size: 0.85rem; color: #a3a3a3; margin-top: 0.5rem;">
                <strong>Max Participants:</strong> {{ $course->max_participants }}
              </p>
            @endif
          </div>
        @endif
      </div>

      <!-- Progress Section -->
      <div class="progress-section">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
          <h2 style="font-size: 1.1rem; font-weight: 600;">Your Progress</h2>
          <span style="font-size: 1.5rem; font-weight: 700; color: #4ade80;">{{ $enrollment->pivot->completion }}%</span>
        </div>
        <div class="progress-bar-large">
          <div style="width: {{ $enrollment->pivot->completion }}%;"></div>
        </div>
        <div style="margin-top: 1rem; color: #a3a3a3; font-size: 0.9rem;">
          @if($enrollment->pivot->completed)
            <i class="fas fa-check-circle" style="color: #4ade80;"></i> Course Completed!
          @else
            Keep learning to complete this course
          @endif
        </div>
      </div>

      <!-- Upcoming Sessions -->
      @if($course->has_live_sessions && isset($course->sessions) && $course->sessions->count() > 0)
        <div style="background: #0d0d0d; border: 1px solid #262626; border-radius: 12px; padding: 1.5rem; margin-bottom: 2rem;">
          <h2 style="font-size: 1.1rem; font-weight: 600; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
            <i class="fas fa-calendar-alt" style="color: #3b82f6;"></i> Scheduled Sessions
          </h2>

          <div style="display: flex; flex-direction: column; gap: 1rem;">
            @php
              $upcomingSessions = $course->sessions->filter(function($session) {
                return $session->is_upcoming || $session->is_ongoing;
              });
            @endphp

            @if($upcomingSessions->count() > 0)
              @foreach($upcomingSessions as $session)
                <div style="background: {{ $session->is_ongoing ? '#052e16' : '#1a1a1a' }}; border: 1px solid {{ $session->is_ongoing ? '#166534' : '#262626' }}; border-radius: 10px; padding: 1.25rem;">
                  <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 1rem;">
                    <div style="flex: 1;">
                      <div style="font-weight: 600; font-size: 1rem; margin-bottom: 0.25rem; color: #fff;">
                        {{ $session->title }}
                      </div>
                      @if($session->description)
                        <p style="font-size: 0.85rem; color: #a3a3a3; margin: 0;">{{ $session->description }}</p>
                      @endif
                    </div>
                    @if($session->is_ongoing)
                      <span style="background: #4ade80; color: #000; padding: 0.35rem 0.75rem; border-radius: 6px; font-size: 0.75rem; font-weight: 700; white-space: nowrap; animation: pulse 2s infinite;">
                        <i class="fas fa-circle" style="font-size: 0.5rem;"></i> LIVE NOW
                      </span>
                    @else
                      <span style="background: #1e3a5f; color: #60a5fa; padding: 0.35rem 0.75rem; border-radius: 6px; font-size: 0.75rem; font-weight: 600; white-space: nowrap;">
                        <i class="fas fa-clock"></i> Soon
                      </span>
                    @endif
                  </div>

                  <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1rem; margin-bottom: 1rem;">
                    <div style="display: flex; align-items: center; gap: 0.5rem; color: #d4d4d4; font-size: 0.9rem;">
                      <i class="fas fa-calendar" style="color: #3b82f6; width: 18px;"></i>
                      <span>{{ $session->formatted_date }}</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 0.5rem; color: #d4d4d4; font-size: 0.9rem;">
                      <i class="fas fa-clock" style="color: #3b82f6; width: 18px;"></i>
                      <span>{{ $session->formatted_time }}</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 0.5rem; color: #d4d4d4; font-size: 0.9rem;">
                      <i class="fas fa-hourglass-half" style="color: #3b82f6; width: 18px;"></i>
                      <span>{{ $session->formatted_duration }}</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 0.5rem; color: #d4d4d4; font-size: 0.9rem;">
                      <i class="fas {{ $session->session_type === 'online' ? 'fa-video' : 'fa-map-marker-alt' }}" style="color: #3b82f6; width: 18px;"></i>
                      <span>{{ ucfirst($session->session_type) }}</span>
                    </div>
                  </div>

                  @if($session->session_type === 'online' && $session->meeting_link)
                    <a href="{{ $session->meeting_link }}" target="_blank" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.75rem 1.25rem; background: #3b82f6; color: #fff; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 0.9rem; transition: all 0.2s;">
                      <i class="fas fa-external-link-alt"></i> Join Meeting
                    </a>
                  @elseif($session->session_type === 'offline' && $course->location_name)
                    <div style="background: #111; border: 1px solid #262626; border-radius: 6px; padding: 0.75rem; margin-top: 0.5rem;">
                      <p style="font-size: 0.85rem; color: #4ade80; font-weight: 600; margin: 0 0 0.25rem 0;">
                        <i class="fas fa-map-marker-alt"></i> {{ $course->location_name }}
                      </p>
                      @if($course->location_address)
                        <p style="font-size: 0.8rem; color: #a3a3a3; margin: 0;">
                          {{ $course->location_address }}
                        </p>
                      @endif
                    </div>
                  @endif
                </div>
              @endforeach

              @php
                $completedSessions = $course->sessions->filter(function($session) {
                  return !$session->is_upcoming && !$session->is_ongoing;
                });
              @endphp

              @if($completedSessions->count() > 0)
                <details style="background: #111; border: 1px solid #262626; border-radius: 10px; padding: 1rem;">
                  <summary style="cursor: pointer; font-weight: 600; color: #a3a3a3; list-style: none; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fas fa-history"></i> View Past Sessions ({{ $completedSessions->count() }})
                  </summary>
                  <div style="display: flex; flex-direction: column; gap: 0.75rem; margin-top: 1rem; padding-top: 1rem; border-top: 1px solid #262626;">
                    @foreach($completedSessions as $session)
                      <div style="font-size: 0.9rem; color: #737373; display: flex; justify-content: space-between;">
                        <span>{{ $session->title }}</span>
                        <span style="color: #525252;">{{ $session->formatted_date }}</span>
                      </div>
                    @endforeach
                  </div>
                </details>
              @endif
            @else
              <div style="text-align: center; padding: 2rem; color: #737373;">
                <i class="fas fa-calendar-times" style="font-size: 2.5rem; margin-bottom: 0.75rem; opacity: 0.3;"></i>
                <p style="margin: 0;">All sessions have been completed</p>
              </div>
            @endif
          </div>
        </div>

        <style>
          @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
          }
        </style>
      @endif

      <!-- Course Curriculum -->
      <div class="curriculum-section">
        <h2 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1.5rem;">
          <i class="fas fa-list"></i> Course Curriculum
        </h2>

        @if($course->chapters->count() > 0)
          @foreach($course->chapters as $chapterIndex => $chapter)
            <div class="chapter-card">
              <div class="chapter-header" onclick="toggleChapter({{ $chapter->id }})">
                <div class="chapter-title">
                  <span class="chapter-number">Bab {{ $chapterIndex + 1 }}</span>
                  <span>{{ $chapter->title }}</span>
                </div>
                <div class="chapter-meta">
                  <span>{{ $chapter->lessons->count() }} materi</span>
                  <i class="fas fa-chevron-down" id="chapter-icon-{{ $chapter->id }}"></i>
                </div>
              </div>

              <div class="chapter-lessons" id="chapter-lessons-{{ $chapter->id }}">
                @if($chapter->lessons->count() > 0)
                  @foreach($chapter->lessons as $lessonIndex => $lesson)
                    <a href="{{ route('student.view-lesson', [$course->courseID, $lesson->id]) }}" class="lesson-item" style="text-decoration: none; color: inherit;">
                      <div class="lesson-number">{{ $lessonIndex + 1 }}</div>
                      <div class="lesson-content">
                        <div class="lesson-title">
                          {{ $lesson->title }}
                          @if($lesson->is_free)
                            <span class="lesson-badge">FREE</span>
                          @endif
                        </div>
                        <div class="lesson-meta">
                          @if($lesson->duration)
                            <span><i class="fas fa-clock"></i> {{ $lesson->formatted_duration }}</span>
                          @endif
                          @if($lesson->video_url)
                            <span><i class="fas fa-video"></i> Video</span>
                          @endif
                          @if($lesson->fileUpload)
                            <span><i class="fas fa-file"></i> File</span>
                          @endif
                        </div>
                      </div>
                      <i class="fas fa-chevron-right" style="color: #737373;"></i>
                    </a>
                  @endforeach
                @else
                  <div style="text-align: center; padding: 1.5rem; color: #737373; font-size: 0.9rem;">
                    No lessons yet
                  </div>
                @endif
              </div>
            </div>
          @endforeach
        @else
          <div style="text-align: center; padding: 3rem; color: #737373;">
            <i class="fas fa-inbox" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.3;"></i>
            <p>No content available yet. The instructor is still preparing the curriculum.</p>
          </div>
        @endif
      </div>

    </main>
  </div>

  <script>
    function toggleChapter(chapterId) {
      const lessons = document.getElementById('chapter-lessons-' + chapterId);
      const icon = document.getElementById('chapter-icon-' + chapterId);
      lessons.classList.toggle('active');
      icon.classList.toggle('fa-chevron-down');
      icon.classList.toggle('fa-chevron-up');
    }

    // Expand first chapter by default
    document.addEventListener('DOMContentLoaded', function() {
      const firstChapter = document.querySelector('.chapter-lessons');
      const firstIcon = document.querySelector('.chapter-header i');
      if (firstChapter) {
        firstChapter.classList.add('active');
        if (firstIcon) {
          firstIcon.classList.remove('fa-chevron-down');
          firstIcon.classList.add('fa-chevron-up');
        }
      }
    });

    // Auto-dismiss alerts
    setTimeout(() => {
      document.querySelectorAll('[style*="background: #0d3b0d"], [style*="background: #3b0d0d"]').forEach(alert => {
        alert.style.transition = 'opacity 0.3s';
        alert.style.opacity = '0';
        setTimeout(() => alert.remove(), 300);
      });
    }, 5000);
  </script>
</body>
</html>
