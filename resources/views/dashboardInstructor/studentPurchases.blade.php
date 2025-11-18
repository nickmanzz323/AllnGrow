<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Student Purchases - AllnGrow</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
  <aside class="sidebar">
    <div class="logo">AllnGrow</div>
    <nav>
      <a href="{{ route('dashboardinstructor') }}"><i class="fas fa-home"></i> Dashboard</a>
      <a href="{{ route('instructor.myCourses') }}"><i class="fas fa-book"></i> My Courses</a>
      <a href="{{ route('instructor.createCourse') }}"><i class="fas fa-plus"></i> Add Course</a>
      <a class="active">
        <i class="fas fa-shopping-cart"></i> Student Purchases
        @if($pendingCount > 0)
          <span class="badge-count">{{ $pendingCount }}</span>
        @endif
      </a>
      <a href="#"><i class="fas fa-users"></i> Students</a>
      <a href="#"><i class="fas fa-chart-bar"></i> Analytics</a>
      <a href="#"><i class="fas fa-dollar-sign"></i> Earnings</a>
      <a href="#"><i class="fas fa-envelope"></i> Messages</a>
      <a href="#"><i class="fas fa-cog"></i> Settings</a>
      <div style="margin-top: auto; padding-top: 2rem; border-top: 1px solid #262626;">
        <form method="POST" action="{{ route('instructor.logout') }}">
          @csrf
          <button type="submit" style="width: 100%; text-align: left; background: none; border: none; color: #f5f5f5; cursor: pointer; font: inherit; padding: 0.75rem 1rem; display: flex; align-items: center; gap: 0.75rem; transition: all 0.2s; border-radius: 8px;" onmouseover="this.style.background='#1a1a1a'; this.style.color='#ef4444'" onmouseout="this.style.background=''; this.style.color='#f5f5f5'">
            <i class="fas fa-sign-out-alt"></i> Logout
          </button>
        </form>
      </div>
    </nav>
  </aside>

  <main class="main">
    <div class="header">
      <div>
        <h1>Student Purchases</h1>
        <p class="muted">Manage student enrollments and confirm payments</p>
      </div>
      <div class="header-actions">
        <button id="filter-all" class="btn-filter active" onclick="filterEnrollments('all')">
          All Enrollments ({{ $courses->sum(fn($c) => $c->students->count()) }})
        </button>
        <button id="filter-pending" class="btn-filter" onclick="filterEnrollments('pending')">
          Pending Payments ({{ $pendingCount }})
        </button>
      </div>
    </div>

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

    @forelse($courses as $course)
      @if($course->students->count() > 0)
        <div class="course-section">
          <div class="course-header">
            <div class="course-info">
              <h2>{{ $course->title }}</h2>
              <div class="course-meta">
                <span><i class="fas fa-users"></i> {{ $course->students->count() }} Students</span>
                <span><i class="fas fa-dollar-sign"></i> Rp {{ number_format($course->price, 0, ',', '.') }}</span>
              </div>
            </div>
          </div>

          <div class="students-table">
            <table>
              <thead>
                <tr>
                  <th>Student Name</th>
                  <th>Email</th>
                  <th>Enrolled Date</th>
                  <th>Payment Status</th>
                  <th>Completion</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($course->students as $student)
                  <tr class="enrollment-row" data-status="{{ $student->pivot->payment_status }}">
                    <td>
                      <div class="student-name">
                        <div class="avatar">
                          {{ strtoupper(substr($student->name ?? $student->email, 0, 1)) }}
                        </div>
                        {{ $student->name ?? 'No Name' }}
                      </div>
                    </td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->pivot->created_at->format('d M Y') }}</td>
                    <td>
                      @if($student->pivot->payment_status === 'pending')
                        <span class="badge-pending">
                          <i class="fas fa-clock"></i> Pending
                        </span>
                      @else
                        <span class="badge-paid">
                          <i class="fas fa-check"></i> Paid
                        </span>
                      @endif
                    </td>
                    <td>
                      <div class="progress-bar">
                        <div class="progress-fill" style="width: {{ $student->pivot->completion }}%"></div>
                      </div>
                      <span class="progress-text">{{ $student->pivot->completion }}%</span>
                    </td>
                    <td>
                      @if($student->pivot->payment_status === 'pending')
                        <form method="POST" action="{{ route('instructor.confirm-payment', $student->pivot->id) }}" style="display: inline;">
                          @csrf
                          <button type="submit" class="btn-confirm" onclick="return confirm('Confirm payment from {{ $student->name ?? $student->email }}?')">
                            <i class="fas fa-check"></i> Confirm Payment
                          </button>
                        </form>
                      @else
                        <span class="text-muted"><i class="fas fa-check-circle"></i> Confirmed</span>
                      @endif
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      @endif
    @empty
      <div class="empty-state">
        <i class="fas fa-shopping-cart"></i>
        <p>No student enrollments yet</p>
      </div>
    @endforelse
  </main>

  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    
    body {
      font-family: 'Inter', sans-serif;
      background: #000;
      color: #f5f5f5;
      display: flex;
      min-height: 100vh;
    }
    
    .sidebar {
      width: 260px;
      background: #0a0a0a;
      border-right: 1px solid #262626;
      padding: 2rem 0;
      position: fixed;
      height: 100vh;
      overflow-y: auto;
    }
    
    .logo {
      font-size: 1.5rem;
      font-weight: 700;
      padding: 0 1.5rem 2rem;
      color: #fff;
    }
    
    .sidebar nav { display: flex; flex-direction: column; }
    .sidebar nav a {
      padding: 0.75rem 1.5rem;
      color: #a3a3a3;
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 0.75rem;
      transition: all 0.2s;
      position: relative;
    }
    .sidebar nav a:hover, .sidebar nav a.active {
      background: #1a1a1a;
      color: #fff;
    }
    
    .badge-count {
      position: absolute;
      right: 1rem;
      background: #ef4444;
      color: #fff;
      padding: 0.2rem 0.5rem;
      border-radius: 12px;
      font-size: 0.7rem;
      font-weight: 600;
    }
    
    .main {
      margin-left: 260px;
      flex: 1;
      padding: 2rem;
    }
    
    .header {
      margin-bottom: 2rem;
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
    }
    
    .header h1 {
      font-size: 1.75rem;
      margin-bottom: 0.5rem;
    }
    
    .muted {
      color: #a3a3a3;
    }
    
    .header-actions {
      display: flex;
      gap: 0.75rem;
    }
    
    .btn-filter {
      padding: 0.5rem 1rem;
      background: #0d0d0d;
      border: 1px solid #262626;
      border-radius: 8px;
      color: #a3a3a3;
      cursor: pointer;
      transition: all 0.2s;
      font-size: 0.85rem;
      font-weight: 500;
    }
    
    .btn-filter:hover {
      background: #1a1a1a;
      color: #fff;
    }
    
    .btn-filter.active {
      background: #fff;
      color: #000;
      border-color: #fff;
    }
    
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
    
    .course-section {
      background: #0d0d0d;
      border: 1px solid #262626;
      border-radius: 12px;
      padding: 1.5rem;
      margin-bottom: 1.5rem;
    }
    
    .course-header {
      margin-bottom: 1.5rem;
      padding-bottom: 1rem;
      border-bottom: 1px solid #262626;
    }
    
    .course-info h2 {
      font-size: 1.25rem;
      margin-bottom: 0.5rem;
    }
    
    .course-meta {
      display: flex;
      gap: 1.5rem;
      font-size: 0.9rem;
      color: #a3a3a3;
    }
    
    .course-meta span {
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }
    
    .students-table {
      overflow-x: auto;
    }
    
    table {
      width: 100%;
      border-collapse: collapse;
    }
    
    thead {
      background: #000;
    }
    
    th {
      text-align: left;
      padding: 0.75rem 1rem;
      font-size: 0.85rem;
      color: #a3a3a3;
      text-transform: uppercase;
      font-weight: 600;
    }
    
    td {
      padding: 1rem;
      border-top: 1px solid #262626;
    }
    
    .student-name {
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }
    
    .avatar {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      background: #1a1a1a;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 600;
      color: #fff;
    }
    
    .badge-pending {
      display: inline-flex;
      align-items: center;
      gap: 0.4rem;
      padding: 0.4rem 0.75rem;
      background: #3b2d0d;
      border: 1px solid #5a4a1a;
      color: #fbbf24;
      border-radius: 6px;
      font-size: 0.85rem;
      font-weight: 600;
    }
    
    .badge-paid {
      display: inline-flex;
      align-items: center;
      gap: 0.4rem;
      padding: 0.4rem 0.75rem;
      background: #0d3b0d;
      border: 1px solid #1a5a1a;
      color: #4ade80;
      border-radius: 6px;
      font-size: 0.85rem;
      font-weight: 600;
    }
    
    .progress-bar {
      width: 100px;
      height: 6px;
      background: #262626;
      border-radius: 3px;
      overflow: hidden;
      margin-bottom: 0.25rem;
    }
    
    .progress-fill {
      height: 100%;
      background: #4ade80;
      transition: width 0.3s;
    }
    
    .progress-text {
      font-size: 0.85rem;
      color: #a3a3a3;
    }
    
    .btn-confirm {
      padding: 0.5rem 1rem;
      background: #4ade80;
      color: #000;
      border: none;
      border-radius: 6px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.2s;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      font-size: 0.85rem;
    }
    
    .btn-confirm:hover {
      background: #22c55e;
      transform: scale(1.05);
    }
    
    .text-muted {
      color: #a3a3a3;
      font-size: 0.9rem;
    }
    
    .empty-state {
      text-align: center;
      padding: 4rem 2rem;
      color: #a3a3a3;
    }
    
    .empty-state i {
      font-size: 4rem;
      margin-bottom: 1rem;
      opacity: 0.3;
    }
    
    .enrollment-row.hidden {
      display: none;
    }
  </style>

  <script>
    function filterEnrollments(status) {
      const rows = document.querySelectorAll('.enrollment-row');
      const btnAll = document.getElementById('filter-all');
      const btnPending = document.getElementById('filter-pending');
      
      if (status === 'all') {
        rows.forEach(row => row.classList.remove('hidden'));
        btnAll.classList.add('active');
        btnPending.classList.remove('active');
      } else if (status === 'pending') {
        rows.forEach(row => {
          if (row.dataset.status === 'pending') {
            row.classList.remove('hidden');
          } else {
            row.classList.add('hidden');
          }
        });
        btnPending.classList.add('active');
        btnAll.classList.remove('active');
      }
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
