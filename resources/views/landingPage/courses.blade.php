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
    <div class="search-box fade-up">
      <input type="text" placeholder="Search ...">
      <button class="search-btn"><i class="fa fa-search"></i></button>
    </div>


    <div class="filters fade-up dropdown mt-5">
      <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color:white; color:#767676">
        Categories
      </button>
      
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="#">All</a></li>
        <li><a class="dropdown-item" href="#">Business & Finance</a></li>
        <li><a class="dropdown-item" href="#">Arts & Design</a></li>
        <li><a class="dropdown-item" href="#">Music & Performing Arts</a></li>
        <li><a class="dropdown-item" href="#">Cooking & Culinary</a></li>
        <li><a class="dropdown-item" href="#">Health & Sports</a></li>
        <li><a class="dropdown-item" href="#">Lifestyle & Personal Development</a></li>
        <li><a class="dropdown-item" href="#">Certification & Professional Skills</a></li>
      </ul>

      <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color:white; color:#767676">
        Partner
      </button>
      
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="#">All</a></li>
        <li><a class="dropdown-item" href="#">Google</a></li>
        <li><a class="dropdown-item" href="#">EdX</a></li>
        <li><a class="dropdown-item" href="#">ABRSM</a></li>
        <li><a class="dropdown-item" href="#">Adobe</a></li>
        <li><a class="dropdown-item" href="#">Le Cordon Bleu</a></li>
        <li><a class="dropdown-item" href="#">Microsoft</a></li>
        <li><a class="dropdown-item" href="#">Certification & Professional Skills</a></li>
      </ul>
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

  <section class="courses-section">
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