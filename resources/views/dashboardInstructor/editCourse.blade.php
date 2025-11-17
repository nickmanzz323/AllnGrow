<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Course - AllnGrow Instructor</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: #fafafa;
      min-height: 100vh;
      padding: 20px;
    }

    .container {
      max-width: 900px;
      margin: 0 auto;
      background: white;
      border-radius: 12px;
      padding: 40px;
      box-shadow: 0 1px 3px rgba(0,0,0,0.04);
    }

    .header {
      margin-bottom: 30px;
    }

    .header h1 {
      font-size: 28px;
      color: #1a202c;
      margin-bottom: 8px;
    }

    .header p {
      color: #718096;
      font-size: 14px;
    }

    .back-link {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      color: #000000;
      text-decoration: none;
      margin-bottom: 20px;
      font-size: 14px;
      font-weight: 500;
      transition: gap 0.2s;
    }

    .back-link:hover {
      gap: 12px;
    }

    .alert {
      padding: 16px;
      border-radius: 8px;
      margin-bottom: 20px;
      font-size: 14px;
    }

    .alert-success {
      background: #d4edda;
      border: 1px solid #c3e6cb;
      color: #155724;
    }

    .alert-error {
      background: #fff3cd;
      border: 1px solid #ffeeba;
      color: #856404;
    }

    .form-section {
      margin-bottom: 30px;
    }

    .form-section h2 {
      font-size: 18px;
      color: #2d3748;
      margin-bottom: 16px;
      padding-bottom: 8px;
      border-bottom: 2px solid #e2e8f0;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      display: block;
      font-size: 14px;
      font-weight: 600;
      color: #4a5568;
      margin-bottom: 8px;
    }

    .form-group label .required {
      color: #e53e3e;
    }

    .form-group input[type="text"],
    .form-group input[type="number"] {
      width: 100%;
      padding: 12px 16px;
      border: 1px solid #cbd5e0;
      border-radius: 8px;
      font-size: 14px;
      font-family: inherit;
      transition: all 0.2s;
    }

    .form-group input:focus {
      outline: none;
      border-color: #000000;
      box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.05);
    }

    .file-input-wrapper {
      position: relative;
      display: inline-block;
      width: 100%;
    }

    .file-input-wrapper input[type="file"] {
      position: absolute;
      left: -9999px;
    }

    .file-input-label {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 12px 16px;
      border: 2px dashed #cbd5e0;
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.2s;
      background: #f7fafc;
    }

    .file-input-label:hover {
      border-color: #000000;
      background: #f5f5f5;
    }

    .file-input-label i {
      color: #000000;
      font-size: 20px;
    }

    .file-name {
      font-size: 13px;
      color: #4a5568;
      margin-top: 6px;
    }

    .current-thumbnail {
      margin-top: 12px;
      padding: 12px;
      background: #f7fafc;
      border-radius: 8px;
      display: inline-block;
    }

    .current-thumbnail img {
      max-width: 200px;
      border-radius: 4px;
    }

    .form-actions {
      display: flex;
      gap: 12px;
      justify-content: flex-end;
      margin-top: 30px;
      padding-top: 20px;
      border-top: 2px solid #e2e8f0;
    }

    .btn {
      padding: 12px 32px;
      border-radius: 8px;
      font-size: 14px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.2s;
      border: none;
      text-decoration: none;
      display: inline-block;
    }

    .btn-primary {
      background: #000000;
      color: white;
    }

    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .btn-secondary {
      background: #e2e8f0;
      color: #4a5568;
    }

    .btn-secondary:hover {
      background: #cbd5e0;
    }

    .hint {
      font-size: 12px;
      color: #718096;
      margin-top: 4px;
    }
  </style>
