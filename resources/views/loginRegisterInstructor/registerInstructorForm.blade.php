<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Instructor Registration | AllnGrow</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/InstructorRegisterForm.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />

</head>

<body>
  <!-- Background -->
  <div class="background">
    <div class="ball"></div>
    <div class="ball"></div>
    <div class="ball"></div>
    <div class="ball"></div>
    <div class="ball"></div>
    <div class="ball"></div>
    <div class="ball"></div>
    <div class="ball"></div>
  </div>

  <button class="back-btn" onclick="window.history.back()">
    <i class="fa-solid fa-arrow-left"></i>
    <span>Back</span>
  </button>

  <div class="form-wrapper">
    <div class="form-container">
      <h1 class="form-title">Complete Your Profile</h1>
      <p class="form-subtitle">Add your details to help students learn more about you. All fields are optional.</p>

      @if(session('success'))
        <div style="background:#d4edda;border:1px solid #c3e6cb;color:#155724;padding:12px;margin:12px 0;border-radius:4px;">
          {{ session('success') }}
        </div>
      @endif
      @if(session('error') || $errors->any())
        <div style="background:#fff3cd;border:1px solid #ffeeba;color:#856404;padding:12px;margin:12px 0;border-radius:4px;">
          @if(session('error'))
            <div>{{ session('error') }}</div>
          @endif
          @if($errors->any())
            <ul style="margin:0;padding-left:20px;">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          @endif
        </div>
      @endif

      <form method="POST" action="{{ route('register.instructor.step2') }}" enctype="multipart/form-data">
      <form method="POST" action="{{ route('register.instructor.step2') }}" enctype="multipart/form-data">
        @csrf
        
        <!-- Profile Photo Upload -->
        <div class="photo-upload-section">
          <label class="photo-label">Profile Photo (Optional)</label>
          <div class="photo-upload-box">
            <input type="file" id="profile-photo" name="profile_photo" accept="image/*">
            <div class="photo-preview" id="photoPreview">
              <i class="fa-solid fa-camera"></i>
            </div>
          </div>
        </div>

        <!-- Profile Information -->
        <section class="form-section">
          <h2 class="section-title">Profile Information</h2>
          <div class="form-grid">
            <div class="form-group">
              <label>Gender</label>
              <select name="gender">
                <option value="">Select</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
            </div>
            <div class="form-group">
              <label>Date of Birth</label>
              <input type="date" name="dob" value="{{ old('dob') }}">
            </div>
          </div>

          <div class="form-grid">
            <div class="form-group">
              <label>Phone Number</label>
              <input type="tel" name="phone" placeholder="+62 812-xxxx-xxxx" value="{{ old('phone') }}">
            </div>
            <div class="form-group">
              <label>Country</label>
              <input type="text" name="country" placeholder="Indonesia" value="{{ old('country') }}">
            </div>
          </div>

          <div class="form-group">
            <label>Short Bio</label>
            <textarea rows="3" name="bio" placeholder="Tell us about your teaching background...">{{ old('bio') }}</textarea>
          </div>
        </section>

        <!-- Professional Credentials -->
        <section class="form-section">
          <h2 class="section-title">Professional Credentials</h2>

          <div class="form-grid">
            <div class="form-group">
              <label>Field of Expertise</label>
              <input type="text" name="expertise" placeholder="e.g. Web Development, UI/UX Design, Marketing" value="{{ old('expertise') }}">
            </div>
            <div class="form-group">
              <label>Years of Experience</label>
              <input type="number" name="years_experience" placeholder="e.g. 5" min="0" value="{{ old('years_experience') }}">
            </div>
          </div>

          <div class="form-grid">
            <div class="form-group">
              <label>Upload CV</label>
              <input type="file" name="cv" accept=".pdf,.doc,.docx">
            </div>
          </div>

          <div class="form-group">
            <label>LinkedIn Profile (Optional)</label>
            <input type="url" name="linkedin" placeholder="https://linkedin.com/in/username" value="{{ old('linkedin') }}">
          </div>
        </section>

        <div class="form-actions">
          <button type="submit" class="btn primary">Complete Registration</button>
          <a href="{{ route('instructor.login') }}" class="btn secondary">Skip for Now</a>
        </div>
      </form>
    </div>
  </div>

  <script>
    // Simple Photo Preview
    const fileInput = document.getElementById('profile-photo');
    const photoPreview = document.getElementById('photoPreview');

    fileInput.addEventListener('change', function() {
      const file = this.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          photoPreview.style.backgroundImage = `url('${e.target.result}')`;
          photoPreview.innerHTML = "";
        };
        reader.readAsDataURL(file);
      }
    });

    // Click area opens file picker
    photoPreview.addEventListener('click', () => fileInput.click());
  </script>
</body>
</html>
