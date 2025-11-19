<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ $course->title }} - AllnGrow</title>
  <link rel="stylesheet" href="{{ asset('css/landingPage/landing.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/overviewcourses.css') }}" />
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
        <img src="{{ asset('images/AllnGrowLogo.svg') }}" alt="AllnGrow Logo" width="155" height="auto">
      </div>
      <nav class="nav-menu">
        <a href="{{ route('home') }}" class="nav-item">Home</a>
        <a href="{{ route('about') }}" class="nav-item">About Us</a>
        <a href="{{ route('courses') }}" class="nav-item active">Courses</a>
        <a href="{{ route('student.login') }}" class="nav-item">Get Started</a>
      </nav>
    </div>
  </header>

  <!-- ======================
       COURSE DETAIL SECTION
       ====================== -->
  <section class="course-detail fade-up delay-1">

    <div class="course-header">
      <div class="course-image">
        @if($course->thumbnail)
          <img src="{{ Storage::url($course->thumbnail) }}" alt="{{ $course->title }}" />
        @else
          <div style="width: 100%; height: 100%; background: #1a1a1a; display: flex; align-items: center; justify-content: center;">
            <i class="fas fa-book" style="font-size: 5rem; color: #333;"></i>
          </div>
        @endif
      </div>
      <h1>{{ $course->title }}</h1>
      <p class="subtitle">
        {{ $course->description ?? 'Pelajari materi ini dan tingkatkan kemampuan Anda.' }}
      </p>
      @if($course->category)
        <span style="display: inline-block; padding: 6px 16px; background: #1f1f1f; border-radius: 999px; font-size: 0.85rem; color: #9ca3af; margin-top: 10px;">
          {{ $course->category->name }}
        </span>
      @endif
    </div>

    <!-- Course Info -->
    <div class="course-info fade-up delay-2">
      <div class="course-main">
        <h3>Tentang Course Ini</h3>
        <p style="color: #d4d4d4; line-height: 1.8;">
          {{ $course->description ?? 'Tidak ada deskripsi tersedia.' }}
        </p>

        <h3>Yang Akan Anda Pelajari</h3>
        <ul>
          @if($course->chapters->count() > 0)
            @foreach($course->chapters->take(3) as $chapter)
              <li><strong>{{ $chapter->title }}</strong></li>
              @foreach($chapter->lessons->take(2) as $lesson)
                <li style="padding-left: 1rem;">{{ $lesson->title }}</li>
              @endforeach
            @endforeach
            @php
              $totalLessons = $course->chapters->sum(fn($c) => $c->lessons->count());
            @endphp
            @if($totalLessons > 6)
              <li>Dan {{ $totalLessons - 6 }} materi lainnya...</li>
            @endif
          @else
            <li>Materi pembelajaran akan segera tersedia</li>
          @endif
        </ul>

        <h3>Keuntungan</h3>
        <ul>
          <li>Sertifikat digital resmi</li>
          <li>Akses materi selamanya</li>
          <li>Bimbingan dari instruktur berpengalaman</li>
        </ul>
      </div>
      <div class="enroll-box">
        <div class="price">
          @if($course->price == 0)
            <h2 style="color: #4ade80;">Gratis</h2>
            <p>Akses penuh tanpa biaya</p>
          @else
            <h2>Rp {{ number_format($course->price, 0, ',', '.') }}</h2>
            <p>Akses penuh ke semua materi</p>
          @endif
        </div>
        <a href="{{ route('student.login') }}" class="enroll-btn" style="text-decoration: none; text-align: center; display: block;">
          Daftar Sekarang
        </a>
        <ul>
          <li><i class="fas fa-book"></i> {{ $course->chapters_count }} Bab</li>
          <li><i class="fas fa-play-circle"></i> {{ $course->lessons_count }} Materi</li>
          <li><i class="fas fa-users"></i> {{ $course->students_count }} Siswa</li>
          <li><i class="fas fa-globe"></i> Bahasa: Indonesia</li>
        </ul>
      </div>
    </div>

    <div class="course-main fade-up delay-3">
      <!-- Lesson Summary Section -->
      <div class="lesson-summary">
        <div class="lesson-item">
          <i class="fas fa-book"></i>
          <span><strong>{{ $course->chapters_count }} Bab</strong></span>
        </div>
        <div class="lesson-item">
          <i class="fa-regular fa-file-lines"></i>
          <span><strong>{{ $course->lessons_count }} Materi</strong></span>
        </div>
        <div class="lesson-item">
          <i class="fa-regular fa-user"></i>
          <span>{{ $course->students_count }} Siswa</span>
        </div>
        @if($course->average_rating)
        <div class="lesson-item">
          <i class="fas fa-star" style="color: #fbbf24;"></i>
          <span>{{ number_format($course->average_rating, 1) }} Rating</span>
        </div>
        @endif
      </div>
      <hr class="lesson-divider" />

      <!-- Course Outline -->
      <div class="course-outline fade-up delay-4">
        @if($course->chapters->count() > 0)
          @foreach($course->chapters as $chapterIndex => $chapter)
            <details {{ $chapterIndex === 0 ? 'open' : '' }}>
              <summary>
                <span style="color: #3b82f6; font-weight: 600;">Bab {{ $chapterIndex + 1 }}:</span> {{ $chapter->title }}
              </summary>
              <div style="padding-left: 1rem;">
                @if($chapter->description)
                  <p style="margin-bottom: 0.5rem;">{{ $chapter->description }}</p>
                @endif
                @if($chapter->lessons->count() > 0)
                  <ul style="list-style: none; padding: 0; margin: 0;">
                    @foreach($chapter->lessons as $lessonIndex => $lesson)
                      <li style="padding: 0.5rem 0; border-bottom: 1px solid #262626; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-play-circle" style="color: #4ade80; font-size: 0.8rem;"></i>
                        {{ $lessonIndex + 1 }}. {{ $lesson->title }}
                        @if($lesson->is_free)
                          <span style="background: #22c55e; color: #fff; padding: 0.1rem 0.3rem; border-radius: 3px; font-size: 0.65rem;">FREE</span>
                        @endif
                      </li>
                    @endforeach
                  </ul>
                @else
                  <p style="color: #737373;">Belum ada materi dalam bab ini.</p>
                @endif
              </div>
            </details>
          @endforeach
        @else
          <details open>
            <summary>Materi Course</summary>
            <p>Materi pembelajaran akan segera ditambahkan oleh instruktur.</p>
          </details>
        @endif
      </div>
    </div>


    <!-- Instructor -->
    <div class="instructor fade-up delay-1">
      <h2>Instruktur</h2>
      <div class="instructor-card">
        <div style="width: 180px; height: 180px; border-radius: 12px; background: #1a1a1a; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
          <i class="fas fa-user" style="font-size: 4rem; color: #333;"></i>
        </div>
        <div class="instructor-info">
          <h3>{{ $course->instructor->detail->fullname ?? $course->instructor->name ?? $course->instructor->email ?? 'Instruktur' }}</h3>
          @if($course->instructor && $course->instructor->detail)
            <p>{{ $course->instructor->detail->expertise ?? 'Expert Instructor' }}</p>
            @if($course->instructor->detail->bio)
              <p class="bio">{{ $course->instructor->detail->bio }}</p>
            @else
              <p class="bio">Instruktur berpengalaman yang siap membimbing Anda dalam perjalanan belajar.</p>
            @endif
          @else
            <p>Expert Instructor</p>
            <p class="bio">Instruktur berpengalaman yang siap membimbing Anda dalam perjalanan belajar.</p>
          @endif
        </div>
      </div>
    </div>

    <!-- Testimonials / Reviews -->
    @if($course->ratings && $course->ratings->count() > 0)
    <div class="testimonials fade-up delay-2">
      <h2>Ulasan dari Peserta</h2>
      <div class="testimonial-slider">
        <div class="testimonial-track">
          @foreach($course->ratings as $rating)
            <div class="testimonial-card">
              <div style="margin-bottom: 8px;">
                @for($i = 1; $i <= 5; $i++)
                  <i class="fas fa-star" style="color: {{ $i <= $rating->rating ? '#fbbf24' : '#333' }}; font-size: 0.8rem;"></i>
                @endfor
              </div>
              <p>"{{ $rating->review ?? 'Course yang sangat bermanfaat!' }}"</p>
              <span>- {{ $rating->student->detail->fullname ?? $rating->student->email ?? 'Student' }}</span>
            </div>
          @endforeach
          {{-- Duplicate for infinite scroll effect --}}
          @foreach($course->ratings as $rating)
            <div class="testimonial-card">
              <div style="margin-bottom: 8px;">
                @for($i = 1; $i <= 5; $i++)
                  <i class="fas fa-star" style="color: {{ $i <= $rating->rating ? '#fbbf24' : '#333' }}; font-size: 0.8rem;"></i>
                @endfor
              </div>
              <p>"{{ $rating->review ?? 'Course yang sangat bermanfaat!' }}"</p>
              <span>- {{ $rating->student->detail->fullname ?? $rating->student->email ?? 'Student' }}</span>
            </div>
          @endforeach
        </div>
      </div>
    </div>
    @endif

    <!-- CTA Section -->
    <div style="text-align: center; padding: 60px 20px; background: #0f0f0f; border-radius: 24px; margin-top: 60px;">
      <h2 style="font-size: 1.8rem; margin-bottom: 16px; color: #fff;">Siap Untuk Mulai Belajar?</h2>
      <p style="color: #a3a3a3; margin-bottom: 24px; max-width: 500px; margin-left: auto; margin-right: auto;">
        Bergabunglah dengan {{ $course->students_count }} peserta lainnya dan mulai perjalanan belajar Anda hari ini.
      </p>
      <a href="{{ route('student.login') }}" style="display: inline-flex; align-items: center; gap: 8px; padding: 14px 32px; background: #fff; color: #000; text-decoration: none; border-radius: 10px; font-weight: 600; transition: all 0.2s;">
        <span>Daftar Sekarang</span>
        <i class="fas fa-arrow-right"></i>
      </a>
    </div>

  </section>

  <!-- Back to top -->
  <div style="text-align: center; padding: 40px 0;">
    <a href="{{ route('courses') }}" style="color: #a3a3a3; text-decoration: none; font-size: 0.9rem;">
      <i class="fas fa-arrow-left"></i> Kembali ke Daftar Courses
    </a>
  </div>
</body>
</html>
