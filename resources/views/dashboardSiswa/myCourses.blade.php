<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Courses - AllnGrow</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="css/myCourses.css">
</head>
<body>
  <div class="app">
    <!-- Sidebar -->
    <aside class="sidebar">
      <div class="logo">AllnGrow</div>
      <nav>
        <a href="dashboardSiswa"><i class="fas fa-home"></i> Dashboard</a>
        <a class="active"><i class="fas fa-book"></i> My Courses</a>
        <a href="schedule"><i class="fas fa-calendar"></i> Schedule</a>
        <a href="progress"><i class="fas fa-chart-line"></i> Progress</a>
        <a href="settings"><i class="fas fa-chart-line"></i> Settings</a>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="main">
      <!-- Header -->
      <header class="header">
        <div class="header-left">
          <h1>My Courses</h1>
          <p class="muted">Manage and track all your learning courses</p>
        </div>
        <div class="header-right">
          <button class="icon-btn"><i class="fas fa-bell"></i></button>
          <div class="user">
            <div class="user-avatar">AR</div>
            <div class="user-info">
              <div class="user-name">Ahmad Rizki</div>
              <div class="user-role">Student</div>
            </div>
          </div>
        </div>
      </header>

      <!-- Filter Tabs -->
      <div class="filter-tabs">
        <button class="tab active">All Courses (12)</button>
        <button class="tab">In Progress (4)</button>
        <button class="tab">Completed (8)</button>
      </div>

      <!-- Courses Grid -->
      <section class="courses-section">
        <div class="course-grid">
          <!-- Course 1 -->
          <article class="course">
            <div class="course-thumb">
              <img src="https://via.placeholder.com/400x200/6c5ce7/ffffff?text=Web+Dev" alt="Web Development">
              <span class="course-badge ongoing">Ongoing</span>
            </div>
            <div class="course-body">
              <div class="course-category">Development</div>
              <h3>Web Development Fundamentals</h3>
              <p class="course-instructor">
                <i class="fas fa-user-circle"></i> Dr. Sarah Johnson
              </p>
              <div class="course-stats">
                <span><i class="fas fa-video"></i> 24 Videos</span>
                <span><i class="fas fa-clock"></i> 12h 30m</span>
              </div>
              <div class="progress">
                <div class="progress-bar">
                  <div style="width: 65%"></div>
                </div>
                <div class="progress-num">65%</div>
              </div>
              <button class="btn-continue">Continue Learning</button>
            </div>
          </article>

          <!-- Course 2 -->
          <article class="course">
            <div class="course-thumb">
              <img src="https://via.placeholder.com/400x200/0984e3/ffffff?text=Data+Science" alt="Data Science">
              <span class="course-badge ongoing">Ongoing</span>
            </div>
            <div class="course-body">
              <div class="course-category">Data Science</div>
              <h3>Data Science Basics</h3>
              <p class="course-instructor">
                <i class="fas fa-user-circle"></i> Prof. Michael Chen
              </p>
              <div class="course-stats">
                <span><i class="fas fa-video"></i> 32 Videos</span>
                <span><i class="fas fa-clock"></i> 18h 45m</span>
              </div>
              <div class="progress">
                <div class="progress-bar">
                  <div style="width: 40%"></div>
                </div>
                <div class="progress-num">40%</div>
              </div>
              <button class="btn-continue">Continue Learning</button>
            </div>
          </article>

          <!-- Course 3 -->
          <article class="course">
            <div class="course-thumb">
              <img src="https://via.placeholder.com/400x200/fd79a8/ffffff?text=UI+UX+Design" alt="UI/UX Design">
              <span class="course-badge ongoing">Ongoing</span>
            </div>
            <div class="course-body">
              <div class="course-category">Design</div>
              <h3>UI/UX Design Principles</h3>
              <p class="course-instructor">
                <i class="fas fa-user-circle"></i> Emma Williams
              </p>
              <div class="course-stats">
                <span><i class="fas fa-video"></i> 28 Videos</span>
                <span><i class="fas fa-clock"></i> 15h 20m</span>
              </div>
              <div class="progress">
                <div class="progress-bar">
                  <div style="width: 85%"></div>
                </div>
                <div class="progress-num">85%</div>
              </div>
              <button class="btn-continue">Continue Learning</button>
            </div>
          </article>

          <!-- Course 4 -->
          <article class="course">
            <div class="course-thumb">
              <img src="https://via.placeholder.com/400x200/00b894/ffffff?text=Mobile+Dev" alt="Mobile Development">
              <span class="course-badge ongoing">Ongoing</span>
            </div>
            <div class="course-body">
              <div class="course-category">Mobile Development</div>
              <h3>Mobile App Development</h3>
              <p class="course-instructor">
                <i class="fas fa-user-circle"></i> John Anderson
              </p>
              <div class="course-stats">
                <span><i class="fas fa-video"></i> 36 Videos</span>
                <span><i class="fas fa-clock"></i> 20h 15m</span>
              </div>
              <div class="progress">
                <div class="progress-bar">
                  <div style="width: 30%"></div>
                </div>
                <div class="progress-num">30%</div>
              </div>
              <button class="btn-continue">Continue Learning</button>
            </div>
          </article>

          <!-- Course 5 - Completed -->
          <article class="course">
            <div class="course-thumb">
              <img src="https://via.placeholder.com/400x200/fdcb6e/ffffff?text=Python+Basics" alt="Python">
              <span class="course-badge completed">Completed</span>
            </div>
            <div class="course-body">
              <div class="course-category">Programming</div>
              <h3>Python Programming Basics</h3>
              <p class="course-instructor">
                <i class="fas fa-user-circle"></i> Dr. James Wilson
              </p>
              <div class="course-stats">
                <span><i class="fas fa-video"></i> 20 Videos</span>
                <span><i class="fas fa-clock"></i> 10h 00m</span>
              </div>
              <div class="progress">
                <div class="progress-bar">
                  <div style="width: 100%"></div>
                </div>
                <div class="progress-num">100%</div>
              </div>
              <button class="btn-certificate">
                <i class="fas fa-certificate"></i> View Certificate
              </button>
            </div>
          </article>

          <!-- Course 6 - Completed -->
          <article class="course">
            <div class="course-thumb">
              <img src="https://via.placeholder.com/400x200/e17055/ffffff?text=Digital+Marketing" alt="Marketing">
              <span class="course-badge completed">Completed</span>
            </div>
            <div class="course-body">
              <div class="course-category">Marketing</div>
              <h3>Digital Marketing Strategy</h3>
              <p class="course-instructor">
                <i class="fas fa-user-circle"></i> Lisa Anderson
              </p>
              <div class="course-stats">
                <span><i class="fas fa-video"></i> 16 Videos</span>
                <span><i class="fas fa-clock"></i> 8h 30m</span>
              </div>
              <div class="progress">
                <div class="progress-bar">
                  <div style="width: 100%"></div>
                </div>
                <div class="progress-num">100%</div>
              </div>
              <button class="btn-certificate">
                <i class="fas fa-certificate"></i> View Certificate
              </button>
            </div>
          </article>
        </div>
      </section>
    </main>
  </div>
</body>
</html>