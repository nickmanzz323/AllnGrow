<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Course - AllnGrow Instructor</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    :root {
      --bg: #000000;
      --surface: #0a0a0a;
      --surface-hover: #111111;
      --text: #f5f5f5;
      --text-muted: #a3a3a3;
      --border: #262626;
      --primary: #ffffff;
      --accent: #3b82f6;
      --success: #22c55e;
      --danger: #ef4444;
      --radius: 12px;
    }

    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
      font-family: 'Inter', sans-serif;
      background: var(--bg);
      color: var(--text);
      min-height: 100vh;
      line-height: 1.6;
    }

    .page-container { max-width: 1000px; margin: 0 auto; padding: 2rem; }

    .back-link {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      color: var(--text-muted);
      text-decoration: none;
      font-size: 0.9rem;
      font-weight: 500;
      padding: 0.5rem 1rem;
      border-radius: 8px;
      transition: all 0.2s;
      margin-bottom: 1.5rem;
    }

    .back-link:hover { background: var(--surface); color: var(--text); transform: translateX(-4px); }

    .header-title h1 { font-size: 1.75rem; font-weight: 700; margin-bottom: 0.25rem; }
    .header-title p { color: var(--text-muted); font-size: 0.9rem; }

    .alert {
      padding: 1rem 1.25rem;
      border-radius: var(--radius);
      margin-bottom: 1.5rem;
      font-size: 0.9rem;
      display: flex;
      align-items: center;
      gap: 0.75rem;
      border: 1px solid var(--border);
    }

    .alert-success { background: #052e16; border-color: #166534; }
    .alert-success i { color: #4ade80; }
    .alert-error { background: #450a0a; border-color: #991b1b; }
    .alert-error i { color: #f87171; }

    .form-container {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      overflow: hidden;
    }

    .form-section { padding: 2rem; border-bottom: 1px solid var(--border); }
    .form-section:last-child { border-bottom: none; }

    .form-section-header {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      margin-bottom: 1.5rem;
    }

    .form-section-header i {
      width: 36px;
      height: 36px;
      background: var(--accent);
      color: #fff;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.9rem;
    }

    .form-section-header h2 { font-size: 1.1rem; font-weight: 600; }
    .form-section-header p { font-size: 0.85rem; color: var(--text-muted); }

    .form-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.25rem; }
    .form-group { display: flex; flex-direction: column; gap: 0.5rem; }
    .form-group.full-width { grid-column: 1 / -1; }
    .form-group label { font-size: 0.875rem; font-weight: 600; }
    .required { color: var(--danger); }

    .form-group input[type="text"],
    .form-group input[type="number"],
    .form-group input[type="url"],
    .form-group textarea,
    .form-group select {
      width: 100%;
      padding: 0.875rem 1rem;
      background: #050505;
      border: 1px solid var(--border);
      border-radius: 10px;
      font-size: 0.9rem;
      font-family: inherit;
      color: var(--text);
      transition: all 0.2s;
    }

    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus {
      outline: none;
      border-color: var(--accent);
      box-shadow: 0 0 0 3px rgba(59,130,246,0.15);
    }

    .form-group textarea { resize: vertical; min-height: 100px; }
    .hint { font-size: 0.8rem; color: var(--text-muted); }

    .current-thumbnail { margin-bottom: 1rem; padding: 1rem; background: #050505; border-radius: 10px; border: 1px solid var(--border); display: inline-block; }
    .current-thumbnail img { max-width: 200px; border-radius: 8px; }
    .current-thumbnail p { font-size: 0.8rem; color: var(--text-muted); margin-top: 0.5rem; }

    .file-upload-area {
      border: 2px dashed var(--border);
      border-radius: 10px;
      padding: 2rem;
      text-align: center;
      cursor: pointer;
      transition: all 0.2s;
      background: #050505;
    }

    .file-upload-area:hover { border-color: var(--accent); background: #0a0a0a; }
    .file-upload-area input[type="file"] { display: none; }
    .file-upload-area i { font-size: 2rem; color: var(--text-muted); margin-bottom: 0.75rem; }
    .file-upload-area span { display: block; font-size: 0.9rem; font-weight: 500; }

    .form-actions {
      display: flex;
      gap: 1rem;
      justify-content: flex-end;
      padding: 1.5rem 2rem;
      background: #050505;
      border-top: 1px solid var(--border);
    }

    .btn {
      padding: 0.875rem 1.5rem;
      border-radius: 10px;
      font-size: 0.9rem;
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
    .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(255,255,255,0.2); }
    .btn-secondary { background: var(--surface); color: var(--text); border: 1px solid var(--border); }
    .btn-secondary:hover { background: var(--surface-hover); }

    /* Curriculum Section */
    .curriculum-section { margin-top: 2rem; }
    .curriculum-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; }
    .curriculum-header h2 { font-size: 1.25rem; font-weight: 600; }
    .curriculum-header p { font-size: 0.85rem; color: var(--text-muted); }

    .btn-add {
      background: #065f46;
      color: #fff;
      padding: 0.75rem 1.25rem;
      border-radius: 10px;
      border: none;
      font-size: 0.875rem;
      font-weight: 600;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      transition: all 0.2s;
    }

    .btn-add:hover { background: #047857; transform: translateY(-2px); }

    /* Chapter Card */
    .chapter-card {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      margin-bottom: 1rem;
      overflow: hidden;
    }

    .chapter-card:hover { border-color: #404040; }

    .chapter-card-header {
      padding: 1.25rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: #0d0d0d;
      border-bottom: 1px solid var(--border);
    }

    .chapter-info { flex: 1; }
    .chapter-info h4 { font-size: 1rem; font-weight: 600; margin-bottom: 0.25rem; display: flex; align-items: center; gap: 0.5rem; }
    .chapter-number { background: var(--accent); color: #fff; padding: 0.2rem 0.6rem; border-radius: 6px; font-size: 0.75rem; font-weight: 600; }
    .chapter-info p { font-size: 0.85rem; color: var(--text-muted); }
    .chapter-meta { font-size: 0.8rem; color: var(--text-muted); margin-top: 0.5rem; }

    .chapter-actions { display: flex; gap: 0.5rem; }

    .btn-icon {
      width: 36px;
      height: 36px;
      border-radius: 8px;
      border: none;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.85rem;
      transition: all 0.2s;
    }

    .btn-edit { background: #1e3a5f; color: #60a5fa; }
    .btn-edit:hover { background: #1e40af; }
    .btn-delete { background: #450a0a; color: #f87171; }
    .btn-delete:hover { background: #7f1d1d; }
    .btn-toggle { background: #1f1f1f; color: var(--text-muted); }
    .btn-toggle:hover { background: #2f2f2f; }

    /* Lessons inside chapter */
    .chapter-lessons { padding: 1rem 1.25rem; display: none; }
    .chapter-lessons.active { display: block; }

    .lesson-item {
      background: #050505;
      border: 1px solid var(--border);
      border-radius: 8px;
      padding: 1rem;
      margin-bottom: 0.75rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .lesson-item:last-child { margin-bottom: 0; }

    .lesson-info { flex: 1; }
    .lesson-info h5 { font-size: 0.9rem; font-weight: 600; margin-bottom: 0.25rem; display: flex; align-items: center; gap: 0.5rem; }
    .lesson-number { background: #262626; padding: 0.15rem 0.5rem; border-radius: 4px; font-size: 0.7rem; }
    .lesson-meta { font-size: 0.75rem; color: var(--text-muted); display: flex; gap: 1rem; }
    .lesson-meta span { display: flex; align-items: center; gap: 0.25rem; }

    /* Forms */
    .add-form {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      padding: 1.5rem;
      margin-bottom: 1.5rem;
      display: none;
    }

    .add-form.active { display: block; }

    .add-form h3 {
      font-size: 1rem;
      margin-bottom: 1.25rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .add-form h3 i { color: var(--success); }

    .edit-form {
      padding: 1rem 1.25rem;
      background: #050505;
      border-top: 1px solid var(--border);
      display: none;
    }

    .edit-form.active { display: block; }

    .empty-state {
      text-align: center;
      padding: 3rem 2rem;
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: var(--radius);
    }

    .empty-state i { font-size: 3rem; color: #404040; margin-bottom: 1rem; }
    .empty-state p { color: var(--text-muted); font-size: 0.9rem; }

    .checkbox-label {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      font-size: 0.85rem;
      cursor: pointer;
    }

    .checkbox-label input[type="checkbox"] { width: 16px; height: 16px; accent-color: var(--accent); }

    /* Minimalist Lesson Form Styles */
    .lesson-form-section {
      margin-bottom: 1.25rem;
    }

    .lesson-form-section:last-child {
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

    .lesson-form-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 0.75rem;
    }

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

    @media (max-width: 768px) {
      .page-container { padding: 1rem; }
      .form-grid { grid-template-columns: 1fr; }
      .lesson-form-grid { grid-template-columns: 1fr; }
      .form-actions { flex-direction: column; }
      .btn { width: 100%; justify-content: center; }
      .curriculum-header { flex-direction: column; align-items: flex-start; gap: 1rem; }
    }
  </style>
</head>
<body>
  <div class="page-container">
    <a href="{{ route('instructor.courses.index') }}" class="back-link">
      <i class="fas fa-arrow-left"></i> Back to My Courses
    </a>

    <div class="header-title" style="margin-bottom: 2rem;">
      <h1>Edit Course</h1>
      <p>Update your course information and manage curriculum</p>
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

    <!-- Course Form -->
    <form method="POST" action="{{ route('instructor.courses.update', $course->courseID) }}" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="form-container">
        <div class="form-section">
          <div class="form-section-header">
            <i class="fas fa-info-circle"></i>
            <div>
              <h2>Course Information</h2>
              <p>Basic details about your course</p>
            </div>
          </div>

          <div class="form-grid">
            <div class="form-group full-width">
              <label>Course Title <span class="required">*</span></label>
              <input type="text" name="title" value="{{ old('title', $course->title) }}" required>
            </div>

            <div class="form-group">
              <label>Price (Rp) <span class="required">*</span></label>
              <input type="number" name="price" value="{{ old('price', $course->price) }}" min="0" step="1" required>
              <span class="hint">Set to 0 for free course</span>
            </div>

            <div class="form-group">
              <label>Category</label>
              <select name="category_id">
                <option value="">Select Category</option>
                @if(isset($categories))
                  @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $course->category_id) == $category->id ? 'selected' : '' }}>
                      {{ $category->name }}
                    </option>
                  @endforeach
                @endif
              </select>
            </div>

            <div class="form-group full-width">
              <label>Description</label>
              <textarea name="description">{{ old('description', $course->description) }}</textarea>
            </div>

            <div class="form-group full-width">
              <label>Course Thumbnail</label>
              @if($course->thumbnail)
                <div class="current-thumbnail">
                  <img src="{{ Storage::url($course->thumbnail) }}" alt="Current thumbnail">
                  <p>Current thumbnail</p>
                </div>
              @endif
              <label class="file-upload-area" for="thumbnail">
                <input type="file" name="thumbnail" id="thumbnail" accept="image/*">
                <i class="fas fa-cloud-upload-alt"></i>
                <span>{{ $course->thumbnail ? 'Change thumbnail' : 'Upload thumbnail' }}</span>
              </label>
              <span class="hint">Recommended: 1280x720px, JPG/PNG, max 5MB</span>
            </div>
          </div>
        </div>

        <div class="form-actions">
          <a href="{{ route('instructor.courses.index') }}" class="btn btn-secondary">
            <i class="fas fa-times"></i> Cancel
          </a>
          <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Save Changes
          </button>
        </div>
      </div>
    </form>

    <!-- Curriculum Section -->
    <div class="curriculum-section">
      <div class="curriculum-header">
        <div>
          <h2>Course Curriculum</h2>
          <p>Organize your content into chapters and lessons</p>
        </div>
        <button type="button" class="btn-add" onclick="toggleAddChapterForm()">
          <i class="fas fa-plus"></i> Add Chapter
        </button>
      </div>

      <!-- Add Chapter Form -->
      <div class="add-form" id="addChapterForm">
        <h3><i class="fas fa-plus-circle"></i> Add New Chapter</h3>
        <form method="POST" action="{{ route('instructor.chapters.store', $course->courseID) }}">
          @csrf
          <div class="form-grid">
            <div class="form-group full-width">
              <label>Chapter Title <span class="required">*</span></label>
              <input type="text" name="title" required placeholder="e.g. Getting Started">
            </div>
            <div class="form-group full-width">
              <label>Description</label>
              <textarea name="description" rows="2" placeholder="Brief description of this chapter..."></textarea>
            </div>
          </div>
          <div style="display: flex; gap: 1rem; margin-top: 1rem;">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Chapter</button>
            <button type="button" class="btn btn-secondary" onclick="toggleAddChapterForm()">Cancel</button>
          </div>
        </form>
      </div>

      <!-- Chapters List -->
      @if($course->chapters->count() > 0)
        @foreach($course->chapters as $chapterIndex => $chapter)
          <div class="chapter-card">
            <div class="chapter-card-header">
              <div class="chapter-info">
                <h4>
                  <span class="chapter-number">Bab {{ $chapterIndex + 1 }}</span>
                  {{ $chapter->title }}
                </h4>
                @if($chapter->description)
                  <p>{{ Str::limit($chapter->description, 100) }}</p>
                @endif
                <div class="chapter-meta">
                  <i class="fas fa-play-circle"></i> {{ $chapter->lessons->count() }} lessons
                </div>
              </div>
              <div class="chapter-actions">
                <button type="button" class="btn-icon btn-toggle" onclick="toggleChapterLessons({{ $chapter->id }})" title="Toggle Lessons">
                  <i class="fas fa-chevron-down" id="chapter-toggle-icon-{{ $chapter->id }}"></i>
                </button>
                <button type="button" class="btn-icon btn-edit" onclick="toggleEditChapterForm({{ $chapter->id }})" title="Edit Chapter">
                  <i class="fas fa-edit"></i>
                </button>
                <form method="POST" action="{{ route('instructor.chapters.destroy', [$course->courseID, $chapter->id]) }}" style="display: inline;" onsubmit="return confirm('Delete this chapter and all its lessons?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn-icon btn-delete" title="Delete Chapter">
                    <i class="fas fa-trash"></i>
                  </button>
                </form>
              </div>
            </div>

            <!-- Edit Chapter Form -->
            <div class="edit-form" id="editChapterForm{{ $chapter->id }}">
              <form method="POST" action="{{ route('instructor.chapters.update', [$course->courseID, $chapter->id]) }}">
                @csrf
                @method('PUT')
                <div class="form-grid">
                  <div class="form-group full-width">
                    <label>Chapter Title <span class="required">*</span></label>
                    <input type="text" name="title" value="{{ $chapter->title }}" required>
                  </div>
                  <div class="form-group full-width">
                    <label>Description</label>
                    <textarea name="description" rows="2">{{ $chapter->description }}</textarea>
                  </div>
                </div>
                <div style="display: flex; gap: 1rem; margin-top: 1rem;">
                  <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
                  <button type="button" class="btn btn-secondary" onclick="toggleEditChapterForm({{ $chapter->id }})">Cancel</button>
                </div>
              </form>
            </div>

            <!-- Lessons List -->
            <div class="chapter-lessons" id="chapterLessons{{ $chapter->id }}">
              @if($chapter->lessons->count() > 0)
                @foreach($chapter->lessons as $lessonIndex => $lesson)
                  <div class="lesson-item">
                    <div class="lesson-info">
                      <h5>
                        <span class="lesson-number">{{ $lessonIndex + 1 }}</span>
                        {{ $lesson->title }}
                        @if($lesson->is_free)
                          <span style="background: var(--success); color: #fff; padding: 0.1rem 0.4rem; border-radius: 4px; font-size: 0.65rem;">FREE</span>
                        @endif
                      </h5>
                      <div class="lesson-meta">
                        @if($lesson->duration)
                          <span><i class="fas fa-clock"></i> {{ $lesson->formatted_duration }}</span>
                        @endif
                        @if($lesson->video_url)
                          <span><i class="fas fa-video"></i> Video</span>
                        @endif
                        @if($lesson->fileUpload)
                          <span><i class="fas fa-file"></i> File</span>
                        @endif
                      </div>
                    </div>
                    <div class="chapter-actions">
                      <button type="button" class="btn-icon btn-edit" onclick="toggleEditLessonForm({{ $lesson->id }})" title="Edit">
                        <i class="fas fa-edit"></i>
                      </button>
                      <form method="POST" action="{{ route('instructor.lessons.destroy', [$course->courseID, $chapter->id, $lesson->id]) }}" style="display: inline;" onsubmit="return confirm('Delete this lesson?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-icon btn-delete" title="Delete">
                          <i class="fas fa-trash"></i>
                        </button>
                      </form>
                    </div>
                  </div>

                  <!-- Edit Lesson Form -->
                  <div class="edit-form" id="editLessonForm{{ $lesson->id }}" style="margin-bottom: 0.75rem; border-radius: 8px;">
                    <form method="POST" action="{{ route('instructor.lessons.update', [$course->courseID, $chapter->id, $lesson->id]) }}" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')

                      <!-- Basic Info -->
                      <div class="lesson-form-section">
                        <div class="lesson-section-title">
                          <i class="fas fa-info-circle"></i> Informasi Dasar
                        </div>
                        <input type="text" name="title" value="{{ $lesson->title }}" class="lesson-input" required placeholder="Judul materi">
                      </div>

                      <!-- Video Section -->
                      <div class="lesson-form-section">
                        <div class="lesson-section-title">
                          <i class="fas fa-video"></i> Video
                        </div>
                        <div class="lesson-form-grid">
                          <div>
                            <input type="url" name="video_url" value="{{ $lesson->video_url }}" class="lesson-input" placeholder="URL Video (YouTube/Vimeo)">
                          </div>
                          <div>
                            <input type="number" name="duration" value="{{ $lesson->duration }}" class="lesson-input" min="0" placeholder="Durasi (menit)">
                          </div>
                        </div>
                      </div>

                      <!-- Description Section -->
                      <div class="lesson-form-section">
                        <div class="lesson-section-title">
                          <i class="fas fa-align-left"></i> Deskripsi & Penjelasan Materi
                        </div>
                        <textarea name="content" class="lesson-input lesson-textarea" placeholder="Jelaskan apa yang akan dipelajari siswa dalam materi ini..." rows="4">{{ $lesson->content }}</textarea>
                        <p style="font-size: 0.75rem; color: #525252; margin-top: 0.5rem;">
                          <i class="fas fa-lightbulb" style="color: #fbbf24;"></i> Tips: Jelaskan konsep utama dan apa yang diharapkan siswa pahami.
                        </p>
                      </div>

                      <!-- Files Section -->
                      <div class="lesson-form-section">
                        <div class="lesson-section-title">
                          <i class="fas fa-paperclip"></i> File & Lampiran
                        </div>
                        <div class="lesson-form-grid">
                          <div>
                            <label style="font-size: 0.75rem; color: #737373; margin-bottom: 0.5rem; display: block;">Thumbnail</label>
                            @if($lesson->thumbnail)
                              <div style="margin-bottom: 0.5rem;">
                                <img src="{{ Storage::url($lesson->thumbnail) }}" style="max-width: 80px; border-radius: 6px;">
                              </div>
                            @endif
                            <input type="file" name="thumbnail" accept="image/*" class="file-input-minimal">
                          </div>
                          <div>
                            <label style="font-size: 0.75rem; color: #737373; margin-bottom: 0.5rem; display: block;">File Pendukung</label>
                            @if($lesson->fileUpload)
                              <div style="font-size: 0.7rem; color: var(--text-muted); margin-bottom: 0.5rem;">
                                <i class="fas fa-file"></i> {{ basename($lesson->fileUpload) }}
                              </div>
                            @endif
                            <input type="file" name="fileUpload" accept=".pdf,.doc,.docx,.ppt,.pptx,.mp4" class="file-input-minimal">
                          </div>
                        </div>
                      </div>

                      <!-- Options -->
                      <div class="lesson-form-section">
                        <label class="checkbox-minimal">
                          <input type="checkbox" name="is_free" value="1" {{ $lesson->is_free ? 'checked' : '' }}>
                          <span><i class="fas fa-eye"></i> Jadikan preview gratis</span>
                        </label>
                      </div>

                      <div style="display: flex; gap: 1rem; margin-top: 1rem;">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                        <button type="button" class="btn btn-secondary" onclick="toggleEditLessonForm({{ $lesson->id }})">Batal</button>
                      </div>
                    </form>
                  </div>
                @endforeach
              @else
                <p style="text-align: center; color: var(--text-muted); padding: 1rem; font-size: 0.85rem;">
                  No lessons yet
                </p>
              @endif

              <!-- Add Lesson Button -->
              <button type="button" class="btn-add" style="width: 100%; margin-top: 0.5rem;" onclick="toggleAddLessonForm({{ $chapter->id }})">
                <i class="fas fa-plus"></i> Tambah Materi
              </button>

              <!-- Add Lesson Form -->
              <div class="add-form" id="addLessonForm{{ $chapter->id }}" style="margin-top: 1rem;">
                <h3><i class="fas fa-plus-circle"></i> Tambah Materi Baru</h3>
                <form method="POST" action="{{ route('instructor.lessons.store', [$course->courseID, $chapter->id]) }}" enctype="multipart/form-data">
                  @csrf

                  <!-- Basic Info -->
                  <div class="lesson-form-section">
                    <div class="lesson-section-title">
                      <i class="fas fa-info-circle"></i> Informasi Dasar
                    </div>
                    <input type="text" name="title" class="lesson-input" required placeholder="Judul materi, contoh: Pengenalan HTML Dasar">
                  </div>

                  <!-- Video Section -->
                  <div class="lesson-form-section">
                    <div class="lesson-section-title">
                      <i class="fas fa-video"></i> Video
                    </div>
                    <div class="lesson-form-grid">
                      <div>
                        <input type="url" name="video_url" class="lesson-input" placeholder="URL Video (YouTube/Vimeo)">
                      </div>
                      <div>
                        <input type="number" name="duration" class="lesson-input" min="0" placeholder="Durasi (menit)">
                      </div>
                    </div>
                  </div>

                  <!-- Description Section -->
                  <div class="lesson-form-section">
                    <div class="lesson-section-title">
                      <i class="fas fa-align-left"></i> Deskripsi & Penjelasan Materi
                    </div>
                    <textarea name="content" class="lesson-input lesson-textarea" placeholder="Jelaskan apa yang akan dipelajari siswa dalam materi ini. Anda dapat menyertakan poin-poin penting, ringkasan, atau catatan tambahan..." rows="4"></textarea>
                    <p style="font-size: 0.75rem; color: #525252; margin-top: 0.5rem;">
                      <i class="fas fa-lightbulb" style="color: #fbbf24;"></i> Tips: Jelaskan konsep utama yang akan dipelajari dan apa yang diharapkan siswa pahami setelah menyelesaikan materi ini.
                    </p>
                  </div>

                  <!-- Files Section -->
                  <div class="lesson-form-section">
                    <div class="lesson-section-title">
                      <i class="fas fa-paperclip"></i> File & Lampiran
                    </div>
                    <div class="lesson-form-grid">
                      <div>
                        <label style="font-size: 0.75rem; color: #737373; margin-bottom: 0.5rem; display: block;">Thumbnail</label>
                        <input type="file" name="thumbnail" accept="image/*" class="file-input-minimal">
                      </div>
                      <div>
                        <label style="font-size: 0.75rem; color: #737373; margin-bottom: 0.5rem; display: block;">File Pendukung</label>
                        <input type="file" name="fileUpload" accept=".pdf,.doc,.docx,.ppt,.pptx,.mp4" class="file-input-minimal">
                      </div>
                    </div>
                  </div>

                  <!-- Options -->
                  <div class="lesson-form-section">
                    <label class="checkbox-minimal">
                      <input type="checkbox" name="is_free" value="1">
                      <span><i class="fas fa-eye"></i> Jadikan preview gratis (siswa dapat melihat tanpa mendaftar)</span>
                    </label>
                  </div>

                  <div style="display: flex; gap: 1rem; margin-top: 1rem;">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Materi</button>
                    <button type="button" class="btn btn-secondary" onclick="toggleAddLessonForm({{ $chapter->id }})">Batal</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        @endforeach
      @else
        <div class="empty-state">
          <i class="fas fa-book-open"></i>
          <p>No chapters yet. Click "Add Chapter" to create your course curriculum.</p>
        </div>
      @endif
    </div>
  </div>

  <script>
    function toggleAddChapterForm() {
      document.getElementById('addChapterForm').classList.toggle('active');
    }

    function toggleEditChapterForm(chapterId) {
      document.getElementById('editChapterForm' + chapterId).classList.toggle('active');
    }

    function toggleChapterLessons(chapterId) {
      const lessons = document.getElementById('chapterLessons' + chapterId);
      const icon = document.getElementById('chapter-toggle-icon-' + chapterId);
      lessons.classList.toggle('active');
      icon.classList.toggle('fa-chevron-down');
      icon.classList.toggle('fa-chevron-up');
    }

    function toggleAddLessonForm(chapterId) {
      document.getElementById('addLessonForm' + chapterId).classList.toggle('active');
    }

    function toggleEditLessonForm(lessonId) {
      document.getElementById('editLessonForm' + lessonId).classList.toggle('active');
    }
  </script>
</body>
</html>
