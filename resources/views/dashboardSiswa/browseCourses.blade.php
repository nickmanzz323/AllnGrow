<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Browse Courses - AllnGrow</title>
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
        <a href="{{ route('dashboardSiswa') }}"><i class="fas fa-home"></i> Dashboard</a>
        <a href="{{ route('student.my-courses') }}"><i class="fas fa-book"></i> My Courses</a>
        <a class="active"><i class="fas fa-search"></i> Browse Courses</a>
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
          <h1>Browse Courses</h1>
          <p class="muted">Explore and enroll in available courses</p>
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

      <!-- Search and Filter -->
      <section style="background: #0d0d0d; border: 1px solid #262626; border-radius: 12px; padding: 1.5rem; margin-bottom: 2rem;">
        <form method="GET" action="{{ route('student.browse-courses') }}" style="display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 1rem;">
          <div>
            <input type="text" name="search" placeholder="Search courses..." value="{{ request('search') }}" style="width: 100%; padding: 0.75rem; background: #000; border: 1px solid #262626; border-radius: 8px; color: #f5f5f5;">
          </div>
          <div>
            <select name="category_id" style="width: 100%; padding: 0.75rem; background: #000; border: 1px solid #262626; border-radius: 8px; color: #f5f5f5; cursor: pointer;">
              <option value="">All Categories</option>
              @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                  {{ $category->name }}
                </option>
              @endforeach
            </select>
          </div>
          <div>
            <select name="price_filter" style="width: 100%; padding: 0.75rem; background: #000; border: 1px solid #262626; border-radius: 8px; color: #f5f5f5; cursor: pointer;">
              <option value="">All Prices</option>
              <option value="free" {{ request('price_filter') == 'free' ? 'selected' : '' }}>Free</option>
              <option value="paid" {{ request('price_filter') == 'paid' ? 'selected' : '' }}>Paid</option>
            </select>
          </div>
          <button type="submit" style="padding: 0.75rem; background: #fff; color: #000; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; transition: all 0.2s;">
            <i class="fas fa-search"></i> Search
          </button>
        </form>
      </section>

      <!-- Courses Grid -->
      <section class="section">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
          <h2 style="margin: 0;">Available Courses ({{ $courses->total() }})</h2>
          <select name="sort" onchange="window.location.href='{{ route('student.browse-courses') }}?sort=' + this.value + '{{ request('search') ? '&search=' . request('search') : '' }}{{ request('category_id') ? '&category_id=' . request('category_id') : '' }}{{ request('price_filter') ? '&price_filter=' . request('price_filter') : '' }}'" style="padding: 0.5rem 1rem; background: #0d0d0d; border: 1px solid #262626; border-radius: 8px; color: #f5f5f5; cursor: pointer;">
            <option value="latest" {{ request('sort') == 'latest' || !request('sort') ? 'selected' : '' }}>Latest</option>
            <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Most Popular</option>
            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
          </select>
        </div>

        @if($courses->count() > 0)
          <div class="course-grid">
            @foreach($courses as $course)
              <article class="course">
                <div class="thumb" style="position: relative;">
                  @if($course->thumbnail)
                    <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="{{ $course->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                  @else
                    <div style="width: 100%; height: 100%; background: #1a1a1a; display: flex; align-items: center; justify-content: center;">
                      <i class="fas fa-book" style="font-size: 3rem; color: #404040;"></i>
                    </div>
                  @endif
                  @if($course->price == 0)
                    <span style="position: absolute; top: 0.5rem; right: 0.5rem; background: #4ade80; color: #000; padding: 0.25rem 0.75rem; border-radius: 6px; font-size: 0.75rem; font-weight: 600;">Free</span>
                  @endif
                </div>
                <div class="course-body">
                  <div style="font-size: 0.75rem; color: #a3a3a3; text-transform: uppercase; margin-bottom: 0.5rem;">
                    {{ $course->category->name ?? 'Uncategorized' }}
                  </div>
                  <h3>{{ $course->title }}</h3>
                  <p class="meta">
                    <i class="fas fa-user-circle"></i> 
                    {{ $course->instructor->detail->fullname ?? $course->instructor->name ?? $course->instructor->email }}
                  </p>
                  <div style="display: flex; gap: 1rem; font-size: 0.85rem; color: #a3a3a3; margin-bottom: 1rem;">
                    <span><i class="fas fa-book-open"></i> {{ $course->subcourses->count() }} Modules</span>
                    <span><i class="fas fa-users"></i> {{ $course->students->count() }} Students</span>
                  </div>
                  <div style="display: flex; align-items: center; justify-content: space-between; padding-top: 1rem; border-top: 1px solid #262626;">
                    <div style="font-size: 1.25rem; font-weight: 700; color: #4ade80;">
                      @if($course->price == 0)
                        Free
                      @else
                        Rp {{ number_format($course->price, 0, ',', '.') }}
                      @endif
                    </div>
                    
                    @if(in_array($course->courseID, $enrolledCourseIds))
                      <button disabled style="padding: 0.5rem 1rem; background: #1a5a1a; color: #4ade80; border: none; border-radius: 8px; font-weight: 600; display: flex; align-items: center; gap: 0.5rem; font-size: 0.85rem; cursor: not-allowed;">
                        <i class="fas fa-check"></i> Enrolled
                      </button>
                    @else
                      <form method="POST" action="{{ route('student.enroll', $course->courseID) }}" style="margin: 0;">
                        @csrf
                        <button type="submit" onclick="return confirm('Are you sure you want to enroll in this course?')" style="padding: 0.5rem 1rem; background: #fff; color: #000; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; transition: all 0.2s; display: flex; align-items: center; gap: 0.5rem; font-size: 0.85rem;">
                          <i class="fas fa-plus"></i> Enroll Now
                        </button>
                      </form>
                    @endif
                  </div>
                </div>
              </article>
            @endforeach
          </div>

          <!-- Pagination -->
          @if($courses->hasPages())
            <div style="margin-top: 2rem;">
              {{ $courses->links() }}
            </div>
          @endif
        @else
          <div style="text-align: center; padding: 4rem 2rem; color: #a3a3a3;">
            <i class="fas fa-search" style="font-size: 4rem; margin-bottom: 1rem; opacity: 0.3;"></i>
            <p style="font-size: 1.1rem; margin-bottom: 0.5rem;">No courses found</p>
            <p style="font-size: 0.9rem;">Try adjusting your search or filters.</p>
          </div>
        @endif
      </section>
    </main>
  </div>

  <script>
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
