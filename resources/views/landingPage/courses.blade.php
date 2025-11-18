<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>AllnGrow - Explore Courses</title>

  <!-- Styles -->
  <link rel="stylesheet" href="css/landingPage/landing.css" />
  <link rel="stylesheet" href="css/landingPage/courses.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
  <!-- HEADER -->
  <header class="header">
    <div class="header-content">
      <div class="logo">
        <img src="images/allngrowlogo.svg" alt="AllnGrow Logo" width="155" />
      </div>

      <nav class="nav-menu">
        <a href="{{ route('home') }}"
           class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
          Home
        </a>

        <a href="{{ route('about') }}"
           class="nav-item" role="menuitem">
          About us
        </a>

        <a href="{{ route('courses') }}"
           class="nav-item {{ request()->routeIs('courses') ? 'active' : '' }}">
          Courses
        </a>

        <a href="{{ route('student.login') }}"
           class="nav-item {{ request()->routeIs('student.login') ? 'active' : '' }}">
          Get Started
        </a>
      </nav>
    </div>
  </header>

  <!-- SEARCH + FILTER -->
  <section class="search-section">
    <h2 class="fade-up">Explore Courses</h2>

    <!-- Search -->
    <div class="search-box fade-up">
      <form action="{{ route('courses.search') }}" method="GET" class="d-flex w-100">
        <input type="text"
               name="search"
               placeholder="Search courses..."
               value="{{ request('search') }}"
               class="form-control" />
        <button class="search-btn" type="submit">
          <i class="fa fa-search"></i>
        </button>
      </form>
    </div>

    <!-- Filters -->
    <div class="filters fade-up mt-5 mb-4">
      <!-- Category -->
      <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle"
                type="button"
                data-bs-toggle="dropdown"
                aria-expanded="false">
          {{ request('category') ? request('category') : 'All Categories' }}
        </button>

        <ul class="dropdown-menu" style="max-height: 400px; overflow-y: auto;">
          <li>
            <a class="dropdown-item {{ !request('category') ? 'active' : '' }}"
               href="{{ route('courses.search', request()->except('category')) }}">
               All Categories
            </a>
          </li>
          <li><hr class="dropdown-divider" style="border-color: #333;"></li>

          @foreach($categories as $cat)
            <li>
              <a class="dropdown-item {{ request('category') == $cat->name ? 'active' : '' }}"
                 href="{{ route('courses.search', array_merge(request()->except('category'), ['category' => $cat->name])) }}">
                {{ $cat->name }}
              </a>
            </li>
          @endforeach
        </ul>
      </div>

      <!-- Partner -->
      <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle"
                type="button"
                data-bs-toggle="dropdown"
                aria-expanded="false">
          {{ request('partner') ? request('partner') : 'All Partners' }}
        </button>

        <ul class="dropdown-menu" style="max-height: 400px; overflow-y: auto;">
          <li>
            <a class="dropdown-item {{ !request('partner') ? 'active' : '' }}"
               href="{{ route('courses.search', request()->except('partner')) }}">
               All Partners
            </a>
          </li>
          <li><hr class="dropdown-divider" style="border-color: #333;"></li>

          @foreach($partners as $partner)
            <li>
              <a class="dropdown-item {{ request('partner') == $partner->name ? 'active' : '' }}"
                 href="{{ route('courses.search', array_merge(request()->except('partner'), ['partner' => $partner->name])) }}">
                {{ $partner->name }}
              </a>
            </li>
          @endforeach
        </ul>
      </div>

      <!-- Price Filter -->
      <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle"
                type="button"
                data-bs-toggle="dropdown"
                aria-expanded="false">
          {{ request('price') == 'free' ? 'Free' : (request('price') == 'paid' ? 'Paid' : 'All Prices') }}
        </button>

        <ul class="dropdown-menu">
          <li>
            <a class="dropdown-item {{ !request('price') ? 'active' : '' }}"
               href="{{ route('courses.search', request()->except('price')) }}">
               All Prices
            </a>
          </li>
          <li><hr class="dropdown-divider" style="border-color: #333;"></li>
          <li>
            <a class="dropdown-item {{ request('price') == 'free' ? 'active' : '' }}"
               href="{{ route('courses.search', array_merge(request()->except('price'), ['price' => 'free'])) }}">
              Free
            </a>
          </li>
          <li>
            <a class="dropdown-item {{ request('price') == 'paid' ? 'active' : '' }}"
               href="{{ route('courses.search', array_merge(request()->except('price'), ['price' => 'paid'])) }}">
              Paid
            </a>
          </li>
        </ul>
      </div>
    </div>

    <!-- Active filters -->
    <div class="active-filters mb-3">
      @if(request('search'))
        <span class="badge bg-primary">
          Search: "{{ request('search') }}"
          <a href="{{ route('courses.search', request()->except('search')) }}"
             class="text-white ms-1"
             style="text-decoration: none;">&times;</a>
        </span>
      @endif

      @if(request('category'))
        <span class="badge bg-success">
          Category: {{ request('category') }}
          <a href="{{ route('courses.search', request()->except('category')) }}"
             class="text-white ms-1"
             style="text-decoration: none;">&times;</a>
        </span>
      @endif

      @if(request('partner'))
        <span class="badge bg-warning text-dark">
          Partner: {{ request('partner') }}
          <a href="{{ route('courses.search', request()->except('partner')) }}"
             class="text-dark ms-1"
             style="text-decoration: none;">&times;</a>
        </span>
      @endif

      @if(request('price'))
        <span class="badge bg-info">
          Price: {{ ucfirst(request('price')) }}
          <a href="{{ route('courses.search', request()->except('price')) }}"
             class="text-white ms-1"
             style="text-decoration: none;">&times;</a>
        </span>
      @endif

      @if(request()->hasAny(['search','category','partner','price']))
        <a href="{{ route('courses') }}"
           class="btn btn-outline-secondary btn-sm ms-2">
          Clear All
        </a>
      @endif
    </div>

    <!-- Results count -->
    <div class="results-count fade-up" style="color: #9ca3af; font-size: 0.9rem;">
      @if($courses->count() > 0)
        Showing {{ $courses->count() }} courses
        @if(request()->hasAny(['search','category','partner','price']))
          with current filters
        @endif
      @endif
    </div>
  </section>

  <!-- COURSES SECTION -->
  <section class="courses-section mt-4">
    <!-- RESULT GRID (Explore Courses) -->
    <div class="courses-result-wrapper">
      @if($courses->count() > 0)
        <div class="courses-result-grid stagger-children">
          @foreach($courses as $course)
            @include('components.course-card', ['course' => $course])
          @endforeach
        </div>
      @else
        <div class="empty-state-container">
          <i class="fas fa-search" style="font-size: 3rem; color: #333; margin-bottom: 1rem;"></i>
          <p class="empty-state-text">No courses found</p>
          <p style="color: #666; font-size: 0.9rem;">Try adjusting your search or filter criteria</p>
          <a href="{{ route('courses') }}" class="btn btn-outline-light btn-sm mt-3">
            Clear Filters
          </a>
        </div>
      @endif
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
      {{ $courses->links() }}
    </div>

    <!-- TOP COURSES GRID 3 x 3 -->
    <div class="courses-header fade-up">
      <h2 class="courses-title">Explore Our Courses</h2>
      <div class="courses-badge">Top Popular Course</div>
    </div>

    <div class="courses-scroll-wrapper">
      <div class="courses-grid stagger-children">
        <!-- Example cards -->
        <article class="course-card">
          <img src="images/dataPic.png"
               alt="IT Statistics Data Science course"
               class="course-image" />

          <div class="course-rating">
            <img src="images/starSymbol.png"
                 alt="5 star rating"
                 width="78"
                 height="14" />
            <span>4.5k</span>
          </div>

          <h3 class="course-title">
            It Statistics Data Science And Business Analysis
          </h3>

          <div class="course-meta">
            <span>
              <img src="images/timeSymbol.png" alt="Duration" width="18" />
              19h 30m
            </span>
            <span>
              <img src="images/user.png" alt="Students" width="18" />
              Students 20+
            </span>
          </div>
        </article>

        <article class="course-card">
          <img src="images/adobePic.png"
               alt="Adobe Illustrator course"
               class="course-image" />

          <div class="course-rating">
            <img src="images/starSymbol.png"
                 alt="5 star rating"
                 width="78"
                 height="14" />
            <span>4.5k</span>
          </div>

          <h3 class="course-title">
            Beginner Adobe Illustrator For Graphic Design
          </h3>

          <div class="course-meta">
            <span>
              <img src="images/timeSymbol.png" alt="Duration" width="18" />
              19h 30m
            </span>
            <span>
              <img src="images/user.png" alt="Students" width="18" />
              Students 20+
            </span>
          </div>
        </article>

        <article class="course-card">
          <img src="images/pianoPic.png"
               alt="Classical Music Piano course"
               class="course-image" />

          <div class="course-rating">
            <img src="images/starSymbol.png"
                 alt="5 star rating"
                 width="78"
                 height="14" />
            <span>4.5k</span>
          </div>

          <h3 class="course-title">
            Classical Music : Piano
          </h3>

          <div class="course-meta">
            <span>
              <img src="images/timeSymbol.png" alt="Duration" width="18" />
              19h 30m
            </span>
            <span>
              <img src="images/user.png" alt="Students" width="18" />
              Students 20+
            </span>
          </div>
        </article>

        <!-- Tambahkan card lain sesuai kebutuhan -->
      </div>
    </div>
  </section>

  <!-- CATEGORIES -->
  <section class="categories-section">
    <h2 class="categories-title fade-up">Browse By Categories</h2>

    <div class="categories-grid stagger-children">
      <div class="category-item">
        <a href="#">
          <div class="category-icon">
            <img src="images/bnfIcon.png" alt="Business icon" />
          </div>
          <div class="category-name">Business & Finance</div>
        </a>
      </div>

      <div class="category-item">
        <div class="category-icon">
          <img src="images/mnpIcon.png" alt="Music icon" />
        </div>
        <div class="category-name">Music & Perform Arts</div>
      </div>

      <div class="category-item">
        <div class="category-icon">
          <img src="images/ITicon.png" alt="IT icon" />
        </div>
        <div class="category-name">IT</div>
      </div>

      <div class="category-item">
        <div class="category-icon">
          <img src="images/andIcon.png" alt="Art icon" />
        </div>
        <div class="category-name">Art & Design</div>
      </div>

      <div class="category-item">
        <div class="category-icon">
          <img src="images/lnwIcon.png" alt="Language icon" />
        </div>
        <div class="category-name">Language & Writing</div>
      </div>

      <div class="category-item">
        <div class="category-icon">
          <img src="images/lndIcon.png" alt="Lifestyle icon" />
        </div>
        <div class="category-name">Lifestyle & Development</div>
      </div>

      <div class="category-item">
        <div class="category-icon">
          <img src="images/cncIcon.png" alt="Cooking icon" />
        </div>
        <div class="category-name">Cooking & Culinary</div>
      </div>

      <div class="category-item">
        <div class="category-icon">
          <img src="images/pcIcon.png" alt="Professional icon" />
        </div>
        <div class="category-name">Professional Certification</div>
      </div>

      <div class="category-item">
        <div class="category-icon">
          <img src="images/hndIcon.png" alt="Health icon" />
        </div>
        <div class="category-name">Health & Sports</div>
      </div>
    </div>
  </section>

  <!-- ANIMATION SCRIPT -->
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const sections = document.querySelectorAll(".fade-up, .stagger-children");

      const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add("visible");
          }
        });
      }, {
        threshold: 0.1,
      });

      sections.forEach((section) => observer.observe(section));
    });
  </script>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
