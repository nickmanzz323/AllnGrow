<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About Us - AllnGrow</title>
  <meta name="description" content="Learn about AllnGrow — a trusted online learning platform that empowers college students through professional courses, one-on-one mentoring, and certified programs." />
  <link rel="stylesheet" href="css/landing.css" />
  <link rel="stylesheet" href="css/about.css" />
</head>

                                                                     <!-- ABOUT US PAGE -->

<body>
  <!-- HEADER -->
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

  <!-- HERO -->
  <section class="about-hero fade-section">
    <div class="about-hero-img">
      <img src="images/sproutGrowth.jpg" alt="Picture1" />
    </div>
    <h1>About AllnGrow</h1>
    <p>Empowering college students to reach their full potential through professional learning, 
       personal mentorship, and global certification.</p>
  </section>

  <!-- OUR STORY -->
  <section class="about-content-section fade-left">
    <div class="about-img">
      <img src="images/mentoringPicture.jpg" alt="AllnGrow learning" />
    </div>
    <div class="about-text">
      <h2>Our Story</h2>
      <p>AllnGrow was built to bridge the gap between education and professional readiness. 
         We understand the challenges college students face when transitioning into the real world, 
         and our goal is to provide them with the knowledge, mentorship, and credentials needed to succeed.</p>
      <p>With one-on-one online learning, real-time coaching, and official certification opportunities 
         from recognized partners, AllnGrow ensures that every learner can grow confidently toward their dream career.</p>
    </div>
  </section>

  <!-- OUR MISSION -->
  <section class="about-content-section fade-right">
    <div class="about-text">
      <h2>Our Mission</h2>
      <p>To deliver quality education that combines academic depth with practical skill-building — 
         making professional learning accessible, engaging, and career-focused for every college student.</p>
      <p>We strive to create a space where learners are supported by professional mentors and gain 
         real-world skills that set them apart in the competitive job market.</p>
    </div>
    <div class="about-img">
      <img src="images/jobAchieve.jpg" alt="Online mentorship" />
    </div>
  </section>

  <!-- VALUES -->
  <section class="values-section fade-section">
    <h2 class="values-title">Our Core Values</h2>
    <div class="values-grid">
      <div class="value-card">
        <h3> Mindset</h3>
        <p>We believe in lifelong learning and continuous improvement for every student and mentor.</p>
      </div>
      <div class="value-card">
        <h3>Professional Excellence</h3>
        <p>AllnGrow partners with certified institutions and expert instructors to ensure every course 
           meets global standards.</p>
      </div>
      <div class="value-card">
        <h3>Collaboration</h3>
        <p>We build a strong learning community through personalized mentorship and peer learning experiences.</p>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="cta-join fade-right">
    <h2>Ready to Start Your Growth Journey?</h2>
    <p>Join thousands of students learning new skills, earning certifications, and shaping their professional futures with AllnGrow.</p>
    <button onclick="window.location.href='/register'">Join Now</button>
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


  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const sections = document.querySelectorAll(".fade-section, .fade-left, .fade-right");
      const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
          if (entry.isIntersecting) entry.target.classList.add("visible");
        });
      }, { threshold: 0.2 });
      sections.forEach(section => observer.observe(section));
    });
  </script>
</body>
</html>
