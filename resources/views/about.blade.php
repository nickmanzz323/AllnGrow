

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About Us - AllnGrow</title>
  <meta name="description" content="Learn about AllnGrow — a trusted online learning platform that empowers college students through professional courses, one-on-one mentoring, and certified programs." />
  <link rel="stylesheet" href="css/landing.css" />

  <style>
    .about-hero {
      background: linear-gradient(120deg, #1b75e8, #003a9e);
      color: white;
      padding: 120px 20px 100px;
      text-align: center;
    }
    .about-hero h1 {
      font-size: 48px;
      margin-bottom: 16px;
      font-weight: 700;
    }
    .about-hero p {
      font-size: 18px;
      max-width: 700px;
      margin: 0 auto;
      opacity: 0.9;
    }

    .about-content-section {
      padding: 80px 20px;
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      justify-content: center;
      gap: 60px;
    }

    .about-text {
      max-width: 550px;
    }

    .about-text h2 {
      font-size: 32px;
      color: #1b75e8;
      margin-bottom: 20px;
      font-weight: 700;
    }

    .about-text p {
      font-size: 18px;
      line-height: 1.6;
      color: #444;
      margin-bottom: 18px;
    }

    .about-img img {
      border-radius: 12px;
      width: 480px;
      max-width: 100%;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .values-section {
      background-color: #f5f9ff;
      padding: 80px 20px;
      text-align: center;
    }

    .values-title {
      font-size: 36px;
      color: #1b75e8;
      margin-bottom: 50px;
      font-weight: 700;
    }

    .values-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 40px;
      max-width: 1100px;
      margin: 0 auto;
    }

    .value-card {
      background: white;
      border-radius: 12px;
      padding: 30px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .value-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 10px 24px rgba(0, 0, 0, 0.15);
    }

    .value-card h3 {
      color: #1b75e8;
      font-size: 22px;
      margin-bottom: 15px;
      font-weight: 600;
    }

    .value-card p {
      color: #555;
      line-height: 1.5;
      font-size: 16px;
    }

    .cta-join {
      background: linear-gradient(120deg, #1b75e8, #003a9e);
      color: white;
      text-align: center;
      padding: 80px 20px;
    }

    .cta-join h2 {
      font-size: 36px;
      margin-bottom: 20px;
      font-weight: 700;
    }

    .cta-join p {
      font-size: 18px;
      max-width: 700px;
      margin: 0 auto 40px;
      opacity: 0.9;
    }

    .cta-join button {
      background-color: #ffffff;
      color: #1b75e8;
      border: none;
      padding: 16px 36px;
      font-size: 18px;
      font-weight: 600;
      border-radius: 50px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .cta-join button:hover {
      background-color: #eaf3ff;
    }
  </style>
</head>

<body>
  <!-- HEADER -->
  <header class="header">
    <div class="header-content">
      <img src="images/companyLogo.png" alt="AllnGrow Logo" class=" logo" />
      <nav class="nav-menu" role="navigation">
        <a href="{{ route('home') }}" class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
        <a href="{{ route('about') }}" class="nav-item" role="menuitem">About us</a>
        <a href="#" class="nav-item" role="menuitem">Courses</a>
      </nav>
      <button class="hamburger" aria-label="Toggle menu">☰</button>
      <button onclick="window.location.href='/login'" class="get-started-btn">
        Get Started
        <img src="images/arrowLeft.png" alt="" width="16" height="14" />
      </button>
    </div>
  </header>

  <!-- HERO -->
  <section class="about-hero fade-section">
    <h1>About AllnGrow</h1>
    <p>Empowering college students to reach their full potential through professional learning, 
       personal mentorship, and global certification.</p>
  </section>

  <!-- OUR STORY -->
  <section class="about-content-section fade-left">
    <div class="about-img">
      <img src="images/anime2.jpg" alt="AllnGrow learning" />
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
      <img src="images/workspace3.jpg" alt="Online mentorship" />
    </div>
  </section>

  <!-- VALUES -->
  <section class="values-section fade-section">
    <h2 class="values-title">Our Core Values</h2>
    <div class="values-grid">
      <div class="value-card">
        <h3>Growth Mindset</h3>
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
  <footer class="footer fade-section">
    <div class="footer-content">
      <div class="footer-brand">
        <img src="images/companyLogo.png" alt="AllnGrow Footer Logo" class="footer-logo" />
        <p class="footer-description">One Platform, All Skills. From Hobby to Professional <br> Learn. Grow. and Certify</p>
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
          if (entry.isIntersecting) entry.target.classList.add("visible");
        });
      }, { threshold: 0.2 });
      sections.forEach(section => observer.observe(section));
    });
  </script>
</body>
</html>
