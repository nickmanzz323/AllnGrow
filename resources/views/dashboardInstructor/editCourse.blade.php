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
      --radius: 12px;
      --shadow: 0 4px 20px rgba(0,0,0,0.5);
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: var(--bg);
      color: var(--text);
      min-height: 100vh;
      line-height: 1.6;
    }

    .page-container {
      max-width: 900px;
      margin: 0 auto;
      padding: 2rem;
    }

    /* Header */
    .page-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 2rem;
    }

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
    }

    .back-link:hover {
      background: var(--surface);
      color: var(--text);
      transform: translateX(-4px);
    }

    .header-title h1 {
      font-size: 1.75rem;
      font-weight: 700;
      margin-bottom: 0.25rem;
    }

    .header-title p {
      color: var(--text-muted);
      font-size: 0.9rem;
    }

    /* Alert */
    .alert {
      padding: 1rem 1.25rem;
      border-radius: var(--radius);
      margin-bottom: 1.5rem;
      font-size: 0.9rem;
      display: flex;
      align-items: center;
      gap: 0.75rem;
      border: 1px solid var(--border);
      background: var(--surface);
    }

    .alert-success {
      border-color: #166534;
      background: #052e16;
    }

    .alert-success i {
      color: #4ade80;
    }

    .alert-error {
      border-color: #991b1b;
      background: #450a0a;
    }

    .alert-error i {
      color: #f87171;
    }

    /* Form Container */
    .form-container {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      overflow: hidden;
    }

    .form-section {
      padding: 2rem;
      border-bottom: 1px solid var(--border);
    }

    .form-section:last-child {
      border-bottom: none;
    }

    .form-section-header {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      margin-bottom: 1.5rem;
    }

    .form-section-header i {
      width: 36px;
      height: 36px;
      background: var(--primary);
      color: #000;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.9rem;
    }

    .form-section-header h2 {
      font-size: 1.1rem;
      font-weight: 600;
    }

    .form-section-header p {
      font-size: 0.85rem;
      color: var(--text-muted);
    }

    /* Form Grid */
    .form-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 1.25rem;
    }

    .form-group {
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
    }

    .form-group.full-width {
      grid-column: 1 / -1;
    }

    .form-group label {
      font-size: 0.875rem;
      font-weight: 600;
      color: var(--text);
    }

    .required {
      color: #ef4444;
    }

    .form-group input[type="text"],
    .form-group input[type="number"],
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

    .form-group input::placeholder,
    .form-group textarea::placeholder {
      color: #525252;
    }

    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(255,255,255,0.1);
    }

    .form-group textarea {
      resize: vertical;
      min-height: 120px;
    }

    .hint {
      font-size: 0.8rem;
      color: var(--text-muted);
    }

    /* File Upload */
    .file-upload-area {
      border: 2px dashed var(--border);
      border-radius: 10px;
      padding: 2rem;
      text-align: center;
      cursor: pointer;
      transition: all 0.2s;
      background: #050505;
    }

    .file-upload-area:hover {
      border-color: var(--primary);
      background: #0a0a0a;
    }

    .file-upload-area input[type="file"] {
      display: none;
    }

    .file-upload-area i {
      font-size: 2rem;
      color: var(--text-muted);
      margin-bottom: 0.75rem;
    }

    .file-upload-area span {
      display: block;
      font-size: 0.9rem;
      color: var(--text);
      font-weight: 500;
    }

    .file-name {
      margin-top: 0.5rem;
      font-size: 0.85rem;
      color: #4ade80;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
    }

    .current-thumbnail {
      margin-bottom: 1rem;
      padding: 1rem;
      background: #050505;
      border-radius: 10px;
      border: 1px solid var(--border);
      display: inline-block;
    }

    .current-thumbnail img {
      max-width: 200px;
      border-radius: 8px;
    }

    .current-thumbnail p {
      font-size: 0.8rem;
      color: var(--text-muted);
      margin-top: 0.5rem;
    }

    /* Form Actions */
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

    .btn-primary {
      background: var(--primary);
      color: #000;
    }

    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(255,255,255,0.2);
    }

    .btn-secondary {
      background: var(--surface);
      color: var(--text);
      border: 1px solid var(--border);
    }

    .btn-secondary:hover {
      background: var(--surface-hover);
    }

    /* Modules Section */
    .modules-section {
      margin-top: 2rem;
    }

    .modules-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1.5rem;
    }

    .modules-header h2 {
      font-size: 1.25rem;
      font-weight: 600;
    }

    .modules-header p {
      font-size: 0.85rem;
      color: var(--text-muted);
    }

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

    .btn-add:hover {
      background: #047857;
      transform: translateY(-2px);
    }

    /* Add Module Form */
    .add-module-form {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      padding: 1.5rem;
      margin-bottom: 1.5rem;
      display: none;
    }

    .add-module-form.active {
      display: block;
    }

    .add-module-form h3 {
      font-size: 1rem;
      margin-bottom: 1.25rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .add-module-form h3 i {
      color: #4ade80;
    }

    /* Module Card */
    .module-card {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      margin-bottom: 1rem;
      overflow: hidden;
      transition: all 0.2s;
    }

    .module-card:hover {
      border-color: #404040;
    }

    .module-card-header {
      padding: 1.25rem;
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      gap: 1rem;
    }

    .module-info {
      flex: 1;
    }

    .module-info h4 {
      font-size: 1rem;
      font-weight: 600;
      margin-bottom: 0.5rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .module-number {
      background: #1f1f1f;
      color: var(--text-muted);
      padding: 0.2rem 0.6rem;
      border-radius: 6px;
      font-size: 0.75rem;
      font-weight: 600;
    }

    .module-info p {
      font-size: 0.85rem;
      color: var(--text-muted);
      margin-bottom: 0.5rem;
    }

    .module-meta {
      display: flex;
      gap: 1rem;
      font-size: 0.8rem;
      color: var(--text-muted);
    }

    .module-meta span {
      display: flex;
      align-items: center;
      gap: 0.35rem;
    }

    .module-meta i {
      font-size: 0.75rem;
    }

    .module-actions {
      display: flex;
      gap: 0.5rem;
    }

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

    .btn-edit {
      background: #1e3a5f;
      color: #60a5fa;
    }

    .btn-edit:hover {
      background: #1e40af;
    }

    .btn-delete {
      background: #450a0a;
      color: #f87171;
    }

    .btn-delete:hover {
      background: #7f1d1d;
    }

    /* Edit Module Form */
    .module-edit-form {
      padding: 1.25rem;
      border-top: 1px solid var(--border);
      background: #050505;
      display: none;
    }

    .module-edit-form.active {
      display: block;
    }

    /* Empty State */
    .empty-modules {
      text-align: center;
      padding: 3rem 2rem;
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: var(--radius);
    }

    .empty-modules i {
      font-size: 3rem;
      color: #404040;
      margin-bottom: 1rem;
    }

    .empty-modules p {
      color: var(--text-muted);
      font-size: 0.9rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .page-container {
        padding: 1rem;
      }

      .form-grid {
        grid-template-columns: 1fr;
      }

      .form-actions {
        flex-direction: column;
      }

      .btn {
        width: 100%;
        justify-content: center;
      }

      .modules-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
      }

      .module-card-header {
        flex-direction: column;
      }

      .module-actions {
        width: 100%;
      }

      .btn-icon {
        flex: 1;
      }
    }
  </style>
</head>
<body>
  <div class="page-container">
    <!-- Header -->
    <div class="page-header">
      <a href="{{ route('instructor.courses.index') }}" class="back-link">
        <i class="fas fa-arrow-left"></i> Back to My Courses
      </a>
    </div>

    <div class="header-title" style="margin-bottom: 2rem;">
      <h1>Edit Course</h1>
      <p>Update your course information and manage modules</p>
    </div>

    <!-- Alerts -->
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
        <!-- Course Information -->
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
              <input type="text" name="title" value="{{ old('title', $course->title) }}" required placeholder="e.g. Complete Web Development Bootcamp">
            </div>

            <div class="form-group">
              <label>Price (Rp) <span class="required">*</span></label>
              <input type="number" name="price" value="{{ old('price', $course->price) }}" min="0" step="1" required placeholder="500000">
              <span class="hint">Set to 0 for free course</span>
            </div>

            <div class="form-group">
              <label>Status</label>
              <input type="text" value="{{ ucfirst($course->status) }}" disabled style="background: #1a1a1a; color: {{ $course->status === 'approved' ? '#4ade80' : ($course->status === 'pending' ? '#fbbf24' : '#f87171') }};">
            </div>

            <div class="form-group full-width">
              <label>Description</label>
              <textarea name="description" placeholder="Describe what students will learn...">{{ old('description', $course->description) }}</textarea>
              <span class="hint">Provide a detailed overview of your course content</span>
            </div>

            <div class="form-group full-width">
              <label>Course Thumbnail</label>
              @if($course->thumbnail)
                <div class="current-thumbnail">
                  <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="Current thumbnail">
                  <p>Current thumbnail</p>
                </div>
              @endif
              <label class="file-upload-area" for="thumbnail">
                <input type="file" name="thumbnail" id="thumbnail" accept="image/*" onchange="updateFileName(this, 'thumbnail-name')">
                <i class="fas fa-cloud-upload-alt"></i>
                <span>{{ $course->thumbnail ? 'Change thumbnail' : 'Upload thumbnail' }}</span>
              </label>
              <div class="file-name" id="thumbnail-name"></div>
              <span class="hint">Recommended: 1280x720px, JPG/PNG, max 5MB</span>
            </div>
          </div>
        </div>

        <!-- Form Actions -->
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

    <!-- Modules Section -->
    <div class="modules-section">
      <div class="modules-header">
        <div>
          <h2>Course Modules</h2>
          <p>Manage lessons and materials for this course</p>
        </div>
        <button type="button" class="btn-add" onclick="toggleAddForm()">
          <i class="fas fa-plus"></i> Add Module
        </button>
      </div>

      <!-- Add Module Form -->
      <div class="add-module-form" id="addModuleForm">
        <h3><i class="fas fa-plus-circle"></i> Add New Module</h3>
        <form method="POST" action="{{ route('instructor.subcourses.store', $course->courseID) }}" enctype="multipart/form-data">
          @csrf
          <div class="form-grid">
            <div class="form-group full-width">
              <label>Module Title <span class="required">*</span></label>
              <input type="text" name="title" required placeholder="e.g. Introduction to React">
            </div>

            <div class="form-group full-width">
              <label>Content</label>
              <textarea name="content" rows="3" placeholder="Describe this module..."></textarea>
            </div>

            <div class="form-group">
              <label>Thumbnail</label>
              <input type="file" name="thumbnail" accept="image/*" style="padding: 0.75rem; background: #050505; border: 1px solid var(--border); border-radius: 8px; color: var(--text);">
            </div>

            <div class="form-group">
              <label>File (PDF, Video, etc.)</label>
              <input type="file" name="fileUpload" accept=".pdf,.doc,.docx,.ppt,.pptx,.mp4,.mov,.avi" style="padding: 0.75rem; background: #050505; border: 1px solid var(--border); border-radius: 8px; color: var(--text);">
            </div>
          </div>

          <div style="display: flex; gap: 1rem; margin-top: 1rem;">
            <button type="submit" class="btn btn-primary">
              <i class="fas fa-save"></i> Save Module
            </button>
            <button type="button" class="btn btn-secondary" onclick="toggleAddForm()">
              Cancel
            </button>
          </div>
        </form>
      </div>

      <!-- Module List -->
      @if($course->subcourses->count() > 0)
        @foreach($course->subcourses as $index => $subcourse)
          <div class="module-card">
            <div class="module-card-header">
              <div class="module-info">
                <h4>
                  <span class="module-number">#{{ $index + 1 }}</span>
                  {{ $subcourse->title }}
                </h4>
                @if($subcourse->content)
                  <p>{{ Str::limit($subcourse->content, 100) }}</p>
                @endif
                <div class="module-meta">
                  @if($subcourse->thumbnail)
                    <span><i class="fas fa-image"></i> Has thumbnail</span>
                  @endif
                  @if($subcourse->fileUpload)
                    <span><i class="fas fa-file"></i> Has file</span>
                  @endif
                </div>
              </div>
              <div class="module-actions">
                <button type="button" class="btn-icon btn-edit" onclick="toggleEditForm({{ $subcourse->id }})" title="Edit">
                  <i class="fas fa-edit"></i>
                </button>
                <form method="POST" action="{{ route('instructor.subcourses.destroy', [$course->courseID, $subcourse->id]) }}" style="display: inline;" onsubmit="return confirm('Delete this module?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn-icon btn-delete" title="Delete">
                    <i class="fas fa-trash"></i>
                  </button>
                </form>
              </div>
            </div>

            <!-- Edit Form -->
            <div class="module-edit-form" id="editForm{{ $subcourse->id }}">
              <form method="POST" action="{{ route('instructor.subcourses.update', [$course->courseID, $subcourse->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-grid">
                  <div class="form-group full-width">
                    <label>Module Title <span class="required">*</span></label>
                    <input type="text" name="title" value="{{ $subcourse->title }}" required>
                  </div>

                  <div class="form-group full-width">
                    <label>Content</label>
                    <textarea name="content" rows="3">{{ $subcourse->content }}</textarea>
                  </div>

                  <div class="form-group">
                    <label>Thumbnail</label>
                    @if($subcourse->thumbnail)
                      <div style="margin-bottom: 0.5rem;">
                        <img src="{{ asset('storage/' . $subcourse->thumbnail) }}" style="max-width: 120px; border-radius: 6px;">
                      </div>
                    @endif
                    <input type="file" name="thumbnail" accept="image/*" style="padding: 0.75rem; background: #0a0a0a; border: 1px solid var(--border); border-radius: 8px; color: var(--text); width: 100%;">
                  </div>

                  <div class="form-group">
                    <label>File</label>
                    @if($subcourse->fileUpload)
                      <div style="margin-bottom: 0.5rem; font-size: 0.8rem; color: var(--text-muted);">
                        Current: {{ basename($subcourse->fileUpload) }}
                      </div>
                    @endif
                    <input type="file" name="fileUpload" accept=".pdf,.doc,.docx,.ppt,.pptx,.mp4,.mov,.avi" style="padding: 0.75rem; background: #0a0a0a; border: 1px solid var(--border); border-radius: 8px; color: var(--text); width: 100%;">
                  </div>
                </div>

                <div style="display: flex; gap: 1rem; margin-top: 1rem;">
                  <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update
                  </button>
                  <button type="button" class="btn btn-secondary" onclick="toggleEditForm({{ $subcourse->id }})">
                    Cancel
                  </button>
                </div>
              </form>
            </div>
          </div>
        @endforeach
      @else
        <div class="empty-modules">
          <i class="fas fa-book-open"></i>
          <p>No modules yet. Click "Add Module" to create your first lesson.</p>
        </div>
      @endif
    </div>
  </div>

  <script>
    function updateFileName(input, targetId) {
      const target = document.getElementById(targetId);
      if (input.files && input.files[0]) {
        const fileSize = (input.files[0].size / 1024 / 1024).toFixed(2);
        target.innerHTML = `<i class="fas fa-check-circle"></i> ${input.files[0].name} (${fileSize} MB)`;
      } else {
        target.innerHTML = '';
      }
    }

    function toggleAddForm() {
      const form = document.getElementById('addModuleForm');
      form.classList.toggle('active');
    }

    function toggleEditForm(subcourseId) {
      const form = document.getElementById('editForm' + subcourseId);
      form.classList.toggle('active');
    }
  </script>
</body>
</html>
