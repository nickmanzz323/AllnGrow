<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AllnGrow - Instructor Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="css/dashboardInstructor/dashboardInstructor.css">
</head>
<body>
  <div class="app">
    <!-- Sidebar -->
    <aside class="sidebar">
      <div class="logo">AllnGrow</div>
      <nav>
        <a class="nav-link active" data-page="dashboard">
          <i class="fas fa-home"></i> Dashboard
        </a>
        <a href="{{ route('instructor.courses.index') }}" class="nav-link">
          <i class="fas fa-book"></i> My Courses
        </a>
        <a href="{{ route('instructor.courses.create') }}" class="nav-link">
          <i class="fas fa-plus-circle"></i> Add Course
        </a>
        <a class="nav-link" data-page="students">
          <i class="fas fa-users"></i> Students
        </a>
        <a class="nav-link" data-page="analytics">
          <i class="fas fa-chart-bar"></i> Analytics
        </a>
        <a class="nav-link" data-page="earnings">
          <i class="fas fa-dollar-sign"></i> Earnings
        </a>
        <a href="messageInstructor" data-page="messages">
          <i class="fas fa-envelope"></i> Messages
        </a>
        <a href="settingsInstructor" data-page="settings">
          <i class="fas fa-cog"></i> Settings
        </a>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="main">
      <!-- Dashboard Tab -->
      <div class="tab-content active" id="dashboard">
        <header class="header">
          <div class="header-left">
            <h1>Welcome back, Dr. Sarah!</h1>
            <p class="muted">Here's what's happening with your courses today</p>
          </div>
          <div class="header-right">
            <button class="icon-btn"><i class="fas fa-bell"></i></button>
            <div class="user">
              <div class="user-avatar">SJ</div>
              <div class="user-info">
                <div class="user-name">Dr. Sarah Johnson</div>
                <div class="user-role">Instructor</div>
              </div>
            </div>
          </div>
        </header>

        <!-- Stats Grid -->
        <div class="stats-grid">
          <div class="stat-card">
            <div class="stat-header">
              <div class="stat-icon"><i class="fas fa-book"></i></div>
            </div>
            <div class="stat-value">{{ $totalCourses ?? 0 }}</div>
            <div class="stat-label">Total Courses</div>
          </div>

          <div class="stat-card">
            <div class="stat-header">
              <div class="stat-icon"><i class="fas fa-users"></i></div>
            </div>
            <div class="stat-value">{{ $totalStudents ?? 0 }}</div>
            <div class="stat-label">Total Students</div>
          </div>

          <div class="stat-card">
            <div class="stat-header">
              <div class="stat-icon"><i class="fas fa-star"></i></div>
            </div>
            <div class="stat-value">4.8</div>
            <div class="stat-label">Average Rating</div>
          </div>

          <div class="stat-card">
            <div class="stat-header">
              <div class="stat-icon"><i class="fas fa-dollar-sign"></i></div>
            </div>
            <div class="stat-value">$12,450</div>
            <div class="stat-label">Total Earnings</div>
          </div>
        </div>

        <!-- Recent Courses -->
        <section class="section">
          <div class="section-header">
            <h2>Recent Courses</h2>
            <a href="{{ route('instructor.courses.index') }}" class="btn-primary">
              View All
            </a>
          </div>
          
          <div class="course-table">
            @if(isset($recentCourses) && $recentCourses->count() > 0)
              <table class="table">
                <thead>
                  <tr>
                    <th>Course Name</th>
                    <th>Modules</th>
                    <th>Students</th>
                    <th>Price</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($recentCourses as $course)
                    <tr>
                      <td><strong>{{ $course->title }}</strong></td>
                      <td>{{ $course->subcourses_count }} modules</td>
                      <td>{{ $course->students_count }} students</td>
                      <td>
                        @if($course->price > 0)
                          Rp {{ number_format($course->price, 0, ',', '.') }}
                        @else
                          Free
                        @endif
                      </td>
                      <td>
                        <div class="action-btns">
                          <a href="{{ route('instructor.courses.edit', $course->id) }}" class="action-btn" title="Edit">
                            <i class="fas fa-edit"></i>
                          </a>
                          <form method="POST" action="{{ route('instructor.courses.destroy', $course->id) }}" style="display: inline;" onsubmit="return confirm('Delete this course?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn" title="Delete">
                              <i class="fas fa-trash"></i>
                            </button>
                          </form>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            @else
              <div style="text-align: center; padding: 40px; color: #737373;">
                <i class="fas fa-book" style="font-size: 48px; margin-bottom: 16px; opacity: 0.3;"></i>
                <p>No courses yet. <a href="{{ route('instructor.courses.create') }}" style="color: #6c5ce7;">Create your first course</a></p>
              </div>
            @endif
          </div>
        </section>
      </div>

      <!-- My Courses Tab -->
      <div class="tab-content" id="courses">
        <header class="header">
          <div class="header-left">
            <h1>My Courses</h1>
            <p class="muted">Manage all your courses</p>
          </div>
          <div class="header-right">
            <button class="btn-primary" onclick="switchTab('add-course')">
              <i class="fas fa-plus"></i> Add New Course
            </button>
            <button class="icon-btn"><i class="fas fa-bell"></i></button>
            <div class="user">
              <div class="user-avatar">SJ</div>
              <div class="user-info">
                <div class="user-name">Dr. Sarah Johnson</div>
                <div class="user-role">Instructor</div>
              </div>
            </div>
          </div>
        </header>

        <div class="course-table">
          <table class="table">
            <thead>
              <tr>
                <th>Course Name</th>
                <th>Category</th>
                <th>Students</th>
                <th>Rating</th>
                <th>Revenue</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><strong>Web Development Fundamentals</strong></td>
                <td>Development</td>
                <td>324</td>
                <td>⭐ 4.9</td>
                <td>$8,100</td>
                <td><span class="status-badge published">Published</span></td>
                <td>
                  <div class="action-btns">
                    <button class="action-btn" title="Edit"><i class="fas fa-edit"></i></button>
                    <button class="action-btn" title="Analytics"><i class="fas fa-chart-line"></i></button>
                    <button class="action-btn" title="Delete"><i class="fas fa-trash"></i></button>
                  </div>
                </td>
              </tr>
              <tr>
                <td><strong>Advanced JavaScript Concepts</strong></td>
                <td>Development</td>
                <td>218</td>
                <td>⭐ 4.7</td>
                <td>$5,450</td>
                <td><span class="status-badge published">Published</span></td>
                <td>
                  <div class="action-btns">
                    <button class="action-btn" title="Edit"><i class="fas fa-edit"></i></button>
                    <button class="action-btn" title="Analytics"><i class="fas fa-chart-line"></i></button>
                    <button class="action-btn" title="Delete"><i class="fas fa-trash"></i></button>
                  </div>
                </td>
              </tr>
              <tr>
                <td><strong>React for Beginners</strong></td>
                <td>Development</td>
                <td>0</td>
                <td>-</td>
                <td>$0</td>
                <td><span class="status-badge pending">Pending Review</span></td>
                <td>
                  <div class="action-btns">
                    <button class="action-btn" title="Edit"><i class="fas fa-edit"></i></button>
                    <button class="action-btn" title="Delete"><i class="fas fa-trash"></i></button>
                  </div>
                </td>
              </tr>
              <tr>
                <td><strong>Node.js Masterclass</strong></td>
                <td>Development</td>
                <td>0</td>
                <td>-</td>
                <td>$0</td>
                <td><span class="status-badge draft">Draft</span></td>
                <td>
                  <div class="action-btns">
                    <button class="action-btn" title="Edit"><i class="fas fa-edit"></i></button>
                    <button class="action-btn" title="Delete"><i class="fas fa-trash"></i></button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Add Course Tab -->
      <div class="tab-content" id="add-course">
        <header class="header">
          <div class="header-left">
            <h1>Add New Course</h1>
            <p class="muted">Create a new course (requires admin verification)</p>
          </div>
          <div class="header-right">
            <button class="icon-btn"><i class="fas fa-bell"></i></button>
            <div class="user">
              <div class="user-avatar">SJ</div>
              <div class="user-info">
                <div class="user-name">Dr. Sarah Johnson</div>
                <div class="user-role">Instructor</div>
              </div>
            </div>
          </div>
        </header>

        <div class="form-container">
          <form>
            <div class="form-grid">
              <div class="form-group full-width">
                <label>Course Title *</label>
                <input type="text" placeholder="Enter course title" required>
              </div>

              <div class="form-group">
                <label>Category *</label>
                <select required>
                  <option value="">Select category</option>
                  <option>Web Development</option>
                  <option>Mobile Development</option>
                  <option>Data Science</option>
                  <option>Design</option>
                  <option>Marketing</option>
                </select>
              </div>

              <div class="form-group">
                <label>Level *</label>
                <select required>
                  <option value="">Select level</option>
                  <option>Beginner</option>
                  <option>Intermediate</option>
                  <option>Advanced</option>
                </select>
              </div>

              <div class="form-group">
                <label>Price (USD) *</label>
                <input type="number" placeholder="29.99" required>
              </div>

              <div class="form-group">
                <label>Duration (hours) *</label>
                <input type="number" placeholder="10" required>
              </div>

              <div class="form-group full-width">
                <label>Short Description *</label>
                <textarea placeholder="Brief description of your course (max 200 characters)" maxlength="200" required></textarea>
              </div>

              <div class="form-group full-width">
                <label>Course Description *</label>
                <textarea placeholder="Detailed description of what students will learn" required></textarea>
              </div>

              <div class="form-group full-width">
                <label>Course Thumbnail</label>
                <div class="file-upload">
                  <i class="fas fa-cloud-upload-alt"></i>
                  <p>Click to upload or drag and drop</p>
                  <p class="muted">PNG, JPG up to 5MB (1920x1080 recommended)</p>
                </div>
              </div>

              <div class="form-group full-width">
                <label>Course Preview Video</label>
                <div class="file-upload">
                  <i class="fas fa-video"></i>
                  <p>Click to upload preview video</p>
                  <p class="muted">MP4 up to 100MB (2-3 minutes recommended)</p>
                </div>
              </div>

              <div class="form-group full-width">
                <label>What will students learn? *</label>
                <textarea placeholder="Enter learning outcomes (one per line)" rows="5" required></textarea>
              </div>

              <div class="form-group full-width">
                <label>Prerequisites</label>
                <textarea placeholder="Enter prerequisites (one per line)" rows="3"></textarea>
              </div>
            </div>

            <div class="form-actions">
              <button type="button" class="btn-secondary">Save as Draft</button>
              <button type="submit" class="btn-primary">
                Submit for Review <i class="fas fa-paper-plane"></i>
              </button>
            </div>
          </form>

          <div class="alert-info">
            <p>
              <i class="fas fa-info-circle"></i> 
              <strong>Note:</strong> All new courses must be reviewed and approved by administrators before being published. This process typically takes 2-3 business days.
            </p>
          </div>
        </div>
      </div>

      <!-- Students Tab -->
      <div class="tab-content" id="students">
        <header class="header">
          <div class="header-left">
            <h1>My Students</h1>
            <p class="muted">View and manage students enrolled in your courses</p>
          </div>
          <div class="header-right">
            <button class="icon-btn"><i class="fas fa-bell"></i></button>
            <div class="user">
              <div class="user-avatar">SJ</div>
              <div class="user-info">
                <div class="user-name">Dr. Sarah Johnson</div>
                <div class="user-role">Instructor</div>
              </div>
            </div>
          </div>
        </header>

        <section class="section">
          <div class="student-list">
            <div class="student-item">
              <div class="student-avatar">AR</div>
              <div class="student-info">
                <h4>Ahmad Rizki</h4>
                <p>Web Development Fundamentals</p>
              </div>
              <div class="student-progress">
                <div class="progress-bar-small">
                  <div style="width: 65%"></div>
                </div>
                <span style="font-size: 0.8rem;">65% Complete</span>
              </div>
            </div>

            <div class="student-item">
              <div class="student-avatar">MK</div>
              <div class="student-info">
                <h4>Maria Klein</h4>
                <p>Advanced JavaScript Concepts</p>
              </div>
              <div class="student-progress">
                <div class="progress-bar-small">
                  <div style="width: 82%"></div>
                </div>
                <span style="font-size: 0.8rem;">82% Complete</span>
              </div>
            </div>

            <div class="student-item">
              <div class="student-avatar">JD</div>
              <div class="student-info">
                <h4>John Doe</h4>
                <p>Web Development Fundamentals</p>
              </div>
              <div class="student-progress">
                <div class="progress-bar-small">
                  <div style="width: 45%"></div>
                </div>
                <span style="font-size: 0.8rem;">45% Complete</span>
              </div>
            </div>
          </div>
        </section>
      </div>

      <!-- Analytics Tab -->
      <div class="tab-content" id="analytics">
        <header class="header">
          <div class="header-left">
            <h1>Analytics</h1>
            <p class="muted">Track your course performance and student engagement</p>
          </div>
          <div class="header-right">
            <button class="icon-btn"><i class="fas fa-bell"></i></button>
            <div class="user">
              <div class="user-avatar">SJ</div>
              <div class="user-info">
                <div class="user-name">Dr. Sarah Johnson</div>
                <div class="user-role">Instructor</div>
              </div>
            </div>
          </div>
        </header>

        <div class="analytics-grid">
          <div class="analytics-card">
            <h3>Student Enrollment Trend</h3>
            <div class="chart-placeholder">
              <i class="fas fa-chart-line" style="font-size: 3rem; color: var(--text-muted);"></i>
            </div>
          </div>

          <div class="analytics-card">
            <h3>Course Completion Rate</h3>
            <div class="chart-placeholder">
              <i class="fas fa-chart-pie" style="font-size: 3rem; color: var(--text-muted);"></i>
            </div>
          </div>

          <div class="analytics-card">
            <h3>Revenue Overview</h3>
            <div class="chart-placeholder">
              <i class="fas fa-chart-bar" style="font-size: 3rem; color: var(--text-muted);"></i>
            </div>
          </div>

          <div class="analytics-card">
            <h3>Student Engagement</h3>
            <div class="chart-placeholder">
              <i class="fas fa-chart-area" style="font-size: 3rem; color: var(--text-muted);"></i>
            </div>
          </div>
        </div>
      </div>

      <!-- Earnings Tab -->
      <div class="tab-content" id="earnings">
        <header class="header">
          <div class="header-left">
            <h1>Earnings</h1>
            <p class="muted">Track your revenue and payouts</p>
          </div>
          <div class="header-right">
            <button class="btn-primary">
              <i class="fas fa-download"></i> Download Report
            </button>
            <button class="icon-btn"><i class="fas fa-bell"></i></button>
            <div class="user">
              <div class="user-avatar">SJ</div>
              <div class="user-info">
                <div class="user-name">Dr. Sarah Johnson</div>
                <div class="user-role">Instructor</div>
              </div>
            </div>
          </div>
        </header>

        <div class="stats-grid" style="grid-template-columns: repeat(3, 1fr);">
          <div class="stat-card">
            <div class="stat-value">$12,450</div>
            <div class="stat-label">Total Earnings</div>
          </div>
          <div class="stat-card">
            <div class="stat-value">$3,280</div>
            <div class="stat-label">This Month</div>
          </div>
          <div class="stat-card">
            <div class="stat-value">$9,170</div>
            <div class="stat-label">Available for Withdrawal</div>
          </div>
        </div>

        <section class="section">
          <h2>Transaction History</h2>
          <div class="course-table">
            <table class="table">
              <thead>
                <tr>
                  <th>Date</th>
                  <th>Course</th>
                  <th>Student</th>
                  <th>Amount</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Nov 10, 2024</td>
                  <td>Web Development Fundamentals</td>
                  <td>Ahmad Rizki</td>
                  <td>$25.00</td>
                  <td><span class="status-badge published">Completed</span></td>
                </tr>
                <tr>
                  <td>Nov 9, 2024</td>
                  <td>Advanced JavaScript Concepts</td>
                  <td>Maria Klein</td>
                  <td>$35.00</td>
                  <td><span class="status-badge published">Completed</span></td>
                </tr>
                <tr>
                  <td>Nov 8, 2024</td>
                  <td>Web Development Fundamentals</td>
                  <td>John Doe</td>
                  <td>$25.00</td>
                  <td><span class="status-badge pending">Pending</span></td>
                </tr>
              </tbody>
            </table>
          </div>
        </section>
      </div>

      <!-- Messages Tab -->
      <div class="tab-content" id="messages">
        <header class="header">
          <div class="header-left">
            <h1>Messages</h1>
            <p class="muted">Communicate with your students</p>
          </div>
          <div class="header-right">
            <button class="icon-btn"><i class="fas fa-bell"></i></button>
            <div class="user">
              <div class="user-avatar">SJ</div>
              <div class="user-info">
                <div class="user-name">Dr. Sarah Johnson</div>
                <div class="user-role">Instructor</div>
              </div>
            </div>
          </div>
        </header>

        <p>Messages feature coming soon...</p>
      </div>

      <!-- Settings Tab -->
      <div class="tab-content" id="settings">
        <header class="header">
          <div class="header-left">
            <h1>Settings</h1>
            <p class="muted">Manage your instructor account</p>
          </div>
          <div class="header-right">
            <button class="icon-btn"><i class="fas fa-bell"></i></button>
            <div class="user">
              <div class="user-avatar">SJ</div>
              <div class="user-info">
                <div class="user-name">Dr. Sarah Johnson</div>
                <div class="user-role">Instructor</div>
              </div>
            </div>
          </div>
        </header>

        <p>Settings page content coming soon...</p>
      </div>
    </main>
  </div>

  <script>
    // Tab Navigation
    const navLinks = document.querySelectorAll('.nav-link');
    const tabContents = document.querySelectorAll('.tab-content');

    function switchTab(pageName) {
      navLinks.forEach(nav => nav.classList.remove('active'));
      tabContents.forEach(tab => tab.classList.remove('active'));
      
      const targetNav = document.querySelector(`[data-page="${pageName}"]`);
      const targetTab = document.getElementById(pageName);
      
      if (targetNav) targetNav.classList.add('active');
      if (targetTab) targetTab.classList.add('active');
    }

    navLinks.forEach(link => {
      link.addEventListener('click', function(e) {
        const targetPage = this.dataset.page;
        
        // Hanya prevent default jika link punya data-page (internal tab)
        // Biarkan link dengan href biasa (external page) bekerja normal
        if (targetPage && !this.getAttribute('href')) {
          e.preventDefault();
          switchTab(targetPage);
        }
      });
    });
  </script>
</body>
</html>