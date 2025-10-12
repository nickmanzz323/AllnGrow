<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>AllnGrow - Professional Online Learning & Certification Platform</title>
  <!-- SEO -->
  <meta name="description" content="Transform your career with AllnGrow's professional online courses. Get certified by global institutions like Google, Adobe & ABRSM. Live coaching, expert instructors, flexible learning plans from 99K/month." />
  <meta name="keywords" content="online learning, professional certification, courses, education platform, career development, skill training" />
  <meta property="og:type" content="website" />
  <meta property="og:title" content="AllnGrow - Professional Online Learning & Certification Platform" />
  <meta property="og:description" content="Transform your career with AllnGrow's professional online courses. Get certified by global institutions like Google, Adobe & ABRSM." />

  <!-- refer ke file css -->
  <link rel="stylesheet" href="css/landing.css">

  <!-- animation effect -->
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

<!-- header contennt (yang paling atas sendiri) -->
</head>
<body>
  <header class="header">
    <div class="header-content">
      <img src="images/companyLogo.png" alt="AllnGrow Logo" class="logo" />
      <nav class="nav-menu" role="navigation">
        <a href="#" class="nav-item" role="menuitem">Home</a>
        <a href="#" class="nav-item" role="menuitem">About us</a>
        <a href="#" class="nav-item" role="menuitem">Courses</a>
      </nav>
      <button class="hamburger" aria-label="Toggle menu">☰</button>
      <button onclick="window.location.href='/login'" class="get-started-btn">
        Get Started
        <img src="images/arrowLeft.png" alt="" width="16" height="14" />
      </button>
    </div>
  </header>

  <!-- tampilan awal (hero section (bawahnnya header)) -->
  <main>
    <section class="hero-section">
      <img src="images/workspace3.jpg" alt="Learning background" class="hero-bg-image" />
      <div class="hero-content">
        <p class="hero-welcome">Welcome To AllnGrow Courses</p>
        <h1 class="hero-title">Achieving Your Dreams Through Education</h1>
        <p class="hero-description">We are experienced in educational platform and skilled strategies for the success of our online learning.</p>
        <button class="hero-btn">
          Find courses
          <img src="/images/arrowWhiteBlackBackground.png" alt="" width="58" height="58" />
        </button>
      </div>
    </section>

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

    <section class="about-section fade-left">
      <div class="about-content">
        <div class="about-images">
          <img src="images/anime1.jpg" alt="Student learning" width="152" height="362" />
          <img src="images/ijoIjojelek.png" alt="Learning materials" width="66" height="74" />
          <img src="images/anime2.jpg" alt="Online education" width="214" height="344" />
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

    <!-- ini yang sudah enroll dkk -->
    <section class="stats-section fade-section">
      <div class="stats-container">
        <div class="stat-item">
          <div class="stat-icon">
            <img src="images/sucessfullyTrained.png" alt="Successfully trained icon" />
          </div>
          <div class="stat-number">3K+</div>
          <div class="stat-label">Successfully Trained</div>
        </div>
        <div class="stat-item">
          <div class="stat-icon">
            <img src="images/classesComplete.png" alt="Classes completed icon" />
          </div>
          <div class="stat-number">15K+</div>
          <div class="stat-label">Classes Completed</div>
        </div>
        <div class="stat-item">
          <div class="stat-icon">
            <img src="images/satisfactionRate.png" alt="Satisfaction rate icon" />
          </div>
          <div class="stat-number">97K+</div>
          <div class="stat-label">Satisfaction Rate</div>
        </div>
        <div class="stat-item">
          <div class="stat-icon">
            <img src="images/expertReaction.png" alt="Expert instructor icon" />
          </div>
          <div class="stat-number">50+</div>
          <div class="stat-label">Expert Instructor</div>
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
          <img src="images/datapic.png" alt="IT Statistics Data Science course" class="course-image" />
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

    <!-- categories section -->
    <section class="categories-section fade-left">
      <h2 class="categories-title">Browse By Categories</h2>
      <div class="categories-grid">
        <div class="category-item" style="background-color: #eaf6ff;">
          <div class="category-icon" style="background-color: rgba(27, 117, 232, 0.1); border: 1px solid #1b75e8;">
            <img src="images/bnfIcon.png" alt="Business icon" width="40" height="40" />
          </div>
          <div class="category-name">Business & Finance</div>
        </div>
        <div class="category-item" style="background-color: #fef2f4;">
          <div class="category-icon" style="background-color: rgba(255, 104, 129, 0.15); border: 1px solid #ff6881;">
            <img src="images/mnpIcon.png" alt="Music icon" width="40" height="40" />
          </div>
          <div class="category-name">Music & Perform Arts</div>
        </div>
        <div class="category-item" style="background-color: #eefbf5;">
          <div class="category-icon" style="background-color: #d1f5e4; border: 1px solid #00bc65;">
            <img src="images/ITicon.png" alt="IT icon" width="46" height="40" />
          </div>
          <div class="category-name">IT</div>
        </div>
        <div class="category-item" style="background-color: #fffaef;">
          <div class="category-icon" style="background-color: #fff3d9; border: 1px solid #f2a700;">
            <img src="images/andIcon.png" alt="Art icon" width="38" height="40" />
          </div>
          <div class="category-name">Art & Design</div>
        </div>
        <div class="category-item" style="background-color: #f7f3ff;">
          <div class="category-icon" style="background-color: #dfd4f4; border: 1px solid #4500d0;">
            <img src="images/lnwIcon.png" alt="Language icon" width="40" height="40" />
          </div>
          <div class="category-name">Language & Writing</div>
        </div>
        <div class="category-item" style="background-color: #fff0f8;">
          <div class="category-icon" style="background-color: #ffdaf0; border: 1px solid #bb0064;">
            <img src="images/lndIcon.png" alt="Lifestyle icon" width="40" height="40" />
          </div>
          <div class="category-name">Lifestyle & Development</div>
        </div>
        <div class="category-item" style="background-color: #f3f4fe;">
          <div class="category-icon" style="background-color: #dcdffd; border: 1px solid #0011bb;">
            <img src="images/cncIcon.png" alt="Cooking icon" width="40" height="40" />
          </div>
          <div class="category-name">Cooking & Culinary</div>
        </div>
        <div class="category-item" style="background-color: #fff7ef;">
          <div class="category-icon" style="background-color: #ffecd9; border: 1px solid #d16900;">
            <img src="images/pcIcon.png" alt="Professional icon" width="42" height="40" />
          </div>
          <div class="category-name">Professional certification</div>
        </div>
        <div class="category-item" style="background-color: #f1fbff;">
          <div class="category-icon" style="background-color: #dcf5ff; border: 1px solid #00a9ed;">
            <img src="images/hndIcon.png" alt="Health icon" width="40" height="40" />
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

  <footer class="footer fade-section">
    <div class="footer-content">
      <div class="footer-brand">
        <img src="images/companyLogo.png" alt="AllnGrow Footer Logo" class="footer-logo" />
        <p class="footer-description">One Platform, All Skills. From Hobby to Professional.<br /><br />Learn. Grow. and Certify</p>
      </div>
      <div class="footer-contact">
        <h3 class="contact-title">Contact Info</h3>
        <div class="contact-info">
          Address : Jakarta, Indonesia<br />
          Phone : +62123456789<br />
          Email : AllnGrow@gmail.com
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <p class="footer-copyright">
        Copyright © 2025 <span class="footer-brand-name">AllnGrow</span> || All Rights Reserved
      </p>
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