<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>AllnGrow - Explore Courses</title>
  <link rel="stylesheet" href="css/landing.css" />
  <link rel="stylesheet" href="css/courses.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">



  </head>
      <header class="header">
        <div class="header-content">
          <div class="logo">
            <img src="images/allngrowlogo.svg" alt="AllnGrow Logo" width="155" height="auto">
          </div>
          <nav class="nav-menu">
            <a href="{{ route('home') }}" class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
            <a href="{{ route('about') }}" class="nav-item" role="menuitem">About us</a>
            <a href="{{ route('courses') }}" class="nav-item {{ request()->routeIs('courses') ? 'active' : '' }}">Courses</a>
            <a href="{{ route('student.login') }}" class="nav-item {{ request()->routeIs('student.login') ? 'active' : '' }}">Get Started</a>
          </nav>
        </div>
      </header>
      </div>
    </header>

  <section class="search-section">
    <h2 class="fade-up">Explore Courses</h2>
    <!-- <div class="search-box fade-up">
      <input type="text" placeholder="Search ...">
      <button class="search-btn"><i class="fa fa-search"></i></button>
    </div> -->

    <!-- search -->
    <div class="search-box fade-up">
      <form action="{{ route('courses.search') }}" method="GET" class="d-flex w-100">
        <input type="text" name="search" placeholder="Search ..." class="form-control">
        <button class="search-btn" type="submit"><i class="fa fa-search"></i></button>
    </div>
    <style>
      .form-control:focus {
        box-shadow: none;
        outline: none;
        border-color: #ccc;
      }

      .courses-wrapper-3col .courses-grid {
          display: grid;
          grid-template-columns: repeat(3, 1fr);
          gap: 24px;
          overflow-x: unset; /* memastikan tidak scroll horizontal */
      }
    </style>

      <!-- filter by -->
    <div class="filters fade-up dropdown mt-5 mb-5">
      
    <!-- category -->
      <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color:white; color:#767676">
        Categories
      </button>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{route('courses.search')}}">All</a></li>
        @foreach($categories as $cat)
          <li><a class="dropdown-item"
              href="{{ route('courses.search') . '?' . http_build_query(array_merge(request()->query(), ['category' => $cat->name])) }}">
              {{ $cat->name }}
            </a></li>
        @endforeach
      </ul>

      <!-- partner -->
      <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color:white; color:#767676">
        Partner
      </button>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{route('courses.search')}}">All</a></li>
        @foreach($partners as $partner)
            <li>
                <a class="dropdown-item" href="{{ route('courses.search') . '?' . http_build_query(array_merge(request()->query(), ['partner' => $partner->name])) }}">
                    {{ $partner->name }}
                </a>
            </li>
        @endforeach
      </ul>
    </div>

    </form>
        <div class="active-filters mb-3">
        @if(request('search'))
            <span class="badge bg-primary">
                Search: "{{ request('search') }}"
                <a href="{{ route('courses.search', request()->except('search')) }}" class="text-white ms-1" style="decoration:None;">&times;</a>
            </span>
        @endif

        @if(request('category'))
            <span class="badge bg-success">
                Category: {{ request('category') }}
                <a href="{{ route('courses.search', request()->except('category')) }}" class="text-white ms-1" style="decoration:None;">&times;</a>
            </span>
        @endif

        @if(request('partner'))
            <span class="badge bg-warning text-dark">
                Partner: {{ request('partner') }}
                <a href="{{ route('courses.search', request()->except('partner')) }}" class="text-dark ms-1" style="decoration:None;">&times;</a>
            </span>
        @endif

        @if(request()->hasAny(['search','category','partner']))
            <a href="{{ route('courses.search') }}" class="btn btn-outline-secondary btn-sm ms-2" style="background-color:white;">Clear All</a>
        @endif
    </div>

    <!-- <div class="filters fade-up">
      <select>
        <option>Categories</option>
      </select>
      <select>
        <option>Partner</option>
      </select>
    </div> -->
  </section>

  <section class="courses-section mt-8">

  <!-- result searched coureses -->
    <div class="courses-wrapper-3col">
      <div class="courses-grid stagger-children">
        @if($courses->count()>0)
          @foreach($courses as $course)
              @include('components.course-card', ['course'=>$course])
          @endforeach
        @else
          <p class="text-center w-100" style="grid-column: 1 / -1; font-size: 1.2rem; color: #555;">
            Courses not found...
          </p>
        @endif
      </div>
    </div>
    <!-- pagination (prev, next) -->
    <div class="d-flex justify-content-center mt-4">
        {{ $courses->links() }}
    </div>

    <!-- explore top courses -->
    <div class="courses-header fade-up">
      <h2 class="courses-title">Explore Our Courses</h2>
      <div class="courses-badge">Top Popular Course</div>
    </div>
    
    <div class="courses-scroll-wrapper">
      <div class="courses-grid stagger-children">
        <article class="course-card">
          <img src="images/dataPic.png" alt="IT Statistics Data Science course" class="course-image" />
          <div class="course-rating">
            <img src="images/starSymbol.png" alt="5 star rating" width="78" height="14" />
            <span>4.5k</span>
          </div>
          <h3 class="course-title">It Statistics Data Science And Business Analysis</h3>
          <div class="course-meta">
            <span><img src="images/timeSymbol.png" alt="Duration" width="32" height="14" /> 19h 30m</span>
            <span><img src="images/user.png" alt="Students" width="30" height="14" /> Students 20+</span>
          </div>
        </article>
        <article class="course-card">
          <img src="images/adobePic.png" alt="Adobe Illustrator course" class="course-image" />
          <div class="course-rating">
            <img src="images/starSymbol.png" alt="5 star rating" width="78" height="14" />
            <span>4.5k</span>
          </div>
          <h3 class="course-title">Beginner Adobe Illustrator For Graphic Design</h3>
          <div class="course-meta">
            <span><img src="images/timeSymbol.png" alt="Duration" width="32" height="14" /> 19h 30m</span>
            <span><img src="images/user.png" alt="Students" width="30" height="14" /> Students 20+</span>
          </div>
        </article>
        <article class="course-card">
          <img src="images/pianoPic.png" alt="Classical Music Piano course" class="course-image" />
          <div class="course-rating">
            <img src="images/starSymbol.png" alt="5 star rating" width="78" height="14" />
            <span>4.5k</span>
          </div>
          <h3 class="course-title">Classical Music : Piano</h3>
          <div class="course-meta">
            <span><img src="images/timeSymbol.png" alt="Duration" width="32" height="14" /> 19h 30m</span>
            <span><img src="images/user.png" alt="Students" width="30" height="14" /> Students 20+</span>
          </div>
        </article>
        <article class="course-card">
            <img src="images/dataPic.png" alt="IT Statistics Data Science course" class="course-image" />
            <div class="course-rating">
                <img src="images/starSymbol.png" alt="5 star rating" width="78" height="14" />
                <span>4.5k</span>
            </div>
            <h3 class="course-title">It Statistics Data Science And Business Analysis</h3>
            <div class="course-meta">
                <span><img src="images/timeSymbol.png" alt="Duration" width="32" height="14" /> 19h 30m</span>
                <span><img src="images/user.png" alt="Students" width="30" height="14" /> Students 20+</span>
            </div>
        </article>
        <article class="course-card">
            <img src="images/dataPic.png" alt="IT Statistics Data Science course" class="course-image" />
            <div class="course-rating">
                <img src="images/starSymbol.png" alt="5 star rating" width="78" height="14" />
                <span>4.5k</span>
            </div>
            <h3 class="course-title">It Statistics Data Science And Business Analysis</h3>
            <div class="course-meta">
                <span><img src="images/timeSymbol.png" alt="Duration" width="32" height="14" /> 19h 30m</span>
                <span><img src="images/user.png" alt="Students" width="30" height="14" /> Students 20+</span>
            </div>
        </article>
      </div>
    </div>
  </section>

  <section class="categories-section">
    <h2 class="categories-title fade-up">Browse By Categories</h2>
    
    <div class="categories-grid stagger-children">
      <div class="category-item">
        <a href="">
          <div class="category-icon"><img src="images/bnfIcon.png" alt="Business icon" /></div>
          <div class="category-name">Business & Finance</div>
        </a>
      </div>
      
      <div class="category-item">
        <div class="category-icon"><img src="images/mnpIcon.png" alt="Music icon" /></div>
        <div class="category-name">Music & Perform Arts</div>
      </div>
      <div class="category-item">
        <div class="category-icon"><img src="images/ITicon.png" alt="IT icon" /></div>
        <div class="category-name">IT</div>
      </div>
      <div class="category-item">
        <div class="category-icon"><img src="images/andIcon.png" alt="Art icon" /></div>
        <div class="category-name">Art & Design</div>
      </div>
      <div class="category-item">
        <div class="category-icon"><img src="images/lnwIcon.png" alt="Language icon" /></div>
        <div class="category-name">Language & Writing</div>
      </div>
      <div class="category-item">
        <div class="category-icon"><img src="images/lndIcon.png" alt="Lifestyle icon" /></div>
        <div class="category-name">Lifestyle & Development</div>
      </div>
      <div class="category-item">
        <div class="category-icon"><img src="images/cncIcon.png" alt="Cooking icon" /></div>
        <div class="category-name">Cooking & Culinary</div>
      </div>
      <div class="category-item">
        <div class="category-icon"><img src="images/pcIcon.png" alt="Professional icon" /></div>
        <div class="category-name">Professional Certification</div>
      </div>
      <div class="category-item">
        <div class="category-icon"><img src="images/hndIcon.png" alt="Health icon" /></div>
        <div class="category-name">Health & Sports</div>
      </div>
    </div>
  </section>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const sections = document.querySelectorAll(".fade-up, .stagger-children");
      
      const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add("visible");
          }
        });
      }, {
        threshold: 0.1 
      });
      
      sections.forEach(section => observer.observe(section));
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>