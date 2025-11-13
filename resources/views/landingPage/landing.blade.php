<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>AllnGrow - Professional Online Learning & Certification Platform</title>
  <meta name="description" content="Transform your career with AllnGrow's professional online courses. Get certified by global institutions like Google, Adobe & ABRSM. Live coaching, expert instructors, flexible learning plans from 99K/month." />
  <meta name="keywords" content="online learning, professional certification, courses, education platform, career development, skill training" />
  <meta property="og:type" content="website" />
  <meta property="og:title" content="AllnGrow - Professional Online Learning & Certification Platform" />
  <meta property="og:description" content="Transform your career with AllnGrow's professional online courses. Get certified by global institutions like Google, Adobe & ABRSM." />
  <link rel="stylesheet" href="css/landing.css">

  <style>
    .fade-section, .fade-left, .fade-right {
      opacity: 0;
      transition: opacity 0.8s ease-out, transform 0.8s ease-out;
    }
    .fade-section { transform: translateY(40px); }
    .fade-left { transform: translateX(-60px); }
    .fade-right { transform: translateX(60px); }
    .visible {
      opacity: 1;
      transform: translate(0, 0);
    }
  </style>
  
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
            <a href="{{ route('login') }}" class="nav-item {{ request()->routeIs('login') ? 'active' : '' }}">Get Started</a>
          </nav>
        </div>
      </header>
      </div>
    </header>

  <main>
    <section class="hero-section">
      <div class="hero-animation"> 
        <img src = "images/peoplehappy.jpg" alt="PeopleHappy" class="hero-img"
          background = "transparent"
          speed = "1"
          style = "width: 100%; max-width: 400px;"
          loop
          autoplay />
      </div>

      <div class="hero-content">
        <p class="hero-welcome">Welcome</p>
        <h1 class="hero-title">Achieving Your Dreams Through Education</h1>
        <p class="hero-description">
          We are experienced in educational platform and skilled strategies for the success of our online learning.
        </p>
        <button class="hero-btn">
          Find courses
        </button>
      </div>
    </section>
  </main>


  <!-- partnership section -->
    <section class="certification-section fade-section">
      <h2 class="certification-title">Collaborate with Certification Institution</h2>
      <div class="certification-logos">
        <img src="images/googleLogo.png" alt="Google certification" class="cert-logo" />
        <img src="images/adobeLogo.png" alt="Adobe certification" class="cert-logo" />
        <img src="images/ABRSMLogo.png" alt="ABRSM certification" class="cert-logo" />
        <img src="images/edXLogo.png" alt="edX certification" class="cert-logo" />
        <img src="images/lcbLogo.png" alt="Le Cordon Blue certification" class="cert-logo" />
      </div>
    </section>

    <!-- about us section -->
    <section class="about-section fade-left">
      <div class="about-content">
        <div class="about-images">
          <img src="images/peopleStudy1.jpg" alt="Student learning" width="152" height="362" />
          <img src="images/peopleStudy2.jpg" alt="Online education" width="214" height="344" />
        </div>
        <div class="about-text">
          <p class="about-label">About us</p>
          <h2 class="about-title">
            Earn professional growth with courses<br />
            <span class="highlight">Future Success</span>
          </h2>
          <p class="about-description">You not only learn but develop with professional teachers who accompany you until the end.</p>
          <div class="about-features">
            <div class="feature-section">
              <h3 class="feature-title">OUR MISSION:</h3>
              <p class="feature-text">Providing quality courses, consistent instructors, and professional certification through effective and interactive learning.</p>
              <button class="about-btn">
                Admission open
                <img src="images/arrowLeftWhite.png" alt="" width="16" height="14" />
              </button>
            </div>
            <div class="feature-section">
              <h3 class="feature-title">OUR VISION:</h3>
              <p class="feature-text">To be a trusted Hybrid learning platform that helps every individual develop with professional guidance.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- why learn section -->
    <section class="why-learn-section fade-right">
      <h2 class="why-learn-title">Why Learn with AllnGrow?</h2>
      <div class="features-grid">
        <div class="feature-card">
          <div class="feature-icon certification">
            <img src="images/achievement.png" alt="Achievement icon" width="42" height="42" />
          </div>
          <h3 class="feature-card-title">Official Certification</h3>
          <p class="feature-card-text">Earn globally recognized professional certification upon completion of the course.</p>
        </div>
        <div class="feature-card">
          <div class="feature-icon coaching">
            <img src="images/calendar.png" alt="Calendar icon" width="36" height="34" />
          </div>
          <h3 class="feature-card-title">Live Coaching Session</h3>
          <p class="feature-card-text">Learn more deeply with face-to-face sessions (online/offline) with consistent professional teachers.</p>
        </div>
        <div class="feature-card">
          <div class="feature-icon reward">
            <img src="images/groupPeople.png" alt="Users icon" width="42" height="32" />
          </div>
          <h3 class="feature-card-title">Reward & Voucher</h3>
          <p class="feature-card-text">Complete the course faster than the specified time and get a discount voucher for a similar course area.</p>
        </div>
      </div>
    </section>

    <section class="courses-section fade-section">
        <div class="courses-header">
          <h2 class="courses-title">Explore Our Courses</h2>
          <div class="courses-badge">Top Popular Course</div>
        </div>
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


    <!-- pricting section -->
    <section class="pricing-section fade-section">
      <h2 class="pricing-title">Choose Your Learning Plan</h2>
      <div class="pricing-grid">
        <div class="pricing-card">
          <div class="plan-name">BASIC</div>
          <div class="plan-price">99K</div>
          <div class="plan-period">Month</div>
          <p style="font-size: 16px; color: #4d5756; margin-bottom: 32px;">*Not include certificate</p>
          <ul class="plan-features">
            <li>
              <div class="check-icon"><img src="images/centangIjo.png" alt="Check" width="15" height="20" /></div>
              Access Virtual Based Learning (VBL)
            </li>
            <li>
              <div class="check-icon"><img src="images/centangIjo.png" alt="Check" width="15" height="20" /></div>
              Structured learning materials
            </li>
          </ul>
          <button class="plan-btn">Choose</button>
        </div>
        <div class="pricing-card featured">
          <div class="plan-name" style="color: #ffffff;">PRO</div>
          <div class="plan-price">199K</div>
          <div class="plan-period" style="color: #ffffff;">Month</div>
          <p style="font-size: 16px; color: #ffffff; margin-bottom: 32px;">*include certificate for ....</p>
          <ul class="plan-features">
            <li style="color: #ffffff;"><div class="check-icon"><img src="images/centangIjo.png" alt="Check" width="15" height="20" /></div>All Basic Features</li>
            <li style="color: #ffffff;"><div class="check-icon"><img src="images/centangIjo.png" alt="Check" width="15" height="20" /></div>Access additional materials</li>
            <li style="color: #ffffff;"><div class="check-icon"><img src="images/centangIjo.png" alt="Check" width="15" height="20" /></div>Interactive discussions with Instructor</li>
            <li style="color: #ffffff;"><div class="check-icon"><img src="images/centangIjo.png" alt="Check" width="15" height="20" /></div>Exclusive updates</li>
            <li style="color: #ffffff;"><div class="check-icon"><img src="images/centangIjo.png" alt="Check" width="15" height="20" /></div>Free practice before certification</li>
          </ul>
          <button class="plan-btn">Choose</button>
        </div>
        <div class="pricing-card">
          <div class="plan-name">EXPERT PLUS</div>
          <div class="plan-price">299K</div>
          <div class="plan-period">Month</div>
          <p style="font-size: 16px; color: #4d5756; margin-bottom: 32px;">*Certification for ....</p>
          <ul class="plan-features">
            <li><div class="check-icon"><img src="images/centangIjo.png" alt="Check" width="15" height="20" /></div>All Plus Feature</li>
            <li><div class="check-icon"><img src="images/centangIjo.png" alt="Check" width="15" height="20" /></div>Certification from Global institution</li>
            <li><div class="check-icon"><img src="images/centangIjo.png" alt="Check" width="15" height="20" /></div>Online/ F2F guidance by expert instructors</li>
            <li><div class="check-icon"><img src="images/centangIjo.png" alt="Check" width="15" height="20" /></div>Change Instructors</li>
            <li><div class="check-icon"><img src="images/centangIjo.png" alt="Check" width="15" height="20" /></div>Upgrade CV & career</li>
            <li><div class="check-icon"><img src="images/centangIjo.png" alt="Check" width="15" height="20" /></div>24/7 Support</li>
          </ul>
          <button class="plan-btn">Choose</button>
        </div>
      </div>
    </section>

    <!-- choose your plan section -->
    <section class="cta-section fade-right">
      <p class="cta-text">Choose your package, get certified, and upgrade your skills today!</p>
    </section>
  </main>

  <!-- footer section -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <footer class="simple-footer">
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

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const sections = document.querySelectorAll(".fade-section, .fade-left, .fade-right");

      const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add("visible");
          }
        });
      }, { threshold: 0.2 });

      sections.forEach(section => observer.observe(section));
    });
  </script>
</body>
</html>