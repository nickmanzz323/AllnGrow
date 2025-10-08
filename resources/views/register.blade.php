<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Metadata dasar -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign Up | HinGrow</title>
    <meta name="description" content="Daftar akun HinGrow sebagai pelajar atau guru. Buat akun dengan email/kata sandi atau Google." />

    <!-- Hubungkan file CSS eksternal -->
    <link rel="stylesheet" href="css/register.css">
</head>
<body>
    <!-- Kontainer utama halaman -->
    <main class="login-container">
        
        <!-- Bagian logo dan judul halaman -->
        <div class="logo-section">
            <img src="images/companyLogo.png" alt="HinGrow Logo" class="logo" />
            <h1 class="login-title">Login</h1>
        </div>

        <!-- Pemilihan role (Student / Teacher) -->
        <div class="role-selection-group">
            <button type="button" class="role-button student-active">Student</button>
            <button type="button" class="role-button teacher-inactive">Teacher</button>
        </div>
        
        <!-- Formulir Sign-Up -->
        <form class="form-container">
            <div class="form-fields">
                
                <!-- Input Nama -->
                <div class="input-group">
                    <label for="name" class="input-label">Name</label>
                    <div class="input-wrapper">
                        <!-- Icon pengguna -->
                        <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                        <input type="text" id="name" class="input-field" placeholder="John Doe" required />
                    </div>
                </div>

                <!-- Input Email -->
                <div class="input-group">
                    <label for="email" class="input-label">Email</label>
                    <div class="input-wrapper">
                        <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="5" width="18" height="14" rx="2"/>
                            <path d="m22 7-8.975 5.25L3 7"/>
                        </svg>
                        <input type="email" id="email" class="input-field" placeholder="example@gmail.com" required />
                    </div>
                </div>

                <!-- Input Password -->
                <div class="input-group">
                    <label for="password" class="input-label">Password</label>
                    <div class="input-wrapper">
                        <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="11" width="18" height="11" rx="2"/>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                        </svg>
                        <input type="password" id="password" class="input-field" placeholder="••••••••" required />
                    </div>
                </div>

                <!-- Checkbox Syarat & Ketentuan -->
                <div class="terms-and-privacy">
                    <div class="checkbox-wrapper">
                        <input type="checkbox" id="agree-terms" class="checkbox" />
                        <label for="agree-terms" class="checkbox-label">
                            I agree with 
                            <a href="#">Terms</a>
                            and
                            <a href="#">Privacy policy</a>.
                        </label>
                    </div>
                </div>

            </div>

            <!-- Tombol Sign-Up -->
            <button type="submit" class="sign-in-btn">Sign up</button>
        </form>

        <!-- Divider atau pemisah -->
        <div class="divider-section">
            <div class="divider-row">
                <div class="divider-line"></div>
                <span class="divider-text">Or sign up with</span>
                <div class="divider-line"></div>
            </div>

            <!-- Tombol Sign-Up dengan Google -->
            <button type="button" class="google-btn">
                <img src="images/googleIcon.png" alt="Google Icon" class="google-icon" />
                Sign in with Google
            </button>
        </div>

        <!-- Link ke Sign-In -->
        <div class="signup-section">
            <span class="signup-text">Already have an account yet?</span>
            <a href="#" class="signup-link">Sign in</a>
        </div>
        
    </main>
</body>
</html>
