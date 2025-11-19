<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $course->title }} - AllnGrow</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/dashboardSiswa/dashboardSiswa.css') }}">
  <style>
    .course-overview {
      max-width: 1000px;
      margin: 0 auto;
    }

    .course-hero {
      position: relative;
      border-radius: 16px;
      overflow: hidden;
      margin-bottom: 2rem;
    }

    .course-hero img {
      width: 100%;
      height: 300px;
      object-fit: cover;
    }

    .course-hero-placeholder {
      width: 100%;
      height: 300px;
      background: #1a1a1a;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .course-hero-placeholder i {
      font-size: 5rem;
      color: #333;
    }

    .course-header-info {
      padding: 1.5rem;
      background: linear-gradient(to top, rgba(0,0,0,0.9), transparent);
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
    }

    .course-category {
      display: inline-block;
      padding: 0.25rem 0.75rem;
      background: rgba(255,255,255,0.15);
      border-radius: 6px;
      font-size: 0.75rem;
      color: #fff;
      margin-bottom: 0.5rem;
    }

    .course-title-main {
      font-size: 1.75rem;
      font-weight: 700;
      color: #fff;
      margin: 0;
    }

    .course-content {
      display: grid;
      grid-template-columns: 1fr 320px;
      gap: 2rem;
    }

    .course-main {
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
    }

    .course-section {
      background: #0f0f0f;
      border-radius: 12px;
      padding: 1.5rem;
      border: 1px solid #262626;
    }

    .course-section h3 {
      font-size: 1rem;
      font-weight: 600;
      color: #fff;
      margin: 0 0 1rem 0;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .course-section h3 i {
      color: #a3a3a3;
    }

    .course-description {
      color: #d4d4d4;
      line-height: 1.7;
      font-size: 0.95rem;
    }

    .course-stats {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 1rem;
    }

    .stat-item {
      text-align: center;
      padding: 1rem;
      background: #1a1a1a;
      border-radius: 8px;
    }

    .stat-value {
      font-size: 1.5rem;
      font-weight: 700;
      color: #fff;
    }

    .stat-label {
      font-size: 0.75rem;
      color: #a3a3a3;
      margin-top: 0.25rem;
    }

    .lessons-list {
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
    }

    .lesson-item {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      padding: 0.75rem;
      background: #1a1a1a;
      border-radius: 8px;
      color: #d4d4d4;
      font-size: 0.9rem;
    }

    .lesson-item i {
      color: #a3a3a3;
      font-size: 0.8rem;
    }

    .instructor-card {
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .instructor-avatar {
      width: 60px;
      height: 60px;
      border-radius: 12px;
      background: #1a1a1a;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      overflow: hidden;
    }

    .instructor-avatar img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .instructor-avatar i {
      font-size: 1.5rem;
      color: #404040;
    }

    .instructor-info h4 {
      margin: 0;
      font-size: 1rem;
      color: #fff;
    }

    .instructor-info p {
      margin: 0.25rem 0 0 0;
      font-size: 0.85rem;
      color: #a3a3a3;
    }

    .course-sidebar {
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }

    .enroll-card {
      background: #0f0f0f;
      border-radius: 12px;
      padding: 1.5rem;
      border: 1px solid #262626;
      position: sticky;
      top: 1rem;
    }

    .price-display {
      text-align: center;
      margin-bottom: 1.5rem;
      padding-bottom: 1.5rem;
      border-bottom: 1px solid #262626;
    }

    .price-amount {
      font-size: 2rem;
      font-weight: 700;
      color: #fff;
    }

    .price-amount.free {
      color: #4ade80;
    }

    .price-label {
      font-size: 0.85rem;
      color: #a3a3a3;
      margin-top: 0.25rem;
    }

    .enroll-btn {
      width: 100%;
      padding: 1rem;
      border: none;
      border-radius: 10px;
      font-weight: 600;
      font-size: 1rem;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      transition: all 0.2s;
      text-decoration: none;
    }

    .enroll-btn.primary {
      background: #fff;
      color: #000;
    }

    .enroll-btn.primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(255,255,255,0.2);
    }

    .enroll-btn.secondary {
      background: #1a1a1a;
      color: #fff;
      border: 1px solid #333;
    }

    .enroll-btn.secondary:hover {
      background: #262626;
    }

    .enroll-btn.disabled {
      background: #1f1f1f;
      color: #a3a3a3;
      cursor: not-allowed;
    }

    .course-features {
      margin-top: 1rem;
    }

    .feature-item {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      padding: 0.5rem 0;
      font-size: 0.85rem;
      color: #d4d4d4;
    }

    .feature-item i {
      color: #4ade80;
      width: 16px;
    }

    .back-link {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      color: #a3a3a3;
      text-decoration: none;
      font-size: 0.9rem;
      margin-bottom: 1.5rem;
      transition: color 0.2s;
    }

    .back-link:hover {
      color: #fff;
    }

    .enrollment-status {
      padding: 0.75rem;
      border-radius: 8px;
      font-size: 0.85rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      margin-bottom: 1rem;
    }

    .enrollment-status.pending {
      background: #422006;
      color: #fbbf24;
      border: 1px solid #854d0e;
    }

    .enrollment-status.paid {
      background: #052e16;
      color: #4ade80;
      border: 1px solid #166534;
    }

    @media (max-width: 768px) {
      .course-content {
        grid-template-columns: 1fr;
      }

      .course-stats {
        grid-template-columns: repeat(2, 1fr);
      }

      .course-hero img,
      .course-hero-placeholder {
        height: 200px;
      }
    }
  </style>
</head>
<body>
  <div class="app">
    <!-- Sidebar -->
    <aside class="sidebar">
      <div class="logo">AllnGrow</div>
      <nav>
        <a href="{{ route('dashboardSiswa') }}"><i class="fas fa-home"></i> Dashboard</a>
        <a href="{{ route('student.my-courses') }}"><i class="fas fa-book"></i> My Courses</a>
        <a href="{{ route('student.browse-courses') }}" class="active"><i class="fas fa-search"></i> Browse Courses</a>
        <a href="{{ route('schedule') }}"><i class="fas fa-calendar"></i> Schedule</a>
        <a href="{{ route('progress') }}"><i class="fas fa-chart-line"></i> Progress</a>
        <a href="{{ route('settings') }}"><i class="fas fa-cog"></i> Settings</a>
        <div style="margin-top: auto; padding-top: 2rem; border-top: 1px solid #262626;">
          <form method="POST" action="{{ route('student.logout') }}">
            @csrf
            <button type="submit" style="width: 100%; text-align: left; background: none; border: none; color: #f5f5f5; cursor: pointer; font: inherit; padding: 0.75rem 1rem; display: flex; align-items: center; gap: 0.75rem; transition: all 0.2s; border-radius: 8px;" onmouseover="this.style.background='#1a1a1a'; this.style.color='#ef4444'" onmouseout="this.style.background=''; this.style.color='#f5f5f5'">
              <i class="fas fa-sign-out-alt"></i> Logout
            </button>
          </form>
        </div>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="main">
      <!-- Header -->
      <header class="header">
        <div class="header-left">
          <h1>Course Overview</h1>
          <p class="muted">Preview course details before enrolling</p>
        </div>
        <div class="header-right">
          <button class="icon-btn"><i class="fas fa-bell"></i></button>
          <div class="user">
            <div class="user-avatar">
              @php
                $name = $student->detail->fullname ?? $student->email;
                $words = explode(' ', $name);
                $initials = '';
                foreach(array_slice($words, 0, 2) as $word) {
                  $initials .= strtoupper(substr($word, 0, 1));
                }
                echo $initials;
              @endphp
            </div>
            <div class="user-info">
              <div class="user-name">{{ $student->detail->fullname ?? 'Student' }}</div>
              <div class="user-role">Student</div>
            </div>
          </div>
        </div>
      </header>

      <!-- Course Overview Content -->
      <div class="course-overview">
        <a href="{{ route('student.browse-courses') }}" class="back-link">
          <i class="fas fa-arrow-left"></i> Kembali ke Browse Courses
        </a>

        <!-- Hero Section -->
        <div class="course-hero">
          @if($course->thumbnail)
            <img src="{{ Storage::url($course->thumbnail) }}" alt="{{ $course->title }}">
          @else
            <div class="course-hero-placeholder">
              <i class="fas fa-book"></i>
            </div>
          @endif
          <div class="course-header-info">
            @if($course->category)
              <span class="course-category">{{ $course->category->name }}</span>
            @endif
            <h1 class="course-title-main">{{ $course->title }}</h1>
          </div>
        </div>

        <!-- Main Content Grid -->
        <div class="course-content">
          <!-- Left Column - Course Details -->
          <div class="course-main">
            <!-- Stats -->
            <div class="course-stats">
              <div class="stat-item">
                <div class="stat-value">{{ $course->chapters_count }}</div>
                <div class="stat-label">Bab</div>
              </div>
              <div class="stat-item">
                <div class="stat-value">{{ $course->lessons_count }}</div>
                <div class="stat-label">Materi</div>
              </div>
              <div class="stat-item">
                <div class="stat-value">{{ $course->students_count }}</div>
                <div class="stat-label">Siswa</div>
              </div>
              <div class="stat-item">
                <div class="stat-value">
                  @if($course->average_rating)
                    {{ number_format($course->average_rating, 1) }}
                  @else
                    -
                  @endif
                </div>
                <div class="stat-label">Rating</div>
              </div>
            </div>

            <!-- Description -->
            <div class="course-section">
              <h3><i class="fas fa-info-circle"></i> Deskripsi</h3>
              <p class="course-description">
                {{ $course->description ?? 'Tidak ada deskripsi tersedia untuk course ini.' }}
              </p>
            </div>

            <!-- Curriculum -->
            <div class="course-section">
              <h3><i class="fas fa-list"></i> Kurikulum ({{ $course->chapters_count }} Bab, {{ $course->lessons_count }} Materi)</h3>
              @if($course->chapters->count() > 0)
                <div class="lessons-list">
                  @foreach($course->chapters as $chapterIndex => $chapter)
                    <div style="margin-bottom: 1rem;">
                      <div style="font-weight: 600; margin-bottom: 0.5rem; color: #3b82f6;">
                        <i class="fas fa-book"></i> Bab {{ $chapterIndex + 1 }}: {{ $chapter->title }}
                      </div>
                      @foreach($chapter->lessons as $lessonIndex => $lesson)
                        <div class="lesson-item" style="padding-left: 1.5rem;">
                          <i class="fas fa-play-circle"></i>
                          <span>{{ $lessonIndex + 1 }}. {{ $lesson->title }}</span>
                          @if($lesson->is_free)
                            <span style="background: #22c55e; color: #fff; padding: 0.1rem 0.3rem; border-radius: 3px; font-size: 0.65rem; margin-left: 0.5rem;">FREE</span>
                          @endif
                        </div>
                      @endforeach
                    </div>
                  @endforeach
                </div>
              @else
                <p style="color: #a3a3a3; font-size: 0.9rem;">Materi pembelajaran akan segera ditambahkan.</p>
              @endif
            </div>

            <!-- Instructor -->
            <div class="course-section">
              <h3><i class="fas fa-user-tie"></i> Instruktur</h3>
              <div class="instructor-card">
                <div class="instructor-avatar">
                  <i class="fas fa-user"></i>
                </div>
                <div class="instructor-info">
                  <h4>{{ $course->instructor->detail->fullname ?? $course->instructor->name ?? $course->instructor->email ?? 'Instructor' }}</h4>
                  <p>{{ $course->instructor->detail->expertise ?? 'Expert Instructor' }}</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Right Column - Enroll Card -->
          <div class="course-sidebar">
            <div class="enroll-card">
              <div class="price-display">
                @if($course->price == 0)
                  <div class="price-amount free">Gratis</div>
                  <div class="price-label">Akses penuh tanpa biaya</div>
                @else
                  <div class="price-amount">Rp {{ number_format($course->price, 0, ',', '.') }}</div>
                  <div class="price-label">Akses penuh ke semua materi</div>
                @endif
              </div>

              @if($isEnrolled)
                @if($enrollment && $enrollment->pivot->payment_status === 'confirmed')
                  {{-- Already confirmed - can start learning --}}
                  <div class="enrollment-status paid">
                    <i class="fas fa-check-circle"></i>
                    Anda sudah terdaftar
                  </div>
                  <a href="{{ route('student.view-course', $course->courseID) }}" class="enroll-btn primary">
                    <i class="fas fa-play"></i> Mulai Belajar
                  </a>
                @elseif($enrollment && $enrollment->pivot->payment_status === 'pending')
                  {{-- Pending payment - only for paid courses --}}
                  <div class="enrollment-status pending">
                    <i class="fas fa-clock"></i>
                    Menunggu konfirmasi pembayaran
                  </div>
                  <button class="enroll-btn disabled" disabled>
                    <i class="fas fa-hourglass-half"></i> Pending
                  </button>
                @else
                  {{-- Fallback for any other status --}}
                  <div class="enrollment-status paid">
                    <i class="fas fa-check-circle"></i>
                    Anda sudah terdaftar
                  </div>
                  <a href="{{ route('student.view-course', $course->courseID) }}" class="enroll-btn primary">
                    <i class="fas fa-play"></i> Mulai Belajar
                  </a>
                @endif
              @else
                <form method="POST" action="{{ route('student.enroll', $course->courseID) }}">
                  @csrf
                  @if($course->price == 0)
                    <button type="submit" class="enroll-btn primary" onclick="return confirm('Apakah Anda yakin ingin mendaftar course gratis ini?')">
                      <i class="fas fa-plus"></i> Daftar Gratis
                    </button>
                  @else
                    <button type="submit" class="enroll-btn primary" onclick="return confirm('Apakah Anda yakin ingin mendaftar course ini?')">
                      <i class="fas fa-plus"></i> Daftar Sekarang
                    </button>
                  @endif
                </form>
              @endif

              <div class="course-features">
                <div class="feature-item">
                  <i class="fas fa-check"></i>
                  <span>{{ $course->lessons_count }} Materi</span>
                </div>
                <div class="feature-item">
                  <i class="fas fa-check"></i>
                  <span>Akses selamanya</span>
                </div>
                <div class="feature-item">
                  <i class="fas fa-check"></i>
                  <span>Sertifikat digital</span>
                </div>
                <div class="feature-item">
                  <i class="fas fa-check"></i>
                  <span>Bimbingan instruktur</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</body>
</html>