</head>
<body>
  <div class="container">
    <a href="{{ route('instructor.courses.index') }}" class="back-link">
      <i class="fas fa-arrow-left"></i> Back to My Courses
    </a>

    <div class="header">
      <h1>Edit Course</h1>
      <p>Update your course information</p>
    </div>

    @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    @if(session('error') || $errors->any())
      <div class="alert alert-error">
        @if(session('error'))
          <div>{{ session('error') }}</div>
        @endif
        @if($errors->any())
          <ul style="margin:8px 0 0 20px;">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        @endif
      </div>
    @endif

    <form method="POST" action="{{ route('instructor.courses.update', $course->id) }}" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <!-- Course Information -->
      <div class="form-section">
        <h2>Course Information</h2>

        <div class="form-group">
          <label>Course Title <span class="required">*</span></label>
          <input type="text" name="title" value="{{ old('title', $course->title) }}" required placeholder="e.g. Complete Web Development Bootcamp">
        </div>

        <div class="form-group">
          <label>Price (Rp) <span class="required">*</span></label>
          <input type="number" name="price" value="{{ old('price', $course->price) }}" min="0" step="0.01" required placeholder="e.g. 500000">
          <div class="hint">Set to 0 for free course</div>
        </div>

        <div class="form-group">
          <label>Course Thumbnail</label>
          
          @if($course->thumbnail)
            <div class="current-thumbnail">
              <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="Current thumbnail">
              <div class="hint" style="margin-top: 8px;">Current thumbnail</div>
            </div>
          @endif

          <div class="file-input-wrapper" style="margin-top: 12px;">
            <input type="file" name="thumbnail" id="thumbnail" accept="image/*" onchange="updateFileName(this, 'thumbnail-name')">
            <label for="thumbnail" class="file-input-label">
              <i class="fas fa-cloud-upload-alt"></i>
              <span>{{ $course->thumbnail ? 'Change thumbnail' : 'Upload thumbnail' }}</span>
            </label>
          </div>
          <div class="file-name" id="thumbnail-name"></div>
          <div class="hint">Recommended: 1280x720px, JPG/PNG, max 5MB</div>
        </div>
      </div>

      <!-- Form Actions -->
      <div class="form-actions">
        <a href="{{ route('instructor.courses.index') }}" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary">Update Course</button>
      </div>
    </form>

    <!-- Manage Subcourses Section -->
    <div style="margin-top: 40px; padding-top: 40px; border-top: 2px solid #e2e8f0;">
      <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <div>
          <h2 style="font-size: 20px; margin-bottom: 4px;">Course Modules</h2>
          <p style="color: #718096; font-size: 14px;">Manage lessons and materials for this course</p>
        </div>
        <button onclick="showAddSubcourseForm()" style="background: #48bb78; color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; font-size: 14px; font-weight: 600;">
          <i class="fas fa-plus"></i> Add Module
        </button>
      </div>

      <!-- Add Subcourse Form (Hidden by default) -->
      <div id="addSubcourseForm" style="display: none; background: #f7fafc; padding: 24px; border-radius: 12px; margin-bottom: 24px; border: 2px solid #e2e8f0;">
        <h3 style="font-size: 16px; margin-bottom: 16px;">Add New Module</h3>
        <form method="POST" action="{{ route('instructor.subcourses.store', $course->id) }}" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label>Module Title <span style="color: #e53e3e;">*</span></label>
            <input type="text" name="title" required placeholder="e.g. Introduction to React">
          </div>
          <div class="form-group">
            <label>Module Content</label>
            <textarea name="content" rows="4" placeholder="Describe this module..."></textarea>
          </div>
          <div class="form-group">
            <label>Thumbnail</label>
            <input type="file" name="thumbnail" accept="image/*">
          </div>
          <div class="form-group">
            <label>Upload File (PDF, Video, etc.)</label>
            <input type="file" name="fileUpload" accept=".pdf,.doc,.docx,.ppt,.pptx,.mp4,.mov,.avi">
          </div>
          <div style="display: flex; gap: 12px;">
            <button type="submit" class="btn btn-primary">Save Module</button>
            <button type="button" onclick="hideAddSubcourseForm()" class="btn btn-secondary">Cancel</button>
          </div>
        </form>
      </div>

      <!-- List of Subcourses -->
      @if($course->subcourses->count() > 0)
        @foreach($course->subcourses as $index => $subcourse)
          <div style="background: white; border: 1px solid #e2e8f0; border-radius: 12px; padding: 20px; margin-bottom: 16px;">
            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 12px;">
              <div style="flex: 1;">
                <h4 style="font-size: 16px; font-weight: 600; margin-bottom: 8px;">
                  {{ $index + 1 }}. {{ $subcourse->title }}
                </h4>
                @if($subcourse->content)
                  <p style="color: #718096; font-size: 14px; margin-bottom: 8px;">{{ Str::limit($subcourse->content, 150) }}</p>
                @endif
                <div style="display: flex; gap: 16px; font-size: 13px; color: #718096;">
                  @if($subcourse->thumbnail)
                    <span><i class="fas fa-image"></i> Has thumbnail</span>
                  @endif
                  @if($subcourse->fileUpload)
                    <span><i class="fas fa-file"></i> Has file</span>
                  @endif
                </div>
              </div>
              <div style="display: flex; gap: 8px;">
                <button onclick="toggleEditForm({{ $subcourse->id }})" style="background: #4299e1; color: white; border: none; padding: 8px 16px; border-radius: 6px; cursor: pointer; font-size: 13px;">
                  <i class="fas fa-edit"></i> Edit
                </button>
                <form method="POST" action="{{ route('instructor.subcourses.destroy', [$course->id, $subcourse->id]) }}" style="display: inline;" onsubmit="return confirm('Delete this module?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" style="background: #fc8181; color: white; border: none; padding: 8px 16px; border-radius: 6px; cursor: pointer; font-size: 13px;">
                    <i class="fas fa-trash"></i> Delete
                  </button>
                </form>
              </div>
            </div>

            <!-- Edit Form (Hidden by default) -->
            <div id="editForm{{ $subcourse->id }}" style="display: none; margin-top: 16px; padding-top: 16px; border-top: 1px solid #e2e8f0;">
              <form method="POST" action="{{ route('instructor.subcourses.update', [$course->id, $subcourse->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                  <label>Module Title <span style="color: #e53e3e;">*</span></label>
                  <input type="text" name="title" value="{{ $subcourse->title }}" required>
                </div>
                <div class="form-group">
                  <label>Module Content</label>
                  <textarea name="content" rows="4">{{ $subcourse->content }}</textarea>
                </div>
                <div class="form-group">
                  <label>Thumbnail</label>
                  @if($subcourse->thumbnail)
                    <div style="margin-bottom: 8px;">
                      <img src="{{ asset('storage/' . $subcourse->thumbnail) }}" style="max-width: 200px; border-radius: 8px;">
                    </div>
                  @endif
                  <input type="file" name="thumbnail" accept="image/*">
                </div>
                <div class="form-group">
                  <label>Upload File</label>
                  @if($subcourse->fileUpload)
                    <div style="margin-bottom: 8px; color: #718096; font-size: 14px;">
                      Current: {{ basename($subcourse->fileUpload) }}
                    </div>
                  @endif
                  <input type="file" name="fileUpload" accept=".pdf,.doc,.docx,.ppt,.pptx,.mp4,.mov,.avi">
                </div>
                <div style="display: flex; gap: 12px;">
                  <button type="submit" class="btn btn-primary">Update Module</button>
                  <button type="button" onclick="toggleEditForm({{ $subcourse->id }})" class="btn btn-secondary">Cancel</button>
                </div>
              </form>
            </div>
          </div>
        @endforeach
      @else
        <div style="text-align: center; padding: 40px; color: #718096; background: #f7fafc; border-radius: 12px;">
          <i class="fas fa-book-open" style="font-size: 48px; margin-bottom: 16px; opacity: 0.3;"></i>
          <p>No modules yet. Click "Add Module" to create your first lesson.</p>
        </div>
      @endif
    </div>
  </div>

  <script>
    function updateFileName(input, targetId) {
      const target = document.getElementById(targetId);
      if (input.files && input.files[0]) {
        target.textContent = `Selected: ${input.files[0].name}`;
      } else {
        target.textContent = '';
      }
    }

    function showAddSubcourseForm() {
      document.getElementById('addSubcourseForm').style.display = 'block';
    }

    function hideAddSubcourseForm() {
      document.getElementById('addSubcourseForm').style.display = 'none';
    }

    function toggleEditForm(subcourseId) {
      const form = document.getElementById('editForm' + subcourseId);
      if (form.style.display === 'none' || form.style.display === '') {
        form.style.display = 'block';
      } else {
        form.style.display = 'none';
      }
    }
  </script>
</body>
</html>
