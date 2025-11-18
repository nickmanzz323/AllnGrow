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
    /* Variables – full monochrome dark */
    :root {
      --bg: #000000;
      --surface: #0d0d0d;
      --surface-soft: #111111;
      --text: #f5f5f5;
      --text-muted: #a3a3a3;
      --border: #262626;
      --primary: #ffffff;
      --primary-dark: #e5e5e5;
      --radius: 12px;
      --shadow: 0 2px 10px rgba(0,0,0,0.7);
      --shadow-lg: 0 4px 20px rgba(0,0,0,0.85);
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
      line-height: 1.6;
      min-height: 100vh;
    }

    .page-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 2rem;
    }

    /* Header & Back Link */
    .page-header {
      margin-bottom: 2rem;
    }

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

    .back-link i {
      font-size: 0.9rem;
    }

    .back-link:hover {
      background: #171717;
      color: var(--text);
      transform: translateX(-4px);
    }

    .page-header h1 {
      font-size: 1.75rem;
      font-weight: 700;
      margin-bottom: 0.5rem;
      color: var(--text);
    }

    .page-header p {
      color: var(--text-muted);
      font-size: 0.95rem;
    }

    /* Alert Messages (monochrome) */
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
      color: var(--text-muted);
    }

    .alert i {
      font-size: 1.25rem;
      flex-shrink: 0;
      margin-top: 0.125rem;
      color: var(--text);
    }

    .alert-success { /* gaya sama, beda konteks saja */
      background: #101010;
    }

    .alert-error {
      background: #101010;
    }

    .alert-info {
      background: #141414;
    }

    /* Form Container */
    .form-container {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      padding: 2.5rem;
      box-shadow: var(--shadow);
    }

    /* Form Section */
    .form-section {
      margin-bottom: 2.5rem;
      padding-bottom: 2.5rem;
      border-bottom: 1px solid var(--border);
    }

    .form-section:last-child {
      margin-bottom: 0;
      padding-bottom: 0;
      border-bottom: none;
    }

    .form-section h2 {
      font-size: 1.25rem;
      font-weight: 600;
      color: var(--text);
      margin-bottom: 0.5rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .form-section h2 i {
      font-size: 1rem;
      color: var(--text);
    }

    .form-section > p {
      color: var(--text-muted);
      font-size: 0.875rem;
      margin-bottom: 1.5rem;
    }

    /* Form Grid */
    .form-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 1.5rem;
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
      font-size: 0.9rem;
      font-weight: 600;
      color: var(--text);
      display: flex;
      align-items: center;
      gap: 0.25rem;
    }

    .required {
      color: var(--primary);
      font-weight: 700;
    }

    .form-group input[type="text"],
    .form-group input[type="number"],
    .form-group textarea,
    .form-group select {
      width: 100%;
      padding: 0.875rem 1rem;
      border: 1px solid var(--border);
      border-radius: 10px;
      font-size: 0.95rem;
      font-family: inherit;
      transition: all 0.2s;
      background: #050505;
      color: var(--text);
    }

    .form-group input::placeholder,
    .form-group textarea::placeholder {
      color: #6b6b6b;
    }

    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 2px rgba(255,255,255,0.12);
    }

    .form-group textarea {
      resize: vertical;
      min-height: 120px;
      line-height: 1.6;
    }

    .hint {
      font-size: 0.8rem;
      color: var(--text-muted);
      margin-top: 0.25rem;
    }

    /* File Upload */
    .file-upload-wrapper {
      position: relative;
    }

    .file-upload-wrapper input[type="file"] {
      position: absolute;
      left: -9999px;
    }

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
      text-align: center;
    }

    .file-upload-label:hover {
      border-color: var(--primary);
      background: #161616;
    }

    .file-upload-label i {
      color: var(--primary);
      font-size: 2rem;
    }

    .file-upload-label span {
      font-size: 0.95rem;
      color: var(--text);
      font-weight: 500;
    }

    .file-name {
      font-size: 0.875rem;
      color: var(--primary);
      margin-top: 0.5rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .file-name i {
      color: var(--primary);
    }

    /* Module/Subcourse Card */
    .module-card {
      background: #050505;
      border: 1px solid var(--border);
      border-radius: var(--radius);
      padding: 1.5rem;
      margin-bottom: 1.5rem;
      position: relative;
    }

    .module-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1.5rem;
      padding-bottom: 1rem;
      border-bottom: 1px solid var(--border);
    }

    .module-header h3 {
      font-size: 1.125rem;
      font-weight: 600;
      color: var(--text);
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .module-header h3 i {
      color: var(--text);
      font-size: 1rem;
    }

    .module-number {
      background: #181818;
      color: var(--text);
      padding: 0.25rem 0.75rem;
      border-radius: 20px;
      font-size: 0.8rem;
      font-weight: 600;
      border: 1px solid var(--border);
    }

    .btn-remove-module {
      background: #222222;
      color: var(--text);
      border: 1px solid #3a3a3a;
      padding: 0.5rem 1rem;
      border-radius: 8px;
      cursor: pointer;
      font-size: 0.875rem;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      transition: all 0.2s;
    }

    .btn-remove-module:hover {
      background: #2f2f2f;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0,0,0,0.7);
    }

    /* Add Module Button */
    .btn-add-module {
      background: #050505;
      color: var(--text);
      border: 2px dashed var(--border);
      padding: 1rem 1.5rem;
      border-radius: 10px;
      cursor: pointer;
      font-size: 0.95rem;
      font-weight: 600;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      transition: all 0.2s;
      width: 100%;
      justify-content: center;
    }

    .btn-add-module:hover {
      border-color: var(--primary);
      background: #151515;
    }

    .btn-add-module i {
      font-size: 1rem;
    }

    /* Form Actions */
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

    .btn-primary {
      background: var(--primary);
      color: #000000;
      box-shadow: 0 2px 10px rgba(0,0,0,0.6);
    }

    .btn-primary:hover {
      background: var(--primary-dark);
      transform: translateY(-2px);
      box-shadow: 0 4px 16px rgba(0,0,0,0.9);
    }

    .btn-secondary {
      background: var(--surface-soft);
      color: var(--text);
      border: 1px solid var(--border);
    }

    .btn-secondary:hover {
      background: #1a1a1a;
      transform: translateY(-2px);
      box-shadow: var(--shadow);
    }

    /* Empty State (kalau dipakai nanti) */
    .empty-state {
      text-align: center;
      padding: 3rem 2rem;
      color: var(--text-muted);
    }

    .empty-state i {
      font-size: 3rem;
      color: #3f3f46;
      margin-bottom: 1rem;
    }

    .empty-state p {
      font-size: 0.95rem;
      margin-bottom: 1.5rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .page-container {
        padding: 1rem;
      }

      .form-container {
        padding: 1.5rem;
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

      .module-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
      }

      .btn-remove-module {
        width: 100%;
        justify-content: center;
      }
    }

    @media (max-width: 640px) {
      .page-header h1 {
        font-size: 1.5rem;
      }

      .form-section h2 {
        font-size: 1.125rem;
      }
    }
  </style>
</head>
<body>
  <div class="page-container">
    <!-- Back Link & Logout -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
      <a href="{{ route('instructor.courses.index') }}" class="back-link">
        <i class="fas fa-arrow-left"></i> Back to My Courses
      </a>
      <form method="POST" action="{{ route('instructor.logout') }}" style="margin: 0;">
        @csrf
        <button type="submit" class="back-link" style="background: none; border: none; cursor: pointer; color: var(--text-muted); padding: 0.5rem 1rem; border-radius: 8px; transition: all 0.2s;" onmouseover="this.style.background='#171717'; this.style.color='#ef4444'" onmouseout="this.style.background=''; this.style.color='var(--text-muted)'">
          <i class="fas fa-sign-out-alt"></i> Logout
        </button>
      </form>
    </div>

    <!-- Page Header -->
    <div class="page-header">
      <h1>Create New Course</h1>
      <p>Fill in the details below to create a new course for your students</p>
    </div>

    <!-- Alert Messages -->
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

    <!-- Info Alert -->
    <div class="alert alert-info">
      <i class="fas fa-info-circle"></i>
      <div>
        <strong>Note:</strong> All new courses must be reviewed and approved by administrators before being published. This process typically takes 2-3 business days.
      </div>
    </div>

    <!-- Form Container -->
    <form method="POST" action="{{ route('instructor.courses.store') }}" enctype="multipart/form-data">
      @csrf

      <div class="form-container">
        <!-- Course Information Section -->
        <div class="form-section">
          <h2><i class="fas fa-info-circle"></i> Course Information</h2>
          <p>Provide basic information about your course</p>

          <div class="form-grid">
            <div class="form-group full-width">
              <label>
                Course Title <span class="required">*</span>
              </label>
              <input 
                type="text" 
                name="title" 
                value="{{ old('title') }}" 
                required 
                placeholder="e.g. Complete Web Development Bootcamp"
              >
            </div>

            <div class="form-group">
              <label>
                Price (Rp) <span class="required">*</span>
              </label>
              <input 
                type="number" 
                name="price" 
                value="{{ old('price', 0) }}" 
                min="0" 
                step="0.01" 
                required 
                placeholder="e.g. 500000"
              >
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
                @else
                  <option value="" disabled>No categories available</option>
                @endif
              </select>
            </div>

            <div class="form-group full-width">
              <label>Course Thumbnail</label>
              <div class="file-upload-wrapper">
                <input 
                  type="file" 
                  name="thumbnail" 
                  id="thumbnail" 
                  accept="image/*" 
                  onchange="updateFileName(this, 'thumbnail-name')"
                >
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
              <textarea 
                name="description" 
                placeholder="Describe what students will learn in this course..."
              >{{ old('description') }}</textarea>
              <span class="hint">Provide a detailed overview of your course content and learning outcomes</span>
            </div>
          </div>
        </div>

        <!-- Modules/Subcourses Section -->
        <div class="form-section">
          <h2><i class="fas fa-list"></i> Course Modules</h2>
          <p>Add modules or lessons for your course structure</p>

          <div id="modules-container">
            <!-- Modules will be added here via JavaScript -->
          </div>

          <button type="button" class="btn-add-module" onclick="addModule()">
            <i class="fas fa-plus"></i> Add New Module
          </button>
        </div>

        <!-- Form Actions -->
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
    let moduleIndex = 0;

    function addModule() {
      const container = document.getElementById('modules-container');
      const moduleNumber = moduleIndex + 1;
      
      const moduleHtml = `
        <div class="module-card" id="module-${moduleIndex}">
          <div class="module-header">
            <h3>
              <i class="fas fa-book"></i>
              Module ${moduleNumber}
              <span class="module-number">#${moduleNumber}</span>
            </h3>
            <button type="button" class="btn-remove-module" onclick="removeModule(${moduleIndex})">
              <i class="fas fa-trash"></i> Remove Module
            </button>
          </div>

          <div class="form-grid">
            <div class="form-group full-width">
              <label>
                Module Title <span class="required">*</span>
              </label>
              <input 
                type="text" 
                name="subcourses[${moduleIndex}][title]" 
                placeholder="e.g. Introduction to HTML" 
                required
              >
            </div>

            <div class="form-group full-width">
              <label>Module Description</label>
              <textarea 
                name="subcourses[${moduleIndex}][content]" 
                placeholder="Describe this module content and learning objectives..."
                rows="4"
              ></textarea>
            </div>

            <div class="form-group full-width">
              <label>Module Thumbnail</label>
              <div class="file-upload-wrapper">
                <input 
                  type="file" 
                  name="subcourses[${moduleIndex}][thumbnail]" 
                  id="module-thumb-${moduleIndex}" 
                  accept="image/*" 
                  onchange="updateFileName(this, 'module-thumb-name-${moduleIndex}')"
                >
                <label for="module-thumb-${moduleIndex}" class="file-upload-label">
                  <i class="fas fa-image"></i>
                  <span>Upload module thumbnail</span>
                </label>
              </div>
              <div class="file-name" id="module-thumb-name-${moduleIndex}"></div>
              <span class="hint">Optional: 1280x720px, JPG/PNG, max 3MB</span>
            </div>

            <div class="form-group full-width">
              <label>Module File (PDF, Video, Document)</label>
              <div class="file-upload-wrapper">
                <input 
                  type="file" 
                  name="subcourses[${moduleIndex}][fileUpload]" 
                  id="module-file-${moduleIndex}" 
                  accept=".pdf,.doc,.docx,.ppt,.pptx,.mp4,.mov,.avi" 
                  onchange="updateFileName(this, 'module-file-name-${moduleIndex}')"
                >
                <label for="module-file-${moduleIndex}" class="file-upload-label">
                  <i class="fas fa-file-upload"></i>
                  <span>Upload module content file</span>
                </label>
              </div>
              <div class="file-name" id="module-file-name-${moduleIndex}"></div>
              <span class="hint">Accepted: PDF, DOC, PPT, MP4, MOV, AVI (max 50MB)</span>
            </div>
          </div>
        </div>
      `;
      
      container.insertAdjacentHTML('beforeend', moduleHtml);
      moduleIndex++;
    }

    function removeModule(index) {
      const element = document.getElementById(`module-\${index}`);
      if (element) {
        element.style.transition = 'all 0.3s';
        element.style.opacity = '0';
        element.style.transform = 'translateX(-20px)';
        
        setTimeout(() => {
          element.remove();
        }, 300);
      }
    }

    function updateFileName(input, targetId) {
      const target = document.getElementById(targetId);
      if (input.files && input.files[0]) {
        const fileSize = (input.files[0].size / 1024 / 1024).toFixed(2); // Size in MB
        target.innerHTML = `<i class="fas fa-check-circle"></i> \${input.files[0].name} (\${fileSize} MB)`;
      } else {
        target.innerHTML = '';
      }
    }

    // Kalau mau langsung ada 1 module default saat load:
    // window.addEventListener('DOMContentLoaded', () => {
    //   addModule();
    // });

    // Auto-refresh CSRF token setiap 60 menit untuk mencegah 419 error
    setInterval(function() {
      fetch('{{ route('instructor.courses.create') }}')
        .then(response => response.text())
        .then(html => {
          const parser = new DOMParser();
          const doc = parser.parseFromString(html, 'text/html');
          const newToken = doc.querySelector('input[name="_token"]');
          if (newToken) {
            const oldToken = document.querySelector('input[name="_token"]');
            if (oldToken) {
              oldToken.value = newToken.value;
              console.log('CSRF token refreshed');
            }
          }
        })
        .catch(error => console.error('Error refreshing CSRF token:', error));
    }, 3600000); // 60 minutes

    // Handle form submission dengan retry untuk 419 error
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
