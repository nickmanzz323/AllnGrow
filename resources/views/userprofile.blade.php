<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>User Profile | AllnGrow</title>
  <link rel="stylesheet" href="css/userprofile.css" />
  <!-- <link rel="stylesheet" href="css/login.css" /> -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<!-- background -->
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


<body>
  <!-- BACK BUTTON -->
  <button class="back-btn" onclick="window.history.back()">
    <i class="fa-solid fa-arrow-left"></i>
    <span>Back</span>
  </button>

  <section class="profile-container">
    <h2>User Profile</h2>

    <!-- Profile Picture Section -->
    <div class="profile-picture-center">
      <div class="profile-picture">
        <img src="images/userprofile/smileroblox.webp" id="profileImage" alt="User Profile Picture" />
        <label for="uploadImage" class="upload-btn"><i class="fa-solid fa-camera"></i></label>
        <input type="file" id="uploadImage" accept="image/*">
      </div>
    </div>

    <p class="profile-subtitle">Manage your personal information and account details.</p>

    <!-- Profile Card -->
    <div class="profile-card">
      <form class="profile-form">
        <div class="form-group">
          <label>Full Name</label>
          <input type="text" placeholder="e.g. John Doe" />
        </div>

        <div class="form-group">
          <label>Username</label>
          <input type="text" placeholder="e.g. @john_doe" />
        </div>

        <div class="form-group">
          <label>Email</label>
          <input type="email" placeholder="e.g. johndoe@email.com" />
        </div>

        <div class="form-group">
          <label>Phone Number</label>
          <input type="tel" placeholder="e.g. +62 81234567890" />
        </div>

        <div class="form-group">
          <label>City</label>
          <input type="text" placeholder="e.g. Jakarta" />
        </div>

        <div class="form-group">
          <label>About Me</label>
          <textarea rows="3" placeholder="Tell us a little about yourself..."></textarea>
        </div>

        <div class="btn-group">
          <button type="submit" class="btn-save">Save Changes</button>
          <button type="button" class="btn-cancel">Cancel</button>
        </div>
      </form>
    </div>
  </section>

  <script>
    // === SIMPLE PHOTO PREVIEW ===
    const upload = document.getElementById('uploadImage');
    const profileImage = document.getElementById('profileImage');
    upload.addEventListener('change', () => {
      const file = upload.files[0];
      if (file) {
        profileImage.src = URL.createObjectURL(file);
      }
    });
  </script>
</body>
</html>
