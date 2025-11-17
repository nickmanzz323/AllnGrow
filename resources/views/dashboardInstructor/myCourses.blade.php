<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Courses - AllnGrow Instructor</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: #f7fafc;
      min-height: 100vh;
      padding: 20px;
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
    }

    .header {
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
      margin-bottom: 24px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .header h1 {
      font-size: 28px;
      color: #1a202c;
      margin-bottom: 4px;
    }

    .header p {
      color: #718096;
      font-size: 14px;
    }

    .back-link {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      color: #000000;
      text-decoration: none;
      margin-bottom: 20px;
      font-size: 14px;
      font-weight: 500;
      transition: gap 0.2s;
    }

    .back-link:hover {
      gap: 12px;
    }

    .btn-create {
      background: #000000;
      color: white;
      text-decoration: none;
      padding: 12px 24px;
      border-radius: 8px;
      font-size: 14px;
      font-weight: 600;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      transition: transform 0.2s, box-shadow 0.2s;
    }

    .btn-create:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .alert {
      padding: 16px;
      border-radius: 8px;
      margin-bottom: 20px;
      font-size: 14px;
    }

    .alert-success {
      background: #d4edda;
      border: 1px solid #c3e6cb;
      color: #155724;
    }

    .alert-error {
      background: #fff3cd;
      border: 1px solid #ffeeba;
      color: #856404;
    }

    .courses-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
      gap: 24px;
    }

    .course-card {
      background: white;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
      transition: transform 0.2s, box-shadow 0.2s;
    }

    .course-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 8px 16px rgba(0,0,0,0.1);
    }

    .course-thumbnail {
      width: 100%;
      height: 200px;
      background: #e5e5e5;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #737373;
      font-size: 48px;
      position: relative;
    }

    .course-thumbnail img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .course-body {
      padding: 20px;
    }

    .course-title {
      font-size: 18px;
      font-weight: 600;
      color: #1a202c;
      margin-bottom: 12px;
      line-height: 1.4;
    }

    .course-stats {
      display: flex;
      gap: 16px;
      margin-bottom: 16px;
      font-size: 13px;
      color: #718096;
    }

    .course-stat {
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .course-price {
      font-size: 20px;
      font-weight: 700;
      color: #000000;
      margin-bottom: 16px;
    }

    .course-actions {
      display: flex;
      gap: 8px;
    }

    .btn {
      padding: 8px 16px;
      border-radius: 6px;
      font-size: 13px;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.2s;
      border: none;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      justify-content: center;
    }

    .btn-edit {
      background: #4299e1;
      color: white;
      flex: 1;
    }

    .btn-edit:hover {
      background: #3182ce;
    }

    .btn-delete {
      background: #fc8181;
      color: white;
      flex: 1;
    }

    .btn-delete:hover {
      background: #f56565;
    }

    .empty-state {
      background: white;
      border-radius: 12px;
      padding: 60px 40px;
      text-align: center;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .empty-state i {
      font-size: 64px;
      color: #cbd5e0;
      margin-bottom: 20px;
    }

    .empty-state h2 {
      font-size: 24px;
      color: #2d3748;
      margin-bottom: 12px;
    }

    .empty-state p {
      color: #718096;
      margin-bottom: 24px;
    }

    .pagination {
      margin-top: 24px;
      display: flex;
      justify-content: center;
    }
  </style>
</head>
<body>
  <div class="container">
    <a href="{{ route('dashboardinstructor') }}" class="back-link">
      <i class="fas fa-arrow-left"></i> Back to Dashboard
    </a>

    <div class="header">
      <div>
        <h1>My Courses</h1>
        <p>Manage your courses and create new ones</p>
      </div>
      <a href="{{ route('instructor.courses.create') }}" class="btn-create">
        <i class="fas fa-plus"></i> Create New Course
      </a>
    </div>

    @if(session('success'))
      <div class="alert alert-success">
        <strong>{{ session('success') }}</strong>
      </div>
    @endif

    @if(session('error'))
      <div class="alert alert-error">
        {{ session('error') }}
      </div>
    @endif

    @if($courses->count() > 0)
      <div class="courses-grid">
        @foreach($courses as $course)
          <div class="course-card">
            <div class="course-thumbnail">
              @if($course->thumbnail)
                <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="{{ $course->title }}">
              @else
                <i class="fas fa-book"></i>
              @endif
            </div>
            <div class="course-body">
              <h3 class="course-title">{{ $course->title }}</h3>
              
              <div class="course-stats">
                <div class="course-stat">
                  <i class="fas fa-book-open"></i>
                  <span>{{ $course->subcourses_count }} modules</span>
                </div>
                <div class="course-stat">
                  <i class="fas fa-users"></i>
                  <span>{{ $course->students_count }} students</span>
                </div>
              </div>

              <div class="course-price">
                @if($course->price > 0)
                  Rp {{ number_format($course->price, 0, ',', '.') }}
                @else
                  Free
                @endif
              </div>

              <div class="course-actions">
                <a href="{{ route('instructor.courses.edit', $course->id) }}" class="btn btn-edit">
                  <i class="fas fa-edit"></i> Edit
                </a>
                <form method="POST" action="{{ route('instructor.courses.destroy', $course->id) }}" style="flex: 1;" onsubmit="return confirm('Are you sure you want to delete this course?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-delete" style="width: 100%;">
                    <i class="fas fa-trash"></i> Delete
                  </button>
                </form>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      <div class="pagination">
        {{ $courses->links() }}
      </div>
    @else
      <div class="empty-state">
        <i class="fas fa-book"></i>
        <h2>No Courses Yet</h2>
        <p>Start creating your first course to share knowledge with students</p>
        <a href="{{ route('instructor.courses.create') }}" class="btn-create">
          <i class="fas fa-plus"></i> Create Your First Course
        </a>
      </div>
    @endif
  </div>
</body>
</html>
