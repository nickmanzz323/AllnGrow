<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Course - AllnGrow Instructor</title>
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
    .form-group input[type="number"],
    .form-group textarea {
      width: 100%;
      padding: 12px 16px;
      border: 1px solid #cbd5e0;
      border-radius: 8px;
      font-size: 14px;
      font-family: inherit;
      transition: all 0.2s;
    }

    .form-group input:focus,
    .form-group textarea:focus {
      outline: none;
      border-color: #000000;
      box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.05);
    }

    .form-group textarea {
      resize: vertical;
      min-height: 100px;
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

    .subcourse-section {
      background: #f7fafc;
      padding: 20px;
      border-radius: 8px;
      margin-bottom: 16px;
      border: 1px solid #e2e8f0;
    }

    .subcourse-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 16px;
    }

    .subcourse-header h3 {
      font-size: 16px;
      color: #2d3748;
    }

    .btn-remove {
      background: #fc8181;
      color: white;
      border: none;
      padding: 6px 12px;
      border-radius: 6px;
      cursor: pointer;
      font-size: 13px;
      transition: background 0.2s;
    }

    .btn-remove:hover {
      background: #f56565;
    }

    .btn-add-subcourse {
      background: #48bb78;
      color: white;
      border: none;
      padding: 12px 20px;
      border-radius: 8px;
      cursor: pointer;
      font-size: 14px;
      font-weight: 500;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      transition: background 0.2s;
      margin-top: 10px;
    }

    .btn-add-subcourse:hover {
      background: #38a169;
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
      <h1>Create New Course</h1>
      <p>Fill in the details below to create a new course for your students</p>
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

    <form method="POST" action="{{ route('instructor.courses.store') }}" enctype="multipart/form-data">
      @csrf

      <!-- Course Information -->
      <div class="form-section">
        <h2>Course Information</h2>

        <div class="form-group">
          <label>Course Title <span class="required">*</span></label>
          <input type="text" name="title" value="{{ old('title') }}" required placeholder="e.g. Complete Web Development Bootcamp">
        </div>

        <div class="form-group">
          <label>Price (Rp) <span class="required">*</span></label>
          <input type="number" name="price" value="{{ old('price', 0) }}" min="0" step="0.01" required placeholder="e.g. 500000">
          <div class="hint">Set to 0 for free course</div>
        </div>

        <div class="form-group">
          <label>Course Thumbnail</label>
          <div class="file-input-wrapper">
            <input type="file" name="thumbnail" id="thumbnail" accept="image/*" onchange="updateFileName(this, 'thumbnail-name')">
            <label for="thumbnail" class="file-input-label">
              <i class="fas fa-cloud-upload-alt"></i>
              <span>Click to upload course thumbnail</span>
            </label>
          </div>
          <div class="file-name" id="thumbnail-name"></div>
          <div class="hint">Recommended: 1280x720px, JPG/PNG, max 5MB</div>
        </div>

        <div class="form-group">
          <label>Course Description</label>
          <textarea name="description" placeholder="Describe what students will learn in this course...">{{ old('description') }}</textarea>
        </div>
      </div>

      <!-- Subcourses Section -->
      <div class="form-section">
        <h2>Course Modules / Subcourses</h2>
        <p class="hint" style="margin-bottom: 16px;">Add modules or lessons for your course (optional)</p>

        <div id="subcourses-container">
          <!-- Subcourses akan ditambahkan di sini via JavaScript -->
        </div>

        <button type="button" class="btn-add-subcourse" onclick="addSubcourse()">
          <i class="fas fa-plus"></i> Add Module
        </button>
      </div>

      <!-- Form Actions -->
      <div class="form-actions">
        <a href="{{ route('instructor.courses.index') }}" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary">Create Course</button>
      </div>
    </form>
  </div>

  <script>
    let subcourseIndex = 0;

    function addSubcourse() {
      const container = document.getElementById('subcourses-container');
      const subcourseHtml = `
        <div class="subcourse-section" id="subcourse-${subcourseIndex}">
          <div class="subcourse-header">
            <h3>Module ${subcourseIndex + 1}</h3>
            <button type="button" class="btn-remove" onclick="removeSubcourse(${subcourseIndex})">
              <i class="fas fa-trash"></i> Remove
            </button>
          </div>

          <div class="form-group">
            <label>Module Title <span class="required">*</span></label>
            <input type="text" name="subcourses[${subcourseIndex}][title]" placeholder="e.g. Introduction to HTML" required>
          </div>

          <div class="form-group">
            <label>Module Content</label>
            <textarea name="subcourses[${subcourseIndex}][content]" placeholder="Describe this module..."></textarea>
          </div>

          <div class="form-group">
            <label>Module Thumbnail</label>
            <div class="file-input-wrapper">
              <input type="file" name="subcourses[${subcourseIndex}][thumbnail]" id="sub-thumb-${subcourseIndex}" accept="image/*" onchange="updateFileName(this, 'sub-thumb-name-${subcourseIndex}')">
              <label for="sub-thumb-${subcourseIndex}" class="file-input-label">
                <i class="fas fa-image"></i>
                <span>Upload module thumbnail</span>
              </label>
            </div>
            <div class="file-name" id="sub-thumb-name-${subcourseIndex}"></div>
          </div>

          <div class="form-group">
            <label>Module File (PDF, Video, etc)</label>
            <div class="file-input-wrapper">
              <input type="file" name="subcourses[${subcourseIndex}][fileUpload]" id="sub-file-${subcourseIndex}" accept=".pdf,.doc,.docx,.ppt,.pptx,.mp4,.mov,.avi" onchange="updateFileName(this, 'sub-file-name-${subcourseIndex}')">
              <label for="sub-file-${subcourseIndex}" class="file-input-label">
                <i class="fas fa-file-upload"></i>
                <span>Upload module file</span>
              </label>
            </div>
            <div class="file-name" id="sub-file-name-${subcourseIndex}"></div>
            <div class="hint">Accepted: PDF, DOC, PPT, MP4, MOV, AVI (max 50MB)</div>
          </div>
        </div>
      `;
      
      container.insertAdjacentHTML('beforeend', subcourseHtml);
      subcourseIndex++;
    }

    function removeSubcourse(index) {
      const element = document.getElementById(`subcourse-${index}`);
      if (element) {
        element.remove();
      }
    }

    function updateFileName(input, targetId) {
      const target = document.getElementById(targetId);
      if (input.files && input.files[0]) {
        target.textContent = `Selected: ${input.files[0].name}`;
      } else {
        target.textContent = '';
      }
    }
  </script>
</body>
</html>
