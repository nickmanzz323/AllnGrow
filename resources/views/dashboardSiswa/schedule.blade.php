<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Schedule - AllnGrow</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="css/schedule.css">
</head>
<body>
  <div class="app">
    <!-- Sidebar -->
    <aside class="sidebar">
      <div class="logo">AllnGrow</div>
      <nav>
        <a href="dashboardSiswa"><i class="fas fa-home"></i> Dashboard</a>
        <a href="myCourses"><i class="fas fa-book"></i> My Courses</a>
        <a class="active"><i class="fas fa-calendar"></i> Schedule</a>
        <a href="progress"><i class="fas fa-chart-line"></i> Progress</a>
        <a href="settings"><i class="fas fa-chart-line"></i> Settings</a>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="main">
      <!-- Header -->
      <header class="header">
        <div class="header-left">
          <h1>My Schedule</h1>
          <p class="muted">Manage your classes and learning sessions</p>
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

      <!-- Calendar Header -->
      <div class="calendar-header">
        <div class="calendar-nav">
          <button class="nav-btn"><i class="fas fa-chevron-left"></i></button>
          <h2 class="current-month">November 2024</h2>
          <button class="nav-btn"><i class="fas fa-chevron-right"></i></button>
        </div>
        <button class="btn-today">Today</button>
      </div>

      <!-- Week Days -->
      <div class="week-days">
        <div class="day-label">Mon</div>
        <div class="day-label">Tue</div>
        <div class="day-label">Wed</div>
        <div class="day-label">Thu</div>
        <div class="day-label">Fri</div>
        <div class="day-label">Sat</div>
        <div class="day-label">Sun</div>
      </div>

      <!-- Calendar Grid -->
      <div class="calendar-grid">
        <!-- Previous Month Days -->
        <div class="day other-month">28</div>
        <div class="day other-month">29</div>
        <div class="day other-month">30</div>
        <div class="day other-month">31</div>
        
        <!-- Current Month Days -->
        <div class="day">1</div>
        <div class="day">2</div>
        <div class="day">3</div>
        
        <div class="day">4</div>
        <div class="day">5</div>
        <div class="day">6</div>
        <div class="day">7</div>
        <div class="day has-event">
          8
          <div class="event-dot"></div>
        </div>
        <div class="day">9</div>
        <div class="day">10</div>
        
        <div class="day">11</div>
        <div class="day">12</div>
        <div class="day today">
          13
          <div class="event-dot"></div>
        </div>
        <div class="day has-event">
          14
          <div class="event-dot"></div>
        </div>
        <div class="day has-event">
          15
          <div class="event-dot"></div>
        </div>
        <div class="day">16</div>
        <div class="day">17</div>
        
        <div class="day has-event">
          18
          <div class="event-dot"></div>
        </div>
        <div class="day">19</div>
        <div class="day has-event">
          20
          <div class="event-dot"></div>
        </div>
        <div class="day">21</div>
        <div class="day">22</div>
        <div class="day">23</div>
        <div class="day">24</div>
        
        <div class="day">25</div>
        <div class="day">26</div>
        <div class="day">27</div>
        <div class="day">28</div>
        <div class="day">29</div>
        <div class="day">30</div>
        
        <!-- Next Month Days -->
        <div class="day other-month">1</div>
      </div>

      <!-- Upcoming Classes -->
      <section class="section">
        <h2>Upcoming Classes</h2>
        
        <div class="timeline">
          <!-- Today -->
          <div class="timeline-item">
            <div class="timeline-date">
              <div class="date-day">13</div>
              <div class="date-info">
                <div class="date-month">Nov</div>
                <div class="date-label">Today</div>
              </div>
            </div>
            
            <div class="timeline-events">
              <div class="event-card live">
                <div class="event-time">10:00 AM - 11:30 AM</div>
                <div class="event-content">
                  <h3>Web Development Fundamentals</h3>
                  <p class="event-instructor">
                    <i class="fas fa-user-circle"></i> Dr. Sarah Johnson
                  </p>
                  <div class="event-meta">
                    <span><i class="fas fa-video"></i> Live Session</span>
                    <span><i class="fas fa-users"></i> 24 Students</span>
                  </div>
                </div>
                <button class="btn-join">Join Now</button>
              </div>

              <div class="event-card">
                <div class="event-time">02:00 PM - 03:30 PM</div>
                <div class="event-content">
                  <h3>Data Science Basics - Lab Session</h3>
                  <p class="event-instructor">
                    <i class="fas fa-user-circle"></i> Prof. Michael Chen
                  </p>
                  <div class="event-meta">
                    <span><i class="fas fa-laptop-code"></i> Lab Practice</span>
                    <span><i class="fas fa-users"></i> 18 Students</span>
                  </div>
                </div>
                <button class="btn-reminder">
                  <i class="fas fa-bell"></i> Set Reminder
                </button>
              </div>
            </div>
          </div>

          <!-- Tomorrow -->
          <div class="timeline-item">
            <div class="timeline-date">
              <div class="date-day">14</div>
              <div class="date-info">
                <div class="date-month">Nov</div>
                <div class="date-label">Tomorrow</div>
              </div>
            </div>
            
            <div class="timeline-events">
              <div class="event-card">
                <div class="event-time">09:00 AM - 10:30 AM</div>
                <div class="event-content">
                  <h3>UI/UX Design Principles</h3>
                  <p class="event-instructor">
                    <i class="fas fa-user-circle"></i> Emma Williams
                  </p>
                  <div class="event-meta">
                    <span><i class="fas fa-video"></i> Live Session</span>
                    <span><i class="fas fa-users"></i> 32 Students</span>
                  </div>
                </div>
                <button class="btn-reminder">
                  <i class="fas fa-bell"></i> Set Reminder
                </button>
              </div>
            </div>
          </div>

          <!-- Friday -->
          <div class="timeline-item">
            <div class="timeline-date">
              <div class="date-day">15</div>
              <div class="date-info">
                <div class="date-month">Nov</div>
                <div class="date-label">Friday</div>
              </div>
            </div>
            
            <div class="timeline-events">
              <div class="event-card">
                <div class="event-time">11:00 AM - 12:00 PM</div>
                <div class="event-content">
                  <h3>Mobile App Development - Q&A</h3>
                  <p class="event-instructor">
                    <i class="fas fa-user-circle"></i> John Anderson
                  </p>
                  <div class="event-meta">
                    <span><i class="fas fa-comments"></i> Q&A Session</span>
                    <span><i class="fas fa-users"></i> 15 Students</span>
                  </div>
                </div>
                <button class="btn-reminder">
                  <i class="fas fa-bell"></i> Set Reminder
                </button>
              </div>

              <div class="event-card">
                <div class="event-time">03:00 PM - 04:30 PM</div>
                <div class="event-content">
                  <h3>Web Development - Project Review</h3>
                  <p class="event-instructor">
                    <i class="fas fa-user-circle"></i> Dr. Sarah Johnson
                  </p>
                  <div class="event-meta">
                    <span><i class="fas fa-clipboard-check"></i> Review</span>
                    <span><i class="fas fa-users"></i> 24 Students</span>
                  </div>
                </div>
                <button class="btn-reminder">
                  <i class="fas fa-bell"></i> Set Reminder
                </button>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
  </div>
</body>
</html>