<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Add New Course - AllnGrow Instructor</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    :root {
      --bg: #000000;
      --surface: #0d0d0d;
      --surface-soft: #111111;
      --text: #f5f5f5;
      --text-muted: #a3a3a3;
      --border: #262626;
      --primary: #ffffff;
      --primary-dark: #e5e5e5;
      --accent: #3b82f6;
      --success: #22c55e;
      --radius: 12px;
      --shadow: 0 2px 10px rgba(0,0,0,0.7);
    }

    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
      font-family: 'Inter', sans-serif;
      background: var(--bg);
      color: var(--text);
      line-height: 1.6;
      min-height: 100vh;
    }

    .page-container { max-width: 1200px; margin: 0 auto; padding: 2rem; }

    .page-header { margin-bottom: 2rem; }

    .back-link {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      color: var(--text-muted);
      text-decoration: none;
      margin-bottom: 1.5rem;
      font-size: 0.9rem;
      font-weight: 500;
      transition: all 0.2s;
      padding: 0.5rem 1rem;
      border-radius: 8px;
    }

    .back-link:hover {
      background: #171717;
      color: var(--text);
      transform: translateX(-4px);
    }

    .page-header h1 { font-size: 1.75rem; font-weight: 700; margin-bottom: 0.5rem; }
    .page-header p { color: var(--text-muted); font-size: 0.95rem; }

    .alert {
      padding: 1rem 1.25rem;
      border-radius: var(--radius);
      margin-bottom: 1.5rem;
      font-size: 0.9rem;
      display: flex;
      align-items: flex-start;
      gap: 0.75rem;
      border: 1px solid var(--border);
      background: #111111;
    }

    .alert i { font-size: 1.25rem; flex-shrink: 0; margin-top: 0.125rem; }
    .alert-success { background: #052e16; border-color: #166534; }
    .alert-success i { color: #4ade80; }
    .alert-error { background: #450a0a; border-color: #991b1b; }
    .alert-error i { color: #f87171; }
    .alert-info { background: #0c1929; border-color: #1e3a5f; }
    .alert-info i { color: #60a5fa; }

    .form-container {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      padding: 2.5rem;
    }

    .form-section {
      margin-bottom: 2.5rem;
      padding-bottom: 2.5rem;
      border-bottom: 1px solid var(--border);
    }

    .form-section:last-child { margin-bottom: 0; padding-bottom: 0; border-bottom: none; }

    .form-section h2 {
      font-size: 1.25rem;
      font-weight: 600;
      margin-bottom: 0.5rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .form-section h2 i { font-size: 1rem; color: var(--accent); }
    .form-section > p { color: var(--text-muted); font-size: 0.875rem; margin-bottom: 1.5rem; }

    .form-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem; }
    .form-group { display: flex; flex-direction: column; gap: 0.5rem; }
    .form-group.full-width { grid-column: 1 / -1; }
    .form-group label { font-size: 0.9rem; font-weight: 600; }
    .required { color: #ef4444; }

    .form-group input[type="text"],
    .form-group input[type="number"],
    .form-group input[type="url"],
    .form-group textarea,
    .form-group select {
      width: 100%;
      padding: 0.875rem 1rem;
      border: 1px solid var(--border);
      border-radius: 10px;
      font-size: 0.95rem;
      font-family: inherit;
      background: #050505;
      color: var(--text);
      transition: all 0.2s;
    }

    .form-group input::placeholder,
    .form-group textarea::placeholder { color: #6b6b6b; }

    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus {
      outline: none;
      border-color: var(--accent);
      box-shadow: 0 0 0 2px rgba(59,130,246,0.2);
    }

    .form-group textarea { resize: vertical; min-height: 100px; }
    .hint { font-size: 0.8rem; color: var(--text-muted); margin-top: 0.25rem; }

    .file-upload-wrapper { position: relative; }
    .file-upload-wrapper input[type="file"] { position: absolute; left: -9999px; }

    .file-upload-label {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.75rem;
      padding: 2rem;
      border: 2px dashed var(--border);
      border-radius: 10px;
      cursor: pointer;
      transition: all 0.2s;
      background: #050505;
    }

    .file-upload-label:hover { border-color: var(--accent); background: #161616; }
    .file-upload-label i { color: var(--accent); font-size: 2rem; }
    .file-upload-label span { font-size: 0.95rem; font-weight: 500; }
    .file-name { font-size: 0.875rem; color: var(--success); margin-top: 0.5rem; display: flex; align-items: center; gap: 0.5rem; }

    /* Chapter Card */
    .chapter-card {
      background: #0a0a0a;
      border: 1px solid var(--border);
      border-radius: var(--radius);
      margin-bottom: 1.5rem;
      overflow: hidden;
    }

    .chapter-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1.25rem;
      background: #111;
      border-bottom: 1px solid var(--border);
      cursor: pointer;
    }

    .chapter-header:hover { background: #161616; }

    .chapter-title {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      font-weight: 600;
    }

    .chapter-number {
      background: var(--accent);
      color: #fff;
      padding: 0.25rem 0.75rem;
      border-radius: 20px;
      font-size: 0.75rem;
      font-weight: 700;
    }

    .chapter-actions { display: flex; gap: 0.5rem; }

    .btn-icon {
      width: 32px;
      height: 32px;
      border-radius: 8px;
      border: none;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.8rem;
      transition: all 0.2s;
    }

    .btn-icon.toggle { background: #1e3a5f; color: #60a5fa; }
    .btn-icon.toggle:hover { background: #1e40af; }
    .btn-icon.remove { background: #450a0a; color: #f87171; }
    .btn-icon.remove:hover { background: #7f1d1d; }

    .chapter-body { padding: 1.25rem; display: none; }
    .chapter-body.active { display: block; }

    /* Lesson Card - Minimalist Design */
    .lesson-card {
      background: #0a0a0a;
      border: 1px solid var(--border);
      border-radius: 12px;
      margin-bottom: 1rem;
      overflow: hidden;
      transition: all 0.2s;
    }

    .lesson-card:hover {
      border-color: #3f3f3f;
    }

    .lesson-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1rem 1.25rem;
      background: #111;
      border-bottom: 1px solid var(--border);
    }

    .lesson-title {
      font-size: 0.9rem;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }

    .lesson-number {
      background: var(--accent);
      color: #fff;
      padding: 0.25rem 0.6rem;
      border-radius: 6px;
      font-size: 0.7rem;
      font-weight: 700;
    }

    .lesson-body {
      padding: 1.25rem;
    }

    .lesson-section {
      margin-bottom: 1.5rem;
    }

    .lesson-section:last-child {
      margin-bottom: 0;
    }

    .lesson-section-title {
      font-size: 0.75rem;
      font-weight: 600;
      color: var(--text-muted);
      text-transform: uppercase;
      letter-spacing: 0.05em;
      margin-bottom: 0.75rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .lesson-section-title i {
      font-size: 0.7rem;
      color: var(--accent);
    }

    .lesson-input {
      width: 100%;
      padding: 0.75rem 1rem;
      background: #050505;
      border: 1px solid var(--border);
      border-radius: 8px;
      font-size: 0.9rem;
      font-family: inherit;
      color: var(--text);
      transition: all 0.2s;
    }

    .lesson-input:focus {
      outline: none;
      border-color: var(--accent);
      box-shadow: 0 0 0 2px rgba(59,130,246,0.15);
    }

    .lesson-input::placeholder {
      color: #4a4a4a;
    }

    .lesson-textarea {
      min-height: 100px;
      resize: vertical;
    }

    .lesson-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 0.75rem;
    }

    .lesson-grid .full-width { grid-column: 1 / -1; }

    .file-input-minimal {
      width: 100%;
      padding: 0.6rem;
      background: #050505;
      border: 1px solid var(--border);
      border-radius: 8px;
      font-size: 0.8rem;
      color: var(--text-muted);
      cursor: pointer;
    }

    .file-input-minimal::-webkit-file-upload-button {
      background: #1a1a1a;
      border: none;
      padding: 0.3rem 0.6rem;
      border-radius: 4px;
      color: var(--text);
      font-size: 0.75rem;
      cursor: pointer;
      margin-right: 0.5rem;
    }

    .checkbox-minimal {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      font-size: 0.85rem;
      color: var(--text-muted);
      cursor: pointer;
      padding: 0.5rem 0;
    }

    .checkbox-minimal input[type="checkbox"] {
      width: 16px;
      height: 16px;
      accent-color: var(--success);
    }

    .checkbox-minimal:hover {
      color: var(--text);
    }

    .btn-add-lesson {
      background: transparent;
      color: var(--success);
      border: 1px dashed var(--success);
      padding: 0.75rem;
      border-radius: 8px;
      cursor: pointer;
      font-size: 0.85rem;
      font-weight: 600;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      transition: all 0.2s;
      width: 100%;
    }

    .btn-add-lesson:hover { background: rgba(34,197,94,0.1); }

    .btn-add-chapter {
      background: #050505;
      color: var(--accent);
      border: 2px dashed var(--accent);
      padding: 1rem 1.5rem;
      border-radius: 10px;
      cursor: pointer;
      font-size: 0.95rem;
      font-weight: 600;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      transition: all 0.2s;
      width: 100%;
    }

    .btn-add-chapter:hover { background: rgba(59,130,246,0.1); }

    .form-actions {
      display: flex;
      gap: 1rem;
      justify-content: flex-end;
      padding-top: 2rem;
      border-top: 1px solid var(--border);
      margin-top: 2rem;
    }

    .btn {
      padding: 0.875rem 1.75rem;
      border-radius: 10px;
      font-size: 0.95rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.2s;
      border: none;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      text-decoration: none;
    }

    .btn-primary { background: var(--primary); color: #000; }
    .btn-primary:hover { background: var(--primary-dark); transform: translateY(-2px); }
    .btn-secondary { background: var(--surface-soft); color: var(--text); border: 1px solid var(--border); }
    .btn-secondary:hover { background: #1a1a1a; }

    .checkbox-label {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      font-size: 0.85rem;
      cursor: pointer;
    }

    .checkbox-label input[type="checkbox"] {
      width: 16px;
      height: 16px;
      accent-color: var(--accent);
    }

    @media (max-width: 768px) {
      .page-container { padding: 1rem; }
      .form-container { padding: 1.5rem; }
      .form-grid, .lesson-grid { grid-template-columns: 1fr; }
      .form-actions { flex-direction: column; }
      .btn { width: 100%; justify-content: center; }
      .lesson-body { padding: 1rem; }
    }
  </style>
</head>
<body>
  <div class="page-container">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
      <a href="{{ route('instructor.courses.index') }}" class="back-link">
        <i class="fas fa-arrow-left"></i> Back to My Courses
      </a>
      <form method="POST" action="{{ route('instructor.logout') }}" style="margin: 0;">
        @csrf
        <button type="submit" class="back-link" style="background: none; border: none; cursor: pointer;">
          <i class="fas fa-sign-out-alt"></i> Logout
        </button>
      </form>
    </div>

    <div class="page-header">
      <h1>Create New Course</h1>
      <p>Fill in the details below to create a new course with chapters and lessons</p>
    </div>

    @if(session('success'))
      <div class="alert alert-success">
        <i class="fas fa-check-circle"></i>
        <span>{{ session('success') }}</span>
      </div>
    @endif

    @if(session('error') || $errors->any())
      <div class="alert alert-error">
        <i class="fas fa-exclamation-circle"></i>
        <div>
          @if(session('error'))
            <div>{{ session('error') }}</div>
          @endif
          @if($errors->any())
            <ul style="margin: 0.5rem 0 0 1.25rem; padding: 0;">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          @endif
        </div>
      </div>
    @endif

    <div class="alert alert-info">
      <i class="fas fa-info-circle"></i>
      <div>
        <strong>Note:</strong> All new courses must be reviewed and approved by administrators before being published.
      </div>
    </div>

    <form method="POST" action="{{ route('instructor.courses.store') }}" enctype="multipart/form-data">
      @csrf

      <div class="form-container">
        <!-- Course Information -->
        <div class="form-section">
          <h2><i class="fas fa-info-circle"></i> Course Information</h2>
          <p>Provide basic information about your course</p>

          <div class="form-grid">
            <div class="form-group full-width">
              <label>Course Title <span class="required">*</span></label>
              <input type="text" name="title" value="{{ old('title') }}" required placeholder="e.g. Complete Web Development Bootcamp">
            </div>

            <div class="form-group">
              <label>Price (Rp) <span class="required">*</span></label>
              <input type="number" name="price" value="{{ old('price', 0) }}" min="0" step="1" required placeholder="500000">
              <span class="hint">Set to 0 for free course</span>
            </div>

            <div class="form-group">
              <label>Course Category</label>
              <select name="category_id">
                <option value="">Select Category</option>
                @if(isset($categories) && $categories->count() > 0)
                  @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                      {{ $category->name }}
                    </option>
                  @endforeach
                @endif
              </select>
            </div>

            <div class="form-group full-width">
              <label>Course Thumbnail</label>
              <div class="file-upload-wrapper">
                <input type="file" name="thumbnail" id="thumbnail" accept="image/*" onchange="updateFileName(this, 'thumbnail-name')">
                <label for="thumbnail" class="file-upload-label">
                  <i class="fas fa-cloud-upload-alt"></i>
                  <span>Click to upload course thumbnail</span>
                </label>
              </div>
              <div class="file-name" id="thumbnail-name"></div>
              <span class="hint">Recommended: 1920x1080px, JPG/PNG, max 5MB</span>
            </div>

            <div class="form-group full-width">
              <label>Course Description</label>
              <textarea name="description" placeholder="Describe what students will learn...">{{ old('description') }}</textarea>
            </div>
          </div>
        </div>

        <!-- Chapters & Lessons -->
        <div class="form-section">
          <h2><i class="fas fa-book"></i> Course Curriculum</h2>
          <p>Organize your course into chapters and lessons</p>

          <div id="chapters-container">
            <!-- Chapters will be added here -->
          </div>

          <button type="button" class="btn-add-chapter" onclick="addChapter()">
            <i class="fas fa-plus"></i> Add New Chapter
          </button>
        </div>

        <div class="form-actions">
          <a href="{{ route('instructor.courses.index') }}" class="btn btn-secondary">
            <i class="fas fa-times"></i> Cancel
          </a>
          <button type="submit" class="btn btn-primary">
            <i class="fas fa-paper-plane"></i> Submit for Review
          </button>
        </div>
      </div>
    </form>
  </div>

  <script>
    let chapterIndex = 0;

    function addChapter() {
      const container = document.getElementById('chapters-container');
      const chapterNum = chapterIndex + 1;

      const chapterHtml = `
        <div class="chapter-card" id="chapter-${chapterIndex}">
          <div class="chapter-header" onclick="toggleChapter(${chapterIndex})">
            <div class="chapter-title">
              <span class="chapter-number">Bab ${chapterNum}</span>
              <span class="chapter-name-display" id="chapter-name-${chapterIndex}">New Chapter</span>
            </div>
            <div class="chapter-actions">
              <button type="button" class="btn-icon toggle" onclick="event.stopPropagation(); toggleChapter(${chapterIndex})">
                <i class="fas fa-chevron-down" id="chapter-icon-${chapterIndex}"></i>
              </button>
              <button type="button" class="btn-icon remove" onclick="event.stopPropagation(); removeChapter(${chapterIndex})">
                <i class="fas fa-trash"></i>
              </button>
            </div>
          </div>

          <div class="chapter-body active" id="chapter-body-${chapterIndex}">
            <div class="form-grid" style="margin-bottom: 1.5rem;">
              <div class="form-group full-width">
                <label>Chapter Title <span class="required">*</span></label>
                <input type="text" name="chapters[${chapterIndex}][title]" required placeholder="e.g. Getting Started" oninput="updateChapterName(${chapterIndex}, this.value)">
              </div>
              <div class="form-group full-width">
                <label>Chapter Description</label>
                <textarea name="chapters[${chapterIndex}][description]" placeholder="Brief description of this chapter..." rows="2"></textarea>
              </div>
            </div>

            <h4 style="font-size: 0.9rem; margin-bottom: 1rem; color: var(--text-muted);">
              <i class="fas fa-play-circle"></i> Lessons
            </h4>

            <div id="lessons-container-${chapterIndex}">
              <!-- Lessons will be added here -->
            </div>

            <button type="button" class="btn-add-lesson" onclick="addLesson(${chapterIndex})">
              <i class="fas fa-plus"></i> Add Lesson
            </button>
          </div>
        </div>
      `;

      container.insertAdjacentHTML('beforeend', chapterHtml);
      chapterIndex++;
    }

    function removeChapter(index) {
      const element = document.getElementById(`chapter-${index}`);
      if (element) {
        element.style.transition = 'all 0.3s';
        element.style.opacity = '0';
        element.style.transform = 'translateX(-20px)';
        setTimeout(() => element.remove(), 300);
      }
    }

    function toggleChapter(index) {
      const body = document.getElementById(`chapter-body-${index}`);
      const icon = document.getElementById(`chapter-icon-${index}`);
      body.classList.toggle('active');
      icon.classList.toggle('fa-chevron-down');
      icon.classList.toggle('fa-chevron-up');
    }

    function updateChapterName(index, value) {
      const display = document.getElementById(`chapter-name-${index}`);
      display.textContent = value || 'New Chapter';
    }

    let lessonCounters = {};

    function addLesson(chapterIndex) {
      if (!lessonCounters[chapterIndex]) {
        lessonCounters[chapterIndex] = 0;
      }

      const container = document.getElementById(`lessons-container-${chapterIndex}`);
      const lessonIndex = lessonCounters[chapterIndex];
      const lessonNum = lessonIndex + 1;

      const lessonHtml = `
        <div class="lesson-card" id="lesson-${chapterIndex}-${lessonIndex}">
          <div class="lesson-header">
            <div class="lesson-title">
              <span class="lesson-number">${lessonNum}</span>
              <span>Materi</span>
            </div>
            <button type="button" class="btn-icon remove" onclick="removeLesson(${chapterIndex}, ${lessonIndex})">
              <i class="fas fa-trash"></i>
            </button>
          </div>

          <div class="lesson-body">
            <!-- Basic Info -->
            <div class="lesson-section">
              <div class="lesson-section-title">
                <i class="fas fa-info-circle"></i> Informasi Dasar
              </div>
              <input type="text" name="chapters[${chapterIndex}][lessons][${lessonIndex}][title]" class="lesson-input" required placeholder="Judul materi, contoh: Pengenalan HTML Dasar">
            </div>

            <!-- Video Section -->
            <div class="lesson-section">
              <div class="lesson-section-title">
                <i class="fas fa-video"></i> Video
              </div>
              <div class="lesson-grid">
                <div>
                  <input type="url" name="chapters[${chapterIndex}][lessons][${lessonIndex}][video_url]" class="lesson-input" placeholder="URL Video (YouTube/Vimeo)">
                </div>
                <div>
                  <input type="number" name="chapters[${chapterIndex}][lessons][${lessonIndex}][duration]" class="lesson-input" min="0" placeholder="Durasi (menit)">
                </div>
              </div>
            </div>

            <!-- Description Section -->
            <div class="lesson-section">
              <div class="lesson-section-title">
                <i class="fas fa-align-left"></i> Deskripsi & Penjelasan Materi
              </div>
              <textarea name="chapters[${chapterIndex}][lessons][${lessonIndex}][content]" class="lesson-input lesson-textarea" placeholder="Jelaskan apa yang akan dipelajari siswa dalam materi ini. Anda dapat menyertakan poin-poin penting, ringkasan, atau catatan tambahan..." rows="4"></textarea>
              <p style="font-size: 0.75rem; color: #525252; margin-top: 0.5rem;">
                <i class="fas fa-lightbulb" style="color: #fbbf24;"></i> Tips: Jelaskan konsep utama yang akan dipelajari dan apa yang diharapkan siswa pahami setelah menyelesaikan materi ini.
              </p>
            </div>

            <!-- Files Section -->
            <div class="lesson-section">
              <div class="lesson-section-title">
                <i class="fas fa-paperclip"></i> File & Lampiran
              </div>
              <div class="lesson-grid">
                <div>
                  <label style="font-size: 0.75rem; color: #737373; margin-bottom: 0.5rem; display: block;">Thumbnail</label>
                  <input type="file" name="chapters[${chapterIndex}][lessons][${lessonIndex}][thumbnail]" accept="image/*" class="file-input-minimal">
                </div>
                <div>
                  <label style="font-size: 0.75rem; color: #737373; margin-bottom: 0.5rem; display: block;">File Pendukung</label>
                  <input type="file" name="chapters[${chapterIndex}][lessons][${lessonIndex}][fileUpload]" accept=".pdf,.doc,.docx,.ppt,.pptx,.mp4" class="file-input-minimal">
                </div>
              </div>
            </div>

            <!-- Options -->
            <div class="lesson-section">
              <label class="checkbox-minimal">
                <input type="checkbox" name="chapters[${chapterIndex}][lessons][${lessonIndex}][is_free]" value="1">
                <span><i class="fas fa-eye"></i> Jadikan preview gratis (siswa dapat melihat tanpa mendaftar)</span>
              </label>
            </div>
          </div>
        </div>
      `;

      container.insertAdjacentHTML('beforeend', lessonHtml);
      lessonCounters[chapterIndex]++;
    }

    function removeLesson(chapterIndex, lessonIndex) {
      const element = document.getElementById(`lesson-${chapterIndex}-${lessonIndex}`);
      if (element) {
        element.style.transition = 'all 0.3s';
        element.style.opacity = '0';
        element.style.transform = 'translateX(-20px)';
        setTimeout(() => element.remove(), 300);
      }
    }

    function updateFileName(input, targetId) {
      const target = document.getElementById(targetId);
      if (input.files && input.files[0]) {
        const fileSize = (input.files[0].size / 1024 / 1024).toFixed(2);
        target.innerHTML = `<i class="fas fa-check-circle"></i> ${input.files[0].name} (${fileSize} MB)`;
      } else {
        target.innerHTML = '';
      }
    }

    // Form submission loading state
    document.querySelector('form').addEventListener('submit', function(e) {
      const submitBtn = this.querySelector('button[type="submit"]');
      if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Creating Course...';
      }
    });
  </script>
</body>
</html>
