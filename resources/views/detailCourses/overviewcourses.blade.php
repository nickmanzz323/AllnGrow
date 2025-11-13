<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>AllnGrow - Explore Courses</title>
  <link rel="stylesheet" href="css/landing.css" />
  <link rel="stylesheet" href="css/courses.css" />
  <link rel="stylesheet" href="css/overviewcourses.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>

<body>
  <!-- ======================
       HEADER
       ====================== -->
  <header class="header">
    <div class="header-content">
      <div class="logo">
        <img src="images/allngrowlogo.svg" alt="AllnGrow Logo" width="155" height="auto">
      </div>
      <nav class="nav-menu">
        <a href="{{ route('home') }}" class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
        <a href="{{ route('about') }}" class="nav-item">About Us</a>
        <a href="{{ route('courses') }}" class="nav-item {{ request()->routeIs('courses') ? 'active' : '' }}">Courses</a>
        <a href="{{ route('login') }}" class="nav-item {{ request()->routeIs('login') ? 'active' : '' }}">Get Started</a>

      </nav>
    </div>
  </header>

  <!-- ======================
       COURSE DETAIL SECTION
       ====================== -->
  <section class="course-detail fade-up delay-1">
    
    <div class="course-header">
      <div class="course-image">
          <img src="images/detailcourses/coursesDetailPic.jpg" alt="Project Management" />
       </div>
      <h1>Project Management Fundamentals</h1>
      <p class="subtitle">
        Learn The Basics Of Project Management To Achieve Official PMP Certification.
      </p>
    </div>

    <!-- Course Info -->
    <div class="course-info fade-up delay-2">
      <div class="course-main">
        <h3>Learning Outcomes</h3>
        <ul>
          <li>Master the project management framework and monitoring.</li>
          <li>Understand tools and techniques (Gantt charts, Agile, Risk Management).</li>
          <li>Prepare a final project plan ready for execution.</li>
        </ul>

        <h3>Benefits</h3>
        <ul>
          <li>Official digital certificate</li>
          <li>Access to mentor learning forum</li>
          <li>Discount for advanced courses</li>
        </ul>
      </div>
      <div class="enroll-box">
        <div class="price">
          <h2>Rp 50K</h2>
          <p>20% OFF</p>
        </div>
        <button class="enroll-btn">Enroll Now</button>
        <ul>
          <li>📅 Start Date: Nov 6</li>
          <li>🕐 4:00 PM - 6:00 PM</li>
          <li>🗓 Level: Basic</li>
          <li>🌐 Language: English</li>
        </ul>
      </div>
    </div>

    <div class="course-main fade-up delay-3">
      <!-- Lesson Summary Section -->
      <div class="lesson-summary">
        <div class="lesson-item">
          <i class="fa-regular fa-file-lines"></i>
          <span><strong>Learning session</strong></span>
        </div>
        <div class="lesson-item">
          <i class="fa-regular fa-clock"></i>
          <span>9.00AM–01.00PM</span>
        </div>
        <div class="lesson-item">
          <i class="fa-regular fa-user"></i>
          <span>Students 20+</span>
        </div>
      </div>
      <hr class="lesson-divider" />

      <!-- Course Outline -->
      <div class="course-outline fade-up delay-4">
        <details>
          <summary>Introduction to Project Management</summary>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</p>
        </details>
        <details>
          <summary>Project Lifecycle & Methodologies (Agile, Waterfall)</summary>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</p>
        </details>
        <details>
          <summary>Tools & Techniques</summary>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</p>
        </details>
        <details>
          <summary>Case Study: Real Project Simulation</summary>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor Lorem ipsum dolor sit amet.</p>
        </details>
        <details>
          <summary>Final Assessment</summary>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </details>
      </div>
    </div>


    <!-- Instructor -->
    <div class="instructor fade-up delay-1" >
      <h2>Meet Our Expert Instructor</h2>
      <div class="instructor-card">
        <img src="images/detailcourses/instructorPhoto.jpg" alt="Instructor" />
        <div class="instructor-info">
          <h3>John Anderson</h3>
          <p>Assistant Professor at Manchester University</p>
          <p class="bio">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet lorem.
          </p>
        </div>
      </div>
    </div>

    <!-- Testimonials -->
    <div class="testimonials fade-up delay-2">
      <h2>Why Choose This Course?</h2>
      <div class="testimonial-slider">
        <div class="testimonial-track">
          <div class="testimonial-card">
            <p>"A very practical and insightful course for beginners!"</p>
            <span>- Ellen Pierce, CEO at House of Ramon</span>
          </div>
          <div class="testimonial-card">
            <p>"The mentor was amazing and the lessons were clear and structured."</p>
            <span>- Kathy Sullivan, CEO at LeadPath</span>
          </div>
          <div class="testimonial-card">
            <p>"Highly recommend for anyone looking to learn project management basics."</p>
            <span>- Elsie Strowl, CEO at Eduwork</span>
          </div>
          <div class="testimonial-card">
            <p>"A very practical and insightful course for beginners!"</p>
            <span>- Ellen Pierce, CEO at House of Ramon</span>
          </div>
          <div class="testimonial-card">
            <p>"The mentor was amazing and the lessons were clear and structured."</p>
            <span>- Kathy Sullivan, CEO at LeadPath</span>
          </div>
          <div class="testimonial-card">
            <p>"Highly recommend for anyone looking to learn project management basics."</p>
            <span>- Elsie Strowl, CEO at Eduwork</span>
          </div>
        </div>
      </div>
    </div>

  </section>
</body>
</html>
