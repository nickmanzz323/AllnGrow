<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Student Purchases - AllnGrow</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/dashboardInstructor/dashboardInstructor.css') }}">
</head>
<body>
  <div class="app">
    <!-- Sidebar -->
    <aside class="sidebar">
      <div class="logo">AllnGrow</div>
      <nav>
        <a href="{{ route('dashboardinstructor') }}" class="nav-link">
          <i class="fas fa-home"></i> Dashboard
        </a>
        <a href="{{ route('instructor.myCourses') }}" class="nav-link">
          <i class="fas fa-book"></i> My Courses
        </a>
        <a href="{{ route('instructor.createCourse') }}" class="nav-link">
          <i class="fas fa-plus-circle"></i> Add Course
        </a>
        <a class="nav-link active">
          <i class="fas fa-shopping-cart"></i> Student Purchases
          @if($pendingCount > 0)
            <span style="position: absolute; right: 1rem; background: #ef4444; color: #fff; padding: 0.2rem 0.5rem; border-radius: 12px; font-size: 0.7rem; font-weight: 600;">{{ $pendingCount }}</span>
          @endif
        </a>
        <a class="nav-link" data-page="students">
          <i class="fas fa-users"></i> Students
        </a>
        <a class="nav-link" data-page="analytics">
          <i class="fas fa-chart-bar"></i> Analytics
        </a>
        <a class="nav-link" data-page="earnings">
          <i class="fas fa-wallet"></i> Earnings
        </a>
        <a href="{{ route('messageInstructor') }}" class="nav-link">
          <i class="fas fa-envelope"></i> Messages
        </a>
        <a href="{{ route('settingsInstructor') }}" class="nav-link">
          <i class="fas fa-cog"></i> Settings
        </a>
        <div style="margin-top: auto; padding-top: 2rem; border-top: 1px solid #262626;">
          <form method="POST" action="{{ route('instructor.logout') }}">
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
      <header class="header">
        <div class="header-left">
          <h1>Student Purchases</h1>
          <p class="muted">Manage student enrollments and confirm payments</p>
        </div>
        <div class="header-right">
          <button class="icon-btn"><i class="fas fa-bell"></i></button>
          <div class="user">
            @php
              $name = $instructor->name ?? $instructor->email;
              $initials = collect(explode(' ', $name))->map(fn($word) => strtoupper(substr($word, 0, 1)))->take(2)->join('');
              if (empty($initials)) $initials = strtoupper(substr($instructor->email, 0, 2));
            @endphp
            <div class="user-avatar">{{ $initials }}</div>
            <div class="user-info">
              <div class="user-name">{{ $instructor->name ?? $instructor->email }}</div>
              <div class="user-role">Instructor</div>
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

      <!-- Filter Buttons -->
      <div style="display: flex; gap: 0.75rem; margin-bottom: 2rem;">
        <button id="filter-all" class="btn-filter active" onclick="filterEnrollments('all')" style="padding: 0.5rem 1rem; background: #fff; border: 1px solid #fff; border-radius: 8px; color: #000; cursor: pointer; transition: all 0.2s; font-size: 0.85rem; font-weight: 600;">
          All Enrollments ({{ $courses->sum(fn($c) => $c->students->count()) }})
        </button>
        <button id="filter-pending" class="btn-filter" onclick="filterEnrollments('pending')" style="padding: 0.5rem 1rem; background: #0d0d0d; border: 1px solid #262626; border-radius: 8px; color: #a3a3a3; cursor: pointer; transition: all 0.2s; font-size: 0.85rem; font-weight: 600;">
          Pending Payments ({{ $pendingCount }})
        </button>
      </div>

      @forelse($courses as $course)
        @if($course->students->count() > 0)
          <section class="section">
            <div style="background: #0d0d0d; border: 1px solid #262626; border-radius: 12px; padding: 1.5rem; margin-bottom: 1.5rem;">
              <div style="margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 1px solid #262626;">
                <h2 style="font-size: 1.25rem; margin-bottom: 0.5rem;">{{ $course->title }}</h2>
                <div style="display: flex; gap: 1.5rem; font-size: 0.9rem; color: #a3a3a3;">
                  <span><i class="fas fa-users"></i> {{ $course->students->count() }} Students</span>
                  <span><i class="fas fa-rupiah-sign"></i> Rp {{ number_format($course->price, 0, ',', '.') }}</span>
                </div>
              </div>

              <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                  <thead style="background: #000;">
                    <tr>
                      <th style="text-align: left; padding: 0.75rem 1rem; font-size: 0.85rem; color: #a3a3a3; text-transform: uppercase; font-weight: 600;">Student Name</th>
                      <th style="text-align: left; padding: 0.75rem 1rem; font-size: 0.85rem; color: #a3a3a3; text-transform: uppercase; font-weight: 600;">Email</th>
                      <th style="text-align: left; padding: 0.75rem 1rem; font-size: 0.85rem; color: #a3a3a3; text-transform: uppercase; font-weight: 600;">Enrolled Date</th>
                      <th style="text-align: left; padding: 0.75rem 1rem; font-size: 0.85rem; color: #a3a3a3; text-transform: uppercase; font-weight: 600;">Payment Status</th>
                      <th style="text-align: left; padding: 0.75rem 1rem; font-size: 0.85rem; color: #a3a3a3; text-transform: uppercase; font-weight: 600;">Completion</th>
                      <th style="text-align: left; padding: 0.75rem 1rem; font-size: 0.85rem; color: #a3a3a3; text-transform: uppercase; font-weight: 600;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($course->students as $student)
                      <tr class="enrollment-row" data-status="{{ $student->pivot->payment_status }}" style="border-top: 1px solid #262626;">
                        <td style="padding: 1rem;">
                          <div style="display: flex; align-items: center; gap: 0.75rem;">
                            <div style="width: 36px; height: 36px; border-radius: 50%; background: #1a1a1a; display: flex; align-items: center; justify-content: center; font-weight: 600; color: #fff;">
                              {{ strtoupper(substr($student->detail->fullname ?? $student->email, 0, 1)) }}
                            </div>
                            {{ $student->detail->fullname ?? 'No Name' }}
                          </div>
                        </td>
                        <td style="padding: 1rem;">{{ $student->email }}</td>
                        <td style="padding: 1rem;">{{ $student->pivot->created_at->format('d M Y') }}</td>
                        <td style="padding: 1rem;">
                          @if($student->pivot->payment_status === 'pending')
                            <span style="display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.4rem 0.75rem; background: #3b2d0d; border: 1px solid #5a4a1a; color: #fbbf24; border-radius: 6px; font-size: 0.85rem; font-weight: 600;">
                              <i class="fas fa-clock"></i> Pending
                            </span>
                          @else
                            <span style="display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.4rem 0.75rem; background: #0d3b0d; border: 1px solid #1a5a1a; color: #4ade80; border-radius: 6px; font-size: 0.85rem; font-weight: 600;">
                              <i class="fas fa-check"></i> Paid
                            </span>
                          @endif
                        </td>
                        <td style="padding: 1rem;">
                          <div style="width: 100px; height: 6px; background: #262626; border-radius: 3px; overflow: hidden; margin-bottom: 0.25rem;">
                            <div style="height: 100%; background: #4ade80; width: {{ $student->pivot->completion }}%; transition: width 0.3s;"></div>
                          </div>
                          <span style="font-size: 0.85rem; color: #a3a3a3;">{{ $student->pivot->completion }}%</span>
                        </td>
                        <td style="padding: 1rem;">
                          @if($student->pivot->payment_status === 'pending')
                            <form method="POST" action="{{ route('instructor.confirm-payment', $student->pivot->id) }}" style="display: inline;">
                              @csrf
                              <button type="submit" onclick="return confirm('Confirm payment from {{ $student->detail->fullname ?? $student->email }}?')" style="padding: 0.5rem 1rem; background: #4ade80; color: #000; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; transition: all 0.2s; display: inline-flex; align-items: center; gap: 0.5rem; font-size: 0.85rem;">
                                <i class="fas fa-check"></i> Confirm Payment
                              </button>
                            </form>
                          @else
                            <span style="color: #a3a3a3; font-size: 0.9rem;"><i class="fas fa-check-circle"></i> Confirmed</span>
                          @endif
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </section>
        @endif
      @empty
        <div style="text-align: center; padding: 4rem 2rem; color: #a3a3a3;">
          <i class="fas fa-shopping-cart" style="font-size: 4rem; margin-bottom: 1rem; opacity: 0.3;"></i>
          <p>No student enrollments yet</p>
        </div>
      @endforelse
    </main>
  </div>

  <script>
    function filterEnrollments(status) {
      const rows = document.querySelectorAll('.enrollment-row');
      const btnAll = document.getElementById('filter-all');
      const btnPending = document.getElementById('filter-pending');
      
      if (status === 'all') {
        rows.forEach(row => row.style.display = 'table-row');
        btnAll.style.background = '#fff';
        btnAll.style.color = '#000';
        btnAll.style.borderColor = '#fff';
        btnPending.style.background = '#0d0d0d';
        btnPending.style.color = '#a3a3a3';
        btnPending.style.borderColor = '#262626';
      } else if (status === 'pending') {
        rows.forEach(row => {
          row.style.display = row.dataset.status === 'pending' ? 'table-row' : 'none';
        });
        btnPending.style.background = '#fff';
        btnPending.style.color = '#000';
        btnPending.style.borderColor = '#fff';
        btnAll.style.background = '#0d0d0d';
        btnAll.style.color = '#a3a3a3';
        btnAll.style.borderColor = '#262626';
      }
    }
    
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
