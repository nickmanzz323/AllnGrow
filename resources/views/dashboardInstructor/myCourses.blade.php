<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Courses - AllnGrow Instructor</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    /* Variables – dark mode (bg hitam, highlight putih) */
    :root {
      --bg: #050505;
      --surface: #101010;
      --text: #f5f5f5;
      --text-muted: #9b9b9b;
      --border: #262626;
      --primary: #ffffff;
      --primary-dark: #ffffff;
      --radius: 12px;
      --shadow: 0 2px 12px rgba(0,0,0,0.6);
      --shadow-lg: 0 10px 30px rgba(0,0,0,0.75);
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: var(--bg);
      color: var(--text);
      line-height: 1.6;
      min-height: 100vh;
    }

    .page-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 2rem 1.5rem;
    }

    /* Back Link */
    .back-link {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      color: var(--text-muted);
      text-decoration: none;
      margin-bottom: 1.5rem;
      font-size: 0.9rem;
      font-weight: 500;
      transition: all 0.2s;
      padding: 0.35rem 0.75rem;
      border-radius: 999px;
    }

    .back-link i {
      font-size: 0.9rem;
    }

    .back-link:hover {
      background: #181818;
      color: var(--primary);
      transform: translateX(-2px);
    }

    /* Page Header */
    .page-header {
      background: var(--surface);
      padding: 1.75rem 1.5rem;
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      margin-bottom: 2rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 1rem;
      border: 1px solid var(--border);
    }

    .page-header-content h1 {
      font-size: 1.75rem;
      font-weight: 600;
      color: var(--text);
      margin-bottom: 0.25rem;
    }

    .page-header-content p {
      color: var(--text-muted);
      font-size: 0.95rem;
    }

    .btn-create {
      background: var(--primary);
      color: #000000;
      text-decoration: none;
      padding: 0.8rem 1.6rem;
      border-radius: 999px;
      font-size: 0.9rem;
      font-weight: 500;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      transition: all 0.2s;
      box-shadow: 0 4px 18px rgba(0,0,0,0.6);
      border: 1px solid #ffffff;
      white-space: nowrap;
    }

    .btn-create i {
      font-size: 0.9rem;
    }

    .btn-create:hover {
      background: #f0f0f0;
      transform: translateY(-1px);
      box-shadow: 0 8px 26px rgba(0,0,0,0.8);
    }

    /* Alert Messages – masih monochrome */
    .alert {
      padding: 0.9rem 1.1rem;
      border-radius: 10px;
      margin-bottom: 1.25rem;
      font-size: 0.9rem;
      display: flex;
      align-items: center;
      gap: 0.6rem;
      animation: slideIn 0.25s ease-out;
      border: 1px solid var(--border);
      background: #101010;
      color: var(--text);
    }

    @keyframes slideIn {
      from {
        opacity: 0;
        transform: translateY(-8px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .alert i {
      font-size: 1rem;
      flex-shrink: 0;
      color: var(--primary);
    }

    .alert-success,
    .alert-error {
      /* same style, beda pesan aja – tetap putih-hitam */
    }

    /* Stats Summary */
    .stats-summary {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
      gap: 1rem;
      margin-bottom: 2rem;
    }

    .stat-card {
      background: var(--surface);
      padding: 1.25rem 1.2rem;
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      border: 1px solid var(--border);
    }

    .stat-card-icon {
      width: 40px;
      height: 40px;
      background: #ffffff;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #000000;
      font-size: 1rem;
      margin-bottom: 0.9rem;
    }

    .stat-card-value {
      font-size: 1.6rem;
      font-weight: 600;
      color: var(--text);
      margin-bottom: 0.1rem;
    }

    .stat-card-label {
      font-size: 0.85rem;
      color: var(--text-muted);
    }

    /* Courses Grid */
    .courses-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
      gap: 1.5rem;
    }

    /* Course Card */
    .course-card {
      background: var(--surface);
      border-radius: var(--radius);
      overflow: hidden;
      box-shadow: var(--shadow);
      transition: all 0.25s ease;
      border: 1px solid var(--border);
      display: flex;
      flex-direction: column;
    }

    .course-card:hover {
      transform: translateY(-4px);
      box-shadow: var(--shadow-lg);
      border-color: #ffffff33;
    }

    .course-thumbnail {
      width: 100%;
      height: 190px;
      background: #000000;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 2.6rem;
      position: relative;
      overflow: hidden;
    }

    .course-thumbnail img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.3s ease;
      filter: grayscale(100%);
    }

    .course-card:hover .course-thumbnail img {
      transform: scale(1.04);
    }

    .course-thumbnail i {
      opacity: 0.45;
    }

    .course-status-badge {
      position: absolute;
      top: 0.9rem;
      right: 0.9rem;
      background: rgba(0, 0, 0, 0.8);
      padding: 0.35rem 0.8rem;
      border-radius: 999px;
      font-size: 0.75rem;
      font-weight: 500;
      text-transform: uppercase;
      letter-spacing: 0.04em;
      backdrop-filter: blur(10px);
      display: inline-flex;
      align-items: center;
      gap: 0.3rem;
      color: #f5f5f5;
      border: 1px solid #ffffff55;
    }

    .course-status-badge i {
      font-size: 0.75rem;
    }

    .status-published,
    .status-draft,
    .status-pending {
      /* sama-sama pakai badge ini, tetap monochrome */
    }

    /* Course Body */
    .course-body {
      padding: 1.25rem 1.35rem 1.3rem;
      display: flex;
      flex-direction: column;
      flex: 1;
    }

    .course-title {
      font-size: 1.05rem;
      font-weight: 600;
      color: var(--text);
      margin-bottom: 0.7rem;
      line-height: 1.5;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    .course-stats {
      display: flex;
      gap: 1.1rem;
      margin-bottom: 0.9rem;
      padding-bottom: 0.9rem;
      border-bottom: 1px solid var(--border);
    }

    .course-stat {
      display: flex;
      align-items: center;
      gap: 0.45rem;
      font-size: 0.85rem;
      color: var(--text-muted);
      white-space: nowrap;
    }

    .course-stat i {
      font-size: 0.9rem;
      color: var(--primary);
    }

    .course-footer {
      margin-top: auto;
    }

    .course-price {
      font-size: 1.2rem;
      font-weight: 600;
      color: var(--primary);
      margin-bottom: 0.8rem;
      display: flex;
      align-items: center;
      gap: 0.4rem;
    }

    .course-price.free {
      font-size: 1rem;
      font-weight: 500;
      color: var(--text-muted);
    }

    .course-price i {
      font-size: 0.95rem;
    }

    /* Course Actions */
    .course-actions {
      display: flex;
      gap: 0.5rem;
    }

    .btn {
      padding: 0.55rem 1.1rem;
      border-radius: 8px;
      font-size: 0.85rem;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.18s ease;
      border: 1px solid transparent;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 0.45rem;
      flex: 1;
    }

    .btn i {
      font-size: 0.85rem;
    }

    .btn-edit {
      background: #ffffff;
      color: #000000;
      border-color: #ffffff;
    }

    .btn-edit:hover {
      background: #f0f0f0;
      transform: translateY(-1px);
      box-shadow: 0 4px 14px rgba(0,0,0,0.6);
    }

    .btn-delete {
      background: #101010;
      color: #f5f5f5;
      border-color: #3a3a3a;
    }

    .btn-delete:hover {
      background: #ffffff;
      color: #000000;
      border-color: #ffffff;
      transform: translateY(-1px);
      box-shadow: 0 4px 14px rgba(0,0,0,0.7);
    }

    .btn-view {
      background: #101010;
      color: var(--text);
      border: 1px solid var(--border);
    }

    .btn-view:hover {
      background: #181818;
    }

    /* Empty State */
    .empty-state {
      background: var(--surface);
      border-radius: var(--radius);
      padding: 3.5rem 2rem;
      text-align: center;
      box-shadow: var(--shadow);
      border: 1px solid var(--border);
    }

    .empty-state-icon {
      width: 110px;
      height: 110px;
      margin: 0 auto 1.5rem;
      background: #ffffff;
      border-radius: 999px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #000000;
      font-size: 3rem;
    }

    .empty-state h2 {
      font-size: 1.4rem;
      color: var(--text);
      margin-bottom: 0.6rem;
      font-weight: 600;
    }

    .empty-state p {
      color: var(--text-muted);
      margin-bottom: 1.8rem;
      font-size: 0.95rem;
      max-width: 460px;
      margin-left: auto;
      margin-right: auto;
    }

    /* Pagination */
    .pagination {
      margin-top: 2rem;
      display: flex;
      justify-content: center;
      color: var(--text);
    }

    /* Loading State (skeleton) – still grayscale tapi di dark */
    .loading-skeleton {
      background: linear-gradient(
        90deg,
        #1a1a1a 25%,
        #262626 37%,
        #1a1a1a 63%
      );
      background-size: 400% 100%;
      animation: loading 1.5s infinite;
    }

    @keyframes loading {
      0% {
        background-position: 200% 0;
      }
      100% {
        background-position: -200% 0;
      }
    }

    /* Responsive */
    @media (max-width: 768px) {
      .page-container {
        padding: 1.25rem 1rem;
      }

      .page-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.8rem;
      }

      .page-header-content h1 {
        font-size: 1.45rem;
      }

      .btn-create {
        width: 100%;
        justify-content: center;
      }

      .courses-grid {
        grid-template-columns: 1fr;
      }

      .empty-state {
        padding: 2.6rem 1.5rem;
      }

      .empty-state-icon {
        width: 95px;
        height: 95px;
        font-size: 2.6rem;
      }

      .stats-summary {
        grid-template-columns: 1fr;
      }
    }

    @media (max-width: 640px) {
      .course-stats {
        flex-direction: column;
        gap: 0.45rem;
      }

      .course-actions {
        flex-direction: column;
      }

      .btn {
        width: 100%;
      }
    }
  </style>
</head>
<body>
  <div class="page-container">
    <!-- Back Link -->
    <a href="{{ route('dashboardinstructor') }}" class="back-link">
      <i class="fas fa-arrow-left"></i> Back to Dashboard
    </a>

    <!-- Page Header -->
    <div class="page-header">
      <div class="page-header-content">
        <h1>My Courses</h1>
        <p>Manage and organize all your courses in one place</p>
      </div>
      <a href="{{ route('instructor.courses.create') }}" class="btn-create">
        <i class="fas fa-plus"></i> Create New Course
      </a>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
      <div class="alert alert-success">
        <i class="fas fa-check-circle"></i>
        <strong>{{ session('success') }}</strong>
      </div>
    @endif

    @if(session('error'))
      <div class="alert alert-error">
        <i class="fas fa-exclamation-circle"></i>
        <span>{{ session('error') }}</span>
      </div>
    @endif

    <div class="stats-summary">
      <div class="stat-card">
        <div class="stat-card-icon">
          <i class="fas fa-book"></i>
        </div>
        <div class="stat-card-value">{{ $courses->total() }}</div>
        <div class="stat-card-label">Total Courses</div>
      </div>
      <div class="stat-card">
        <div class="stat-card-icon">
          <i class="fas fa-users"></i>
        </div>
        <div class="stat-card-value">0</div>
        <div class="stat-card-label">Total Students</div>
      </div>
      <div class="stat-card">
        <div class="stat-card-icon">
          <i class="fas fa-star"></i>
        </div>
        <div class="stat-card-value">0.0</div>
        <div class="stat-card-label">Average Rating</div>
      </div>
    </div>
  
    <!-- Courses Grid -->
    @if($courses->count() > 0)
      <div class="courses-grid">
        @foreach($courses as $course)
          <div class="course-card">
            <div class="course-thumbnail">
              @if($course->thumbnail)
                <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="{{ $course->title }}">
              @else
                <i class="fas fa-graduation-cap"></i>
              @endif
              
              <!-- Status Badge -->
              @if($course->status === 'approved')
                <div class="course-status-badge status-published">
                  <i class="fas fa-check-circle"></i> Approved
                </div>
              @elseif($course->status === 'pending')
                <div class="course-status-badge status-draft" style="background:#fbbf24;color:#000;">
                  <i class="fas fa-clock"></i> Pending Review
                </div>
              @else
                <div class="course-status-badge status-draft" style="background:#ff4444;">
                  <i class="fas fa-times-circle"></i> Rejected
                </div>
              @endif
            </div>

            <div class="course-body">
              <h3 class="course-title">{{ $course->title }}</h3>
              
              <div class="course-stats">
                <div class="course-stat">
                  <i class="fas fa-book-open"></i>
                  <span>{{ $course->subcourses_count ?? 0 }} modules</span>
                </div>
                <div class="course-stat">
                  <i class="fas fa-users"></i>
                  <span>{{ $course->students_count ?? 0 }} students</span>
                </div>
                <div class="course-stat">
                  <i class="fas fa-star"></i>
                  <span>4.8</span>
                </div>
              </div>

              <div class="course-footer">
                <div class="course-price {{ $course->price == 0 ? 'free' : '' }}">
                  @if($course->price > 0)
                    Rp {{ number_format($course->price, 0, ',', '.') }}
                  @else
                    <i class="fas fa-gift"></i> Free
                  @endif
                </div>

                <div class="course-actions">
                  <a href="{{ route('instructor.courses.edit', $course->id) }}" class="btn btn-edit">
                    <i class="fas fa-edit"></i> Edit
                  </a>
                  <form method="POST" action="{{ route('instructor.courses.destroy', $course->id) }}" style="flex: 1;" onsubmit="return confirm('Are you sure you want to delete this course? This action cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-delete" style="width: 100%;">
                      <i class="fas fa-trash"></i> Delete
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      <!-- Pagination -->
      <div class="pagination">
        {{ $courses->links() }}
      </div>
    @else
      <!-- Empty State -->
      <div class="empty-state">
        <div class="empty-state-icon">
          <i class="fas fa-graduation-cap"></i>
        </div>
        <h2>No Courses Yet</h2>
        <p>You haven't created any courses yet. Start creating your first course to share your knowledge with students around the world.</p>
        <a href="{{ route('instructor.courses.create') }}" class="btn-create">
          <i class="fas fa-plus"></i> Create Your First Course
        </a>
      </div>
    @endif
  </div>
</body>
</html>
