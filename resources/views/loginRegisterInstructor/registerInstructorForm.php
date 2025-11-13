<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Instructor Registration | AllnGrow</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/instructorRegisterForm.css">
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
      <h1 class="form-title">Instructor Registration</h1>
      <p class="form-subtitle">Join AllnGrow and share your expertise with thousands of learners.</p>

      <form>
        <!-- Profile Photo Upload -->
        <div class="photo-upload-section">
          <label class="photo-label">Profile Photo</label>
          <div class="photo-upload-box">
            <input type="file" id="profile-photo" accept="image/*">
            <div class="photo-preview" id="photoPreview">
              <i class="fa-solid fa-camera"></i>
            </div>
          </div>
        </div>

        <!-- Account Information -->
        <section class="form-section">
          <h2 class="section-title">Account Information</h2>
          <div class="form-grid">
            <div class="form-group">
              <label>Full Name</label>
              <input type="text" placeholder="John Doe" required>
            </div>
            <div class="form-group">
              <label>Email Address</label>
              <input type="email" placeholder="example@gmail.com" required>
            </div>
          </div>

          <div class="form-grid">
            <div class="form-group">
              <label>Password</label>
              <input type="password" placeholder="••••••••" required>
            </div>
            <div class="form-group">
              <label>Confirm Password</label>
              <input type="password" placeholder="••••••••" required>
            </div>
          </div>
        </section>

        <!-- Profile Information -->
        <section class="form-section">
          <h2 class="section-title">Profile Information</h2>
          <div class="form-grid">
            <div class="form-group">
              <label>Gender</label>
              <select required>
                <option value="">Select</option>
                <option>Male</option>
                <option>Female</option>
              </select>
            </div>
            <div class="form-group">
              <label>Date of Birth</label>
              <input type="date" required>
            </div>
          </div>

          <div class="form-grid">
            <div class="form-group">
              <label>Phone Number</label>
              <input type="tel" placeholder="+62 812-xxxx-xxxx">
            </div>
            <div class="form-group">
              <label>Country</label>
              <select>
                <option value="">Select Country</option>
                <option>Indonesia</option>
                <option>Malaysia</option>
                <option>Singapore</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label>Short Bio</label>
            <textarea rows="3" placeholder="Tell us about your teaching background..."></textarea>
          </div>
        </section>

        <!-- Professional Credentials -->
        <section class="form-section">
          <h2 class="section-title">Professional Credentials</h2>

          <div class="form-grid">
            <div class="form-group">
              <label>Field of Expertise</label>
              <input type="text" placeholder="e.g. Web Development, UI/UX Design, Marketing" required>
            </div>
            <div class="form-group">
              <label>Years of Experience</label>
              <input type="number" placeholder="e.g. 5" min="0">
            </div>
          </div>

          <div class="form-grid">
            <div class="form-group">
              <label>Upload CV</label>
              <input type="file" accept=".pdf,.doc,.docx">
            </div>
            <div class="form-group">
              <label>Upload Certification(s)</label>
              <input type="file" accept=".pdf,.jpg,.png" multiple>
            </div>
          </div>

          <div class="form-group">
            <label>LinkedIn Profile (Optional)</label>
            <input type="url" placeholder="https://linkedin.com/in/username">
          </div>
        </section>

        <div class="form-actions">
          <button type="submit" class="btn primary">Register</button>
          <button type="reset" class="btn secondary">Cancel</button>
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
