<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Browse Courses - AllnGrow</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/dashboardSiswa/dashboardSiswa.css') }}">
  <style>
    /* Flash messages (success / error) */
    .flash-message {
      padding: 1rem;
      border-radius: 8px;
      margin-bottom: 1.5rem;
      display: flex;
      align-items: center;
      gap: 0.75rem;
      background: #111111;
      border: 1px solid #333333;
      color: #f5f5f5;
      font-size: 0.9rem;
    }

    .flash-message i {
      font-size: 1rem;
      color: #f5f5f5;
    }

    /* Enhanced Filter Styles – black & white */
    .filter-container {
      background: linear-gradient(135deg, #0d0d0d 0%, #1a1a1a 100%);
      border: 1px solid #262626;
      border-radius: 16px;
      padding: 2rem;
      margin-bottom: 2rem;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
    }

    .filter-header {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      margin-bottom: 1.5rem;
      padding-bottom: 1rem;
      border-bottom: 1px solid #262626;
    }

    .filter-header i {
      font-size: 1.25rem;
      color: #f5f5f5;
    }

    .filter-header h3 {
      margin: 0;
      font-size: 1.1rem;
      font-weight: 600;
      color: #f5f5f5;
    }

    .filter-grid {
      display: grid;
      grid-template-columns: 2fr 1fr 1fr auto;
      gap: 1rem;
      align-items: end;
    }

    .filter-group {
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
    }

    .filter-label {
      font-size: 0.85rem;
      font-weight: 600;
      color: #a3a3a3;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .filter-label i {
      color: #f5f5f5;
      font-size: 0.9rem;
    }

    .filter-input {
      width: 100%;
      padding: 0.875rem 1rem;
      background: #000000;
      border: 2px solid #262626;
      border-radius: 10px;
      color: #f5f5f5;
      font-size: 0.95rem;
      transition: all 0.3s ease;
      outline: none;
    }

    .filter-input:focus {
      border-color: #ffffff;
      box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.08);
    }

    .filter-input:hover {
      border-color: #404040;
    }

    .filter-select {
      width: 100%;
      padding: 0.875rem 1rem;
      background: #000000;
      border: 2px solid #262626;
      border-radius: 10px;
      color: #f5f5f5;
      font-size: 0.95rem;
      cursor: pointer;
      transition: all 0.3s ease;
      outline: none;
      appearance: none;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23a3a3a3' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 1rem center;
      padding-right: 2.5rem;
    }

    .filter-select:focus {
      border-color: #ffffff;
      box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.08);
    }

    .filter-select:hover {
      border-color: #404040;
    }

    .filter-select option {
      background: #000000;
      color: #f5f5f5;
      padding: 0.5rem;
    }

    .search-btn {
      padding: 0.875rem 2rem;
      background: linear-gradient(135deg, #ffffff 0%, #e5e5e5 100%);
      color: #000000;
      border: none;
      border-radius: 10px;
      font-weight: 700;
      font-size: 0.95rem;
      cursor: pointer;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
      white-space: nowrap;
    }

    .search-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 16px rgba(0, 0, 0, 0.6);
      background: linear-gradient(135deg, #ffffff 0%, #f0f0f0 100%);
    }

    .search-btn:active {
      transform: translateY(0);
    }

    .search-btn i {
      font-size: 1rem;
    }

    .filter-tags {
      display: flex;
      flex-wrap: wrap;
      gap: 0.5rem;
      margin-top: 1rem;
      padding-top: 1rem;
      border-top: 1px solid #262626;
    }

    .filter-tag {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      padding: 0.5rem 0.875rem;
      background: #1a1a1a;
      border: 1px solid #262626;
      border-radius: 8px;
      font-size: 0.85rem;
      color: #f5f5f5;
      transition: all 0.2s;
    }

    .filter-tag:hover {
      background: #262626;
    }

    .filter-tag i {
      color: #f5f5f5;
      font-size: 0.75rem;
    }

    .filter-tag .remove-tag {
      cursor: pointer;
      color: #d4d4d4;
      margin-left: 0.25rem;
      transition: transform 0.2s;
    }

    .filter-tag .remove-tag:hover {
      transform: scale(1.2);
    }

    .clear-filters {
      padding: 0.5rem 1rem;
      background: transparent;
      border: 1px solid #404040;
      border-radius: 8px;
      color: #a3a3a3;
      font-size: 0.85rem;
      cursor: pointer;
      transition: all 0.2s;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
    }

    .clear-filters:hover {
      background: #1a1a1a;
      border-color: #ffffff;
      color: #ffffff;
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
      .filter-grid {
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
      }

      .search-btn {
        grid-column: span 2;
      }
    }

    @media (max-width: 640px) {
      .filter-grid {
        grid-template-columns: 1fr;
      }

      .search-btn {
        grid-column: span 1;
        justify-content: center;
      }
    }

    /* Sort Dropdown Enhancement */
    .sort-dropdown {
      padding: 0.625rem 1.25rem;
      background: #0d0d0d;
      border: 2px solid #262626;
      border-radius: 10px;
      color: #f5f5f5;
      font-size: 0.9rem;
      cursor: pointer;
      transition: all 0.3s ease;
      outline: none;
      appearance: none;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23a3a3a3' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 1rem center;
      padding-right: 2.5rem;
    }

    .sort-dropdown:hover {
      border-color: #404040;
    }

    .sort-dropdown:focus {
      border-color: #ffffff;
      box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.08);
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
        <a href="{{ route('student.my-courses') }}"><i class="fas fa-book"></i> My Courses</a>
        <a class="active"><i class="fas fa-search"></i> Browse Courses</a>
        <a href="{{ route('schedule') }}"><i class="fas fa-calendar"></i> Schedule</a>
        <a href="{{ route('progress') }}"><i class="fas fa-chart-line"></i> Progress</a>
        <a href="{{ route('settings') }}"><i class="fas fa-cog"></i> Settings</a>
        <div style="margin-top: auto; padding-top: 2rem; border-top: 1px solid #262626;">
          <form method="POST" action="{{ route('student.logout') }}">
            @csrf
            <button
              type="submit"
              style="width: 100%; text-align: left; background: none; border: none; color: #f5f5f5; cursor: pointer; font: inherit; padding: 0.75rem 1rem; display: flex; align-items: center; gap: 0.75rem; transition: all 0.2s; border-radius: 8px;"
              onmouseover="this.style.background='#1a1a1a'; this.style.color='#ffffff'"
              onmouseout="this.style.background=''; this.style.color='#f5f5f5'"
            >
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
        <div class="flash-message" data-auto-dismiss="true">
          <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
      @endif

      @if(session('error'))
        <div class="flash-message" data-auto-dismiss="true">
          <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
        </div>
      @endif

      <!-- Enhanced Search and Filter -->
      <section class="filter-container">
        <div class="filter-header">
          <i class="fas fa-filter"></i>
          <h3>Filter & Search Courses</h3>
        </div>

        <form method="GET" action="{{ route('student.browse-courses') }}" id="filterForm">
          <div class="filter-grid">
            <!-- Search Input -->
            <div class="filter-group">
              <label class="filter-label">
                <i class="fas fa-search"></i>
                Search
              </label>
              <input 
                type="text" 
                name="search" 
                class="filter-input"
                placeholder="Search by course name or keyword..." 
                value="{{ request('search') }}"
              >
            </div>

            <!-- Category Filter -->
            <div class="filter-group">
              <label class="filter-label">
                <i class="fas fa-tag"></i>
                Category
              </label>
              <select name="category_id" class="filter-select">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                  <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                  </option>
                @endforeach
              </select>
            </div>

            <!-- Price Filter -->
            <div class="filter-group">
              <label class="filter-label">
                <i class="fas fa-dollar-sign"></i>
                Price
              </label>
              <select name="price_filter" class="filter-select">
                <option value="">All Prices</option>
                <option value="free" {{ request('price_filter') == 'free' ? 'selected' : '' }}>Free Courses</option>
                <option value="paid" {{ request('price_filter') == 'paid' ? 'selected' : '' }}>Paid Courses</option>
              </select>
            </div>

            <!-- Search Button -->
            <button type="submit" class="search-btn">
              <i class="fas fa-search"></i>
              Search
            </button>
          </div>

          <!-- Active Filter Tags -->
          @if(request('search') || request('category_id') || request('price_filter'))
            <div class="filter-tags">
              @if(request('search'))
                <span class="filter-tag">
                  <i class="fas fa-search"></i>
                  "{{ request('search') }}"
                  <span class="remove-tag" onclick="removeFilter('search')">×</span>
                </span>
              @endif

              @if(request('category_id'))
                <span class="filter-tag">
                  <i class="fas fa-tag"></i>
                  {{ $categories->firstWhere('id', request('category_id'))->name ?? 'Category' }}
                  <span class="remove-tag" onclick="removeFilter('category_id')">×</span>
                </span>
              @endif

              @if(request('price_filter'))
                <span class="filter-tag">
                  <i class="fas fa-dollar-sign"></i>
                  {{ request('price_filter') == 'free' ? 'Free Courses' : 'Paid Courses' }}
                  <span class="remove-tag" onclick="removeFilter('price_filter')">×</span>
                </span>
              @endif

              <button type="button" class="clear-filters" onclick="clearAllFilters()">
                <i class="fas fa-times"></i>
                Clear All
              </button>
            </div>
          @endif
        </form>
      </section>

      <!-- Courses Grid -->
      <section class="section">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
          <h2 style="margin: 0;">Available Courses ({{ $courses->total() }})</h2>
          <div style="display: flex; align-items: center; gap: 0.75rem;">
            <span style="color: #a3a3a3; font-size: 0.9rem;">
              <i class="fas fa-sort"></i> Sort by:
            </span>
            <select 
              name="sort" 
              class="sort-dropdown"
              onchange="window.location.href='{{ route('student.browse-courses') }}?sort=' + this.value + '{{ request('search') ? '&search=' . request('search') : '' }}{{ request('category_id') ? '&category_id=' . request('category_id') : '' }}{{ request('price_filter') ? '&price_filter=' . request('price_filter') : '' }}'"
            >
              <option value="latest" {{ request('sort') == 'latest' || !request('sort') ? 'selected' : '' }}>Latest First</option>
              <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Most Popular</option>
              <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
              <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
            </select>
          </div>
        </div>

        @if($courses->count() > 0)
          <div class="course-grid">
            @foreach($courses as $course)
              <article class="course" style="cursor: pointer; transition: all 0.2s;">
                <a href="{{ route('student.course-overview', $course->courseID) }}" style="text-decoration: none; color: inherit; display: block;">
                  <div class="thumb" style="position: relative;">
                    @if($course->thumbnail)
                      <img src="{{ Storage::url($course->thumbnail) }}" alt="{{ $course->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                      <div style="width: 100%; height: 100%; background: #1a1a1a; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-book" style="font-size: 3rem; color: #404040;"></i>
                      </div>
                    @endif
                    @if($course->price == 0)
                      <span style="position: absolute; top: 0.5rem; right: 0.5rem; background: #ffffff; color: #000000; padding: 0.25rem 0.75rem; border-radius: 6px; font-size: 0.75rem; font-weight: 600;">Free</span>
                    @endif
                  </div>
                  <div class="course-body">
                    <div style="font-size: 0.75rem; color: #a3a3a3; text-transform: uppercase; margin-bottom: 0.5rem;">
                      {{ $course->category->name ?? 'Uncategorized' }}
                    </div>
                    <h3>{{ $course->title }}</h3>
                    <p class="meta">
                      <i class="fas fa-user-circle"></i>
                      {{ $course->instructor->detail->fullname ?? $course->instructor->name ?? $course->instructor->email ?? 'Instructor' }}
                    </p>
                    <div style="display: flex; gap: 1rem; font-size: 0.85rem; color: #a3a3a3; margin-bottom: 1rem;">
                      <span><i class="fas fa-book"></i> {{ $course->chapters->count() }} Bab</span>
                      <span><i class="fas fa-users"></i> {{ $course->students->count() }} Siswa</span>
                    </div>
                    <div style="display: flex; align-items: center; justify-content: space-between; padding-top: 1rem; border-top: 1px solid #262626;">
                      <div style="font-size: 1.25rem; font-weight: 700; color: #f5f5f5;">
                        @if($course->price == 0)
                          Free
                        @else
                          Rp {{ number_format($course->price, 0, ',', '.') }}
                        @endif
                      </div>

                      @if(in_array($course->courseID, $enrolledCourseIds))
                        <span style="padding: 0.5rem 1rem; background: #1f1f1f; color: #f5f5f5; border-radius: 8px; font-weight: 600; display: flex; align-items: center; gap: 0.5rem; font-size: 0.85rem;">
                          <i class="fas fa-check"></i> Enrolled
                        </span>
                      @else
                        <span style="padding: 0.5rem 1rem; background: #ffffff; color: #000000; border-radius: 8px; font-weight: 600; display: flex; align-items: center; gap: 0.5rem; font-size: 0.85rem;">
                          <i class="fas fa-eye"></i> View Details
                        </span>
                      @endif
                    </div>
                  </div>
                </a>
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
      document.querySelectorAll('[data-auto-dismiss="true"]').forEach(alert => {
        alert.style.transition = 'opacity 0.3s';
        alert.style.opacity = '0';
        setTimeout(() => alert.remove(), 300);
      });
    }, 5000);

    // Remove individual filter
    function removeFilter(filterName) {
      const form = document.getElementById('filterForm');
      const input = form.querySelector(`[name="${filterName}"]`);
      if (input) {
        input.value = '';
        form.submit();
      }
    }

    // Clear all filters
    function clearAllFilters() {
      window.location.href = '{{ route('student.browse-courses') }}';
    }
  </script>
</body>
</html>
