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
          <button class="nav-btn" id="prev-month"><i class="fas fa-chevron-left"></i></button>
          <h2 class="current-month" id="current-month-display" style="cursor: pointer;" title="Click to select month/year"></h2>
          <button class="nav-btn" id="next-month"><i class="fas fa-chevron-right"></i></button>
        </div>
        <button class="btn-today" id="btn-today">Today</button>
      </div>

      <!-- Month/Year Selector Modal -->
      <div id="month-year-modal" style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.7); z-index: 1000; justify-content: center; align-items: center;">
        <div style="background: #1a1a1a; border-radius: 12px; padding: 1.5rem; width: 300px; max-width: 90%;">
          <h3 style="margin: 0 0 1rem 0; color: #fff; font-size: 1.1rem;">Select Month & Year</h3>
          <div style="display: flex; gap: 0.75rem; margin-bottom: 1rem;">
            <select id="select-month" style="flex: 1; padding: 0.75rem; border-radius: 8px; border: 1px solid #333; background: #0f0f0f; color: #fff; font-size: 0.9rem;">
              <option value="0">January</option>
              <option value="1">February</option>
              <option value="2">March</option>
              <option value="3">April</option>
              <option value="4">May</option>
              <option value="5">June</option>
              <option value="6">July</option>
              <option value="7">August</option>
              <option value="8">September</option>
              <option value="9">October</option>
              <option value="10">November</option>
              <option value="11">December</option>
            </select>
            <select id="select-year" style="flex: 1; padding: 0.75rem; border-radius: 8px; border: 1px solid #333; background: #0f0f0f; color: #fff; font-size: 0.9rem;">
            </select>
          </div>
          <div style="display: flex; gap: 0.5rem;">
            <button id="cancel-modal" style="flex: 1; padding: 0.75rem; border-radius: 8px; border: 1px solid #333; background: transparent; color: #fff; cursor: pointer; font-size: 0.9rem;">Cancel</button>
            <button id="apply-modal" style="flex: 1; padding: 0.75rem; border-radius: 8px; border: none; background: #fff; color: #000; cursor: pointer; font-weight: 600; font-size: 0.9rem;">Apply</button>
          </div>
        </div>
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
      <div class="calendar-grid" id="calendar-grid">
        <!-- Will be populated by JavaScript -->
      </div>

      <!-- Selected Date Display -->
      <div id="selected-date-display" style="background: #1a1a1a; border-radius: 8px; padding: 1rem; margin-bottom: 1.5rem; display: none;">
        <div style="display: flex; align-items: center; gap: 0.75rem;">
          <i class="fas fa-calendar-check" style="color: #4ade80;"></i>
          <span id="selected-date-text" style="color: #fff;"></span>
        </div>
      </div>

      @php
        // Collect all sessions from enrolled courses
        $allSessions = collect();
        foreach($enrolledCourses as $course) {
          if($course->has_live_sessions && isset($course->sessions)) {
            foreach($course->sessions as $session) {
              $allSessions->push([
                'session' => $session,
                'course' => $course
              ]);
            }
          }
        }

        // Sort sessions by start_time
        $allSessions = $allSessions->sortBy(function($item) {
          return $item['session']->start_time;
        });

        // Filter upcoming sessions
        $upcomingSessions = $allSessions->filter(function($item) {
          return $item['session']->is_upcoming || $item['session']->is_ongoing;
        });

        // Organize sessions by date for JavaScript
        $sessionsByDate = [];
        foreach($allSessions as $item) {
          $date = date('Y-m-d', strtotime($item['session']->start_time));
          if(!isset($sessionsByDate[$date])) {
            $sessionsByDate[$date] = [];
          }
          $sessionsByDate[$date][] = $item;
        }
      @endphp

      <script>
        // Sessions data from PHP
        const sessionsByDate = @json($sessionsByDate);
        // Calendar State
        let currentDate = new Date();
        let selectedDate = null;
        const today = new Date();

        // Month names
        const monthNames = ['January', 'February', 'March', 'April', 'May', 'June',
                           'July', 'August', 'September', 'October', 'November', 'December'];

        // Initialize calendar
        document.addEventListener('DOMContentLoaded', function() {
          renderCalendar();
          setupEventListeners();
          populateYearSelect();
        });

        function populateYearSelect() {
          const yearSelect = document.getElementById('select-year');
          const currentYear = new Date().getFullYear();
          for (let year = currentYear - 5; year <= currentYear + 5; year++) {
            const option = document.createElement('option');
            option.value = year;
            option.textContent = year;
            yearSelect.appendChild(option);
          }
          yearSelect.value = currentYear;
        }

        function setupEventListeners() {
          // Previous month
          document.getElementById('prev-month').addEventListener('click', function() {
            currentDate.setMonth(currentDate.getMonth() - 1);
            renderCalendar();
          });

          // Next month
          document.getElementById('next-month').addEventListener('click', function() {
            currentDate.setMonth(currentDate.getMonth() + 1);
            renderCalendar();
          });

          // Today button
          document.getElementById('btn-today').addEventListener('click', function() {
            currentDate = new Date();
            selectedDate = new Date();
            renderCalendar();
            showSelectedDate();
          });

          // Month/Year modal
          document.getElementById('current-month-display').addEventListener('click', function() {
            const modal = document.getElementById('month-year-modal');
            document.getElementById('select-month').value = currentDate.getMonth();
            document.getElementById('select-year').value = currentDate.getFullYear();
            modal.style.display = 'flex';
          });

          document.getElementById('cancel-modal').addEventListener('click', function() {
            document.getElementById('month-year-modal').style.display = 'none';
          });

          document.getElementById('apply-modal').addEventListener('click', function() {
            const month = parseInt(document.getElementById('select-month').value);
            const year = parseInt(document.getElementById('select-year').value);
            currentDate.setMonth(month);
            currentDate.setFullYear(year);
            renderCalendar();
            document.getElementById('month-year-modal').style.display = 'none';
          });

          // Close modal on outside click
          document.getElementById('month-year-modal').addEventListener('click', function(e) {
            if (e.target === this) {
              this.style.display = 'none';
            }
          });
        }

        function renderCalendar() {
          const grid = document.getElementById('calendar-grid');
          const monthDisplay = document.getElementById('current-month-display');

          const year = currentDate.getFullYear();
          const month = currentDate.getMonth();

          // Update month display
          monthDisplay.textContent = `${monthNames[month]} ${year}`;

          // Get first day of month and total days
          const firstDay = new Date(year, month, 1);
          const lastDay = new Date(year, month + 1, 0);
          const daysInMonth = lastDay.getDate();
          const startingDay = firstDay.getDay() === 0 ? 7 : firstDay.getDay(); // Monday = 1

          // Previous month days
          const prevMonth = month === 0 ? 11 : month - 1;
          const prevYear = month === 0 ? year - 1 : year;
          const daysInPrevMonth = new Date(prevYear, prevMonth + 1, 0).getDate();

          let html = '';

          // Previous month days
          for (let i = startingDay - 1; i > 0; i--) {
            const day = daysInPrevMonth - i + 1;
            html += `<div class="day other-month" data-date="${prevYear}-${String(prevMonth + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}">${day}</div>`;
          }

          // Current month days
          for (let day = 1; day <= daysInMonth; day++) {
            const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
            let classes = 'day';

            // Check if today
            if (day === today.getDate() && month === today.getMonth() && year === today.getFullYear()) {
              classes += ' today';
            }

            // Check if selected
            if (selectedDate && day === selectedDate.getDate() && month === selectedDate.getMonth() && year === selectedDate.getFullYear()) {
              classes += ' selected';
            }

            // Check if date has sessions
            const hasSession = sessionsByDate[dateStr] && sessionsByDate[dateStr].length > 0;
            if (hasSession) {
              classes += ' has-event';
            }

            html += `<div class="${classes}" data-date="${dateStr}" onclick="selectDate(${year}, ${month}, ${day})">
              ${day}
              ${hasSession ? '<div class="event-dot"></div>' : ''}
            </div>`;
          }

          // Next month days
          const remainingCells = 42 - (startingDay - 1 + daysInMonth);
          const nextMonth = month === 11 ? 0 : month + 1;
          const nextYear = month === 11 ? year + 1 : year;
          for (let i = 1; i <= remainingCells; i++) {
            html += `<div class="day other-month" data-date="${nextYear}-${String(nextMonth + 1).padStart(2, '0')}-${String(i).padStart(2, '0')}">${i}</div>`;
          }

          grid.innerHTML = html;
        }

        function selectDate(year, month, day) {
          selectedDate = new Date(year, month, day);
          renderCalendar();
          showSelectedDate();
        }

        function showSelectedDate() {
          const display = document.getElementById('selected-date-display');
          const text = document.getElementById('selected-date-text');

          if (selectedDate) {
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            text.textContent = selectedDate.toLocaleDateString('en-US', options);
            display.style.display = 'block';
          }
        }
      </script>

      <style>
        .day {
          cursor: pointer;
          transition: all 0.2s ease;
        }
        .day:hover:not(.other-month) {
          background: #333 !important;
          transform: scale(1.05);
        }
        .day.selected {
          background: #4ade80 !important;
          color: #000 !important;
          font-weight: 600;
        }
        .day.selected .event-dot {
          background: #000 !important;
        }
        #current-month-display:hover {
          color: #4ade80;
        }
        @keyframes pulse {
          0%, 100% { opacity: 1; }
          50% { opacity: 0.7; }
        }
      </style>

      <!-- Upcoming Sessions -->
      @if($upcomingSessions->count() > 0)
      <section class="section" style="margin-bottom: 2rem;">
        <h2><i class="fas fa-calendar-alt"></i> Upcoming Sessions</h2>
        <div style="display: grid; gap: 1rem; margin-top: 1rem;">
          @foreach($upcomingSessions as $item)
            @php
              $session = $item['session'];
              $course = $item['course'];
            @endphp
            <div style="background: #1a1a1a; border: 1px solid #262626; border-radius: 12px; padding: 1.25rem; display: grid; grid-template-columns: auto 1fr auto; gap: 1.25rem; align-items: center;">
              <!-- Date Badge -->
              <div style="text-align: center; background: #0d0d0d; border: 1px solid #333; border-radius: 8px; padding: 0.75rem; min-width: 80px;">
                <div style="font-size: 1.5rem; font-weight: 700; color: #4ade80; line-height: 1;">
                  {{ date('d', strtotime($session->start_time)) }}
                </div>
                <div style="font-size: 0.75rem; color: #a3a3a3; text-transform: uppercase; margin-top: 0.25rem;">
                  {{ date('M Y', strtotime($session->start_time)) }}
                </div>
              </div>

              <!-- Session Info -->
              <div>
                <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem;">
                  <h3 style="margin: 0; color: #fff; font-size: 1.1rem; font-weight: 600;">{{ $session->title }}</h3>
                  @if($session->is_ongoing)
                    <span style="display: inline-flex; align-items: center; gap: 0.25rem; padding: 0.25rem 0.75rem; background: #16a34a; color: white; border-radius: 12px; font-size: 0.75rem; font-weight: 600; animation: pulse 2s infinite;">
                      <i class="fas fa-circle" style="font-size: 0.5rem;"></i> LIVE NOW
                    </span>
                  @else
                    <span style="display: inline-flex; align-items: center; gap: 0.25rem; padding: 0.25rem 0.75rem; background: #3b82f6; color: white; border-radius: 12px; font-size: 0.75rem; font-weight: 600;">
                      <i class="fas fa-clock"></i> Soon
                    </span>
                  @endif
                </div>

                <div style="color: #a3a3a3; font-size: 0.9rem; margin-bottom: 0.5rem;">
                  <i class="fas fa-book"></i> {{ $course->title }}
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 0.75rem; margin-top: 0.75rem;">
                  <div style="display: flex; align-items: center; gap: 0.5rem; color: #d4d4d4;">
                    <i class="fas fa-clock" style="color: #4ade80;"></i>
                    <span style="font-size: 0.85rem;">{{ $session->formatted_time }}</span>
                  </div>
                  <div style="display: flex; align-items: center; gap: 0.5rem; color: #d4d4d4;">
                    <i class="fas fa-hourglass-half" style="color: #4ade80;"></i>
                    <span style="font-size: 0.85rem;">{{ $session->formatted_duration }}</span>
                  </div>
                  <div style="display: flex; align-items: center; gap: 0.5rem; color: #d4d4d4;">
                    @if($session->session_type === 'online')
                      <i class="fas fa-video" style="color: #4ade80;"></i>
                      <span style="font-size: 0.85rem;">Online</span>
                    @else
                      <i class="fas fa-map-marker-alt" style="color: #4ade80;"></i>
                      <span style="font-size: 0.85rem;">Offline</span>
                    @endif
                  </div>
                </div>
              </div>

              <!-- Action Button -->
              <div>
                @if($session->session_type === 'online' && $session->meeting_link)
                  <a href="{{ $session->meeting_link }}" target="_blank" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.75rem 1.25rem; background: #4ade80; color: #000; text-decoration: none; border-radius: 8px; font-weight: 600; transition: all 0.2s; white-space: nowrap;" onmouseover="this.style.background='#22c55e'" onmouseout="this.style.background='#4ade80'">
                    <i class="fas fa-external-link-alt"></i> Join Meeting
                  </a>
                @elseif($session->session_type === 'offline' && $course->location_name)
                  <div style="text-align: center; padding: 0.75rem; background: #0d0d0d; border: 1px solid #333; border-radius: 8px;">
                    <div style="font-size: 0.75rem; color: #a3a3a3; margin-bottom: 0.25rem;">Location</div>
                    <div style="font-size: 0.85rem; color: #fff; font-weight: 600;">{{ $course->location_name }}</div>
                  </div>
                @endif
              </div>
            </div>
          @endforeach
        </div>
      </section>
      @endif

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
                      @if($course->chapters->count() > 0)
                        {{ $course->chapters->count() }} Bab
                      @else
                        Belum ada materi
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