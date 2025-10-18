<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>AllnGrow - Explore Courses</title>
  <link rel="stylesheet" href="css/landing.css" />
  <link rel="stylesheet" href="css/courses.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body>
  <!-- HEADER -->
  <header class="header">
    <div class="header-content">
      <div class="logo">AllnGrow</div>
      <nav class="nav-menu">
        <a href="{{ route('home') }}" class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
        <a href="{{ route('about') }}" class="nav-item">About us</a>
        <a href="#" class="nav-item">Courses</a>
        <a href="#" class="nav-item get-started-btn">Get Started</a>
      </nav>
    </div>
  </header>

  <!-- SEARCH SECTION -->
  <section class="search-section">
    <h2>Explore Courses</h2>
    <div class="search-box">
      <input type="text" placeholder="Search ...">
      <button class="search-btn"><i class="fa fa-search"></i></button>
    </div>
    <div class="filters">
      <select>
        <option>Categories</option>
      </select>
      <select>
        <option>Partner</option>
      </select>
    </div>
  </section>

 <!-- EXPLORE OUR COURSE SECTION -->
  <section class="courses-section fade-section">
        <div class="courses-header">
          <h2 class="courses-title">Explore Our Courses</h2>
          <div class="courses-badge">Top Popular Course</div>
        </div>

    <div class="courses-scroll-wrapper">  
      <div class="courses-grid">
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

      <!-- RECOMMENDED SECTION -->
  <section class="recommended-section fade-section">
    <div class="recommended-header">
      <h2 class="recommended-title">Recommended</h2>
    </div>

    <div class="recommended-grid">
      <article class="recommended-card">
        <img src="images/dataPic.png" alt="Data Science Course" class="recommended-image" />
        <div class="recommended-rating">
          <img src="images/starSymbol.png" alt="5 star rating" width="78" height="14" />
          <span>4.5k</span>
        </div>
        <h3 class="recommended-name">It Statistics Data Science And Business Analysis</h3>
        <div class="recommended-meta">
          <span><img src="images/timeSymbol.png" alt="Duration" width="24" /> 19h 30m</span>
          <span><img src="images/user.png" alt="Students" width="24" /> Students 20+</span>
        </div>
      </article>

      <article class="recommended-card">
        <img src="images/adobePic.png" alt="Adobe Illustrator Course" class="recommended-image" />
        <div class="recommended-rating">
          <img src="images/starSymbol.png" alt="5 star rating" width="78" height="14" />
          <span>4.5k</span>
        </div>
        <h3 class="recommended-name">Beginner Adobe Illustrator For Graphic Design</h3>
        <div class="recommended-meta">
          <span><img src="images/timeSymbol.png" alt="Duration" width="24" /> 19h 30m</span>
          <span><img src="images/user.png" alt="Students" width="24" /> Students 20+</span>
        </div>
      </article>

      <article class="recommended-card">
        <img src="images/pianoPic.png" alt="Classical Music Course" class="recommended-image" />
        <div class="recommended-rating">
          <img src="images/starSymbol.png" alt="5 star rating" width="78" height="14" />
          <span>4.5k</span>
        </div>
        <h3 class="recommended-name">Classical Music : Piano</h3>
        <div class="recommended-meta">
          <span><img src="images/timeSymbol.png" alt="Duration" width="24" /> 19h 30m</span>
          <span><img src="images/user.png" alt="Students" width="24" /> Students 20+</span>
        </div>
      </article>

      <article class="recommended-card">
        <img src="images/pianoPic.png" alt="Classical Music Course" class="recommended-image" />
        <div class="recommended-rating">
          <img src="images/starSymbol.png" alt="5 star rating" width="78" height="14" />
          <span>4.5k</span>
        </div>
        <h3 class="recommended-name">Classical Music : Piano</h3>
        <div class="recommended-meta">
          <span><img src="images/timeSymbol.png" alt="Duration" width="24" /> 19h 30m</span>
          <span><img src="images/user.png" alt="Students" width="24" /> Students 20+</span>
        </div>
      </article>

      <article class="recommended-card">
        <img src="images/pianoPic.png" alt="Classical Music Course" class="recommended-image" />
        <div class="recommended-rating">
          <img src="images/starSymbol.png" alt="5 star rating" width="78" height="14" />
          <span>4.5k</span>
        </div>
        <h3 class="recommended-name">Classical Music : Piano</h3>
        <div class="recommended-meta">
          <span><img src="images/timeSymbol.png" alt="Duration" width="24" /> 19h 30m</span>
          <span><img src="images/user.png" alt="Students" width="24" /> Students 20+</span>
        </div>
      </article>

      <article class="recommended-card">
        <img src="images/pianoPic.png" alt="Classical Music Course" class="recommended-image" />
        <div class="recommended-rating">
          <img src="images/starSymbol.png" alt="5 star rating" width="78" height="14" />
          <span>4.5k</span>
        </div>
        <h3 class="recommended-name">Classical Music : Piano</h3>
        <div class="recommended-meta">
          <span><img src="images/timeSymbol.png" alt="Duration" width="24" /> 19h 30m</span>
          <span><img src="images/user.png" alt="Students" width="24" /> Students 20+</span>
        </div>
      </article>
    </div>
  </section>

          <!-- Categories Section -->
    <section class="categories-section">
      <h2 class="categories-title">Browse By Categories</h2>

      <div class="categories-grid">
        <div class="category-item">
          <div class="category-icon">
            <img src="images/bnfIcon.png" alt="Business icon" />
          </div>
          <div class="category-name">Business & Finance</div>
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

  <!-- FOOTER -->
  <footer class="simple-footer">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <div class="footer-left">
      <a href="#"><i class="fab fa-x-twitter"></i></a>
      <a href="#"><i class="fab fa-youtube"></i></a>
      <a href="#"><i class="fab fa-linkedin"></i></a>
      <a href="#"><i class="fab fa-github"></i></a>
      <a href="#"><i class="fab fa-instagram"></i></a>
      <a href="#"><i class="fab fa-tiktok"></i></a>
      <a href="#"><i class="fab fa-discord"></i></a>
    </div>
    <div class="footer-center">
      <p>AllnGrow © 2025 — All Rights Reserved</p>
    </div>
    <div class="footer-right">
      <button class="lang-btn">Indonesia</button>
    </div>
  </footer>
</body>
</html>
