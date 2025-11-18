<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Browse Courses - AllnGrow</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/dashboardSiswa/browseCourses.css') }}">
</head>
<body>
  <!-- Sidebar -->
  <aside class="sidebar">
    <div class="logo">AllnGrow</div>
    <nav>
      <a href="{{ route('dashboardSiswa') }}"><i class="fas fa-home"></i> Dashboard</a>
      <a class="active"><i class="fas fa-search"></i> Browse Courses</a>
      <a href="{{ route('student.my-courses') }}"><i class="fas fa-book"></i> My Courses</a>
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
    <div class="header">
      <div>
        <h1>Browse Courses</h1>
        <p class="muted">Discover new courses and expand your knowledge</p>
      </div>
    </div>

    <!-- Search & Filter -->
    <div class="filter-section">
      <form method="GET" action="{{ route('student.browse-courses') }}" class="filter-form">
        <div class="search-box">
          <i class="fas fa-search"></i>
          <input type="text" name="search" placeholder="Search courses..." value="{{ request('search') }}">
        </div>
        
        <select name="category_id" onchange="this.form.submit()">
          <option value="">All Categories</option>
          @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
              {{ $category->name }}
            </option>
          @endforeach
        </select>
        
        <select name="price_filter" onchange="this.form.submit()">
          <option value="">All Prices</option>
          <option value="free" {{ request('price_filter') == 'free' ? 'selected' : '' }}>Free</option>
          <option value="paid" {{ request('price_filter') == 'paid' ? 'selected' : '' }}>Paid</option>
        </select>
        
        <select name="sort" onchange="this.form.submit()">
          <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
          <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Most Popular</option>
          <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
          <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
        </select>
      </form>
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

    <!-- Courses Grid -->
    <div class="courses-grid">
      @forelse($courses as $course)
        <div class="course-card">
          <div class="course-thumbnail">
            @if($course->thumbnail)
              <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="{{ $course->title }}">
            @else
              <div class="no-thumbnail">
                <i class="fas fa-book"></i>
              </div>
            @endif
            @if($course->price == 0)
              <span class="badge-free">Free</span>
            @endif
          </div>
          
          <div class="course-content">
            <div class="course-category">{{ $course->category->name ?? 'Uncategorized' }}</div>
            <h3 class="course-title">{{ $course->title }}</h3>
            
            <div class="course-instructor">
              <i class="fas fa-user-tie"></i>
              {{ $course->instructor->name ?? $course->instructor->email }}
            </div>
            
            <div class="course-meta">
              <span><i class="fas fa-book-open"></i> {{ $course->subcourses->count() }} Modules</span>
              <span><i class="fas fa-users"></i> {{ $course->students->count() }} Students</span>
            </div>
            
            <div class="course-footer">
              <div class="course-price">
                @if($course->price == 0)
                  Free
                @else
                  Rp {{ number_format($course->price, 0, ',', '.') }}
                @endif
              </div>
              
              @if(in_array($course->id, $enrolledCourseIds))
                <button class="btn-enrolled" disabled>
                  <i class="fas fa-check"></i> Enrolled
                </button>
              @else
                <form method="POST" action="{{ route('student.enroll', $course->id) }}" style="margin: 0;">
                  @csrf
                  <button type="submit" class="btn-enroll" onclick="return confirm('Are you sure you want to enroll in this course?')">
                    <i class="fas fa-plus"></i> Enroll Now
                  </button>
                </form>
              @endif
            </div>
          </div>
        </div>
      @empty
        <div class="empty-state">
          <i class="fas fa-search"></i>
          <p>No courses found</p>
        </div>
      @endforelse
    </div>

    <!-- Pagination -->
    @if($courses->hasPages())
      <div class="pagination">
        {{ $courses->links() }}
      </div>
    @endif
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
    }
    .sidebar nav a:hover, .sidebar nav a.active {
      background: #1a1a1a;
      color: #fff;
    }
    
    .main {
      margin-left: 260px;
      flex: 1;
      padding: 2rem;
    }
    
    .header {
      margin-bottom: 2rem;
    }
    
    .header h1 {
      font-size: 1.75rem;
      margin-bottom: 0.5rem;
    }
    
    .muted {
      color: #a3a3a3;
    }
    
    .filter-section {
      background: #0d0d0d;
      border: 1px solid #262626;
      border-radius: 12px;
      padding: 1.5rem;
      margin-bottom: 2rem;
    }
    
    .filter-form {
      display: grid;
      grid-template-columns: 2fr 1fr 1fr 1fr;
      gap: 1rem;
    }
    
    .search-box {
      position: relative;
      display: flex;
      align-items: center;
    }
    
    .search-box i {
      position: absolute;
      left: 1rem;
      color: #a3a3a3;
    }
    
    .search-box input {
      width: 100%;
      padding: 0.75rem 1rem 0.75rem 2.75rem;
      background: #000;
      border: 1px solid #262626;
      border-radius: 8px;
      color: #f5f5f5;
      font-size: 0.9rem;
    }
    
    select {
      padding: 0.75rem 1rem;
      background: #000;
      border: 1px solid #262626;
      border-radius: 8px;
      color: #f5f5f5;
      font-size: 0.9rem;
      cursor: pointer;
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
    
    .courses-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
      gap: 1.5rem;
      margin-bottom: 2rem;
    }
    
    .course-card {
      background: #0d0d0d;
      border: 1px solid #262626;
      border-radius: 12px;
      overflow: hidden;
      transition: all 0.3s;
    }
    
    .course-card:hover {
      border-color: #404040;
      transform: translateY(-4px);
    }
    
    .course-thumbnail {
      position: relative;
      width: 100%;
      height: 180px;
      background: #000;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    .course-thumbnail img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    
    .no-thumbnail {
      font-size: 3rem;
      color: #404040;
    }
    
    .badge-free {
      position: absolute;
      top: 0.75rem;
      right: 0.75rem;
      background: #4ade80;
      color: #000;
      padding: 0.25rem 0.75rem;
      border-radius: 6px;
      font-size: 0.75rem;
      font-weight: 600;
    }
    
    .course-content {
      padding: 1.25rem;
    }
    
    .course-category {
      font-size: 0.75rem;
      color: #a3a3a3;
      text-transform: uppercase;
      margin-bottom: 0.5rem;
    }
    
    .course-title {
      font-size: 1.1rem;
      margin-bottom: 0.75rem;
      color: #fff;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }
    
    .course-instructor {
      font-size: 0.85rem;
      color: #a3a3a3;
      margin-bottom: 0.75rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }
    
    .course-meta {
      display: flex;
      gap: 1rem;
      font-size: 0.85rem;
      color: #a3a3a3;
      margin-bottom: 1rem;
      padding-top: 0.75rem;
      border-top: 1px solid #262626;
    }
    
    .course-meta span {
      display: flex;
      align-items: center;
      gap: 0.4rem;
    }
    
    .course-footer {
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    
    .course-price {
      font-size: 1.25rem;
      font-weight: 700;
      color: #4ade80;
    }
    
    .btn-enroll {
      padding: 0.5rem 1rem;
      background: #fff;
      color: #000;
      border: none;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.2s;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      font-size: 0.85rem;
    }
    
    .btn-enroll:hover {
      background: #e5e5e5;
      transform: scale(1.05);
    }
    
    .btn-enrolled {
      padding: 0.5rem 1rem;
      background: #1a5a1a;
      color: #4ade80;
      border: none;
      border-radius: 8px;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      font-size: 0.85rem;
      cursor: not-allowed;
    }
    
    .empty-state {
      grid-column: 1 / -1;
      text-align: center;
      padding: 4rem 2rem;
      color: #a3a3a3;
    }
    
    .empty-state i {
      font-size: 4rem;
      margin-bottom: 1rem;
      opacity: 0.3;
    }
    
    .pagination {
      display: flex;
      justify-content: center;
    }
  </style>
</body>
</html>
