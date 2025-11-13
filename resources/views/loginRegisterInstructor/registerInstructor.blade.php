<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Sign Up | AllnGrow</title>
<meta name="description" content="Daftar akun HinGrow sebagai pelajar atau guru. Buat akun dengan email/kata sandi atau Google." />
<link rel="stylesheet" href="css/registerInstructor.css">
</head>
<body>
    <div class="slider-thumb">
    <div class="slider-thumb1"></div>
    <div class="slider-thumb2"></div>
    <div class="slider-thumb3"></div>
    <div class="slider-thumb4"></div>
    <div class="slider-thumb5"></div>

    <main class="login-container">
        <div class="logo-section">
            <div class="logo">AllnGrow</div>
            <h1 class="login-title">Register For Instructor</h1>
        </div>
        <form class="form-container" method="POST" action="{{ route('register') }}">
            @csrf
            <input type="hidden" name="level" value="student" />
            {{-- Prominent warning box when registration fails --}}
            @if(session('error') || $errors->any())
                <div style="background:#fff3cd;border:1px solid #ffeeba;color:#856404;padding:14px;margin:12px 0;border-radius:6px;">
                    <strong style="display:block;margin-bottom:8px;">Registration failed</strong>
                    @if(session('error'))
                        <div style="margin-bottom:6px;">{{ session('error') }}</div>
                    @endif
                    @if($errors->any())
                        <ul style="margin:0;padding-left:18px;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            @endif
            <div class="form-fields">
                
                <div class="input-group">
                    <label for="name" class="input-label">Name</label>
                    <div class="input-wrapper">
                        <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                        <input type="text" id="name" name="name" class="input-field" placeholder="John Doe" value="{{ old('name') }}" required />
                    </div>
                </div>

                <div class="input-group">
                    <label for="email" class="input-label">Email</label>
                    <div class="input-wrapper">
                        <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="5" width="18" height="14" rx="2"/>
                            <path d="m22 7-8.975 5.25L3 7"/>
                        </svg>
                        <input type="email" id="email" name="email" class="input-field" placeholder="example@gmail.com" value="{{ old('email') }}" required />
                    </div>
                </div>

                <div class="input-group">
                    <label for="password" class="input-label">Password</label>
                    <div class="input-wrapper">
                        <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="11" width="18" height="11" rx="2"/>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                        </svg>
                        <input type="password" id="password" name="password" class="input-field" placeholder="••••••••" required />
                    </div>
                </div>

              
                <div class="input-group">
                    <label for="password_confirmation" class="input-label">Confirm Password</label>
                    <div class="input-wrapper">
                         <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="11" width="18" height="11" rx="2"/>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                        </svg>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="input-field" placeholder="••••••••" required />
                    </div>
                </div>

                
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

           
            <button type="submit" class="sign-in-btn">Sign up</button>
        </form>

        ->
        <div class="divider-section">
            <div class="divider-row">
                <div class="divider-line"></div>
                <span class="divider-text">Or sign up with</span>
                <div class="divider-line"></div>
            </div>

            
            <button type="button" class="google-btn">
                <img src="images/googleIcon.png" alt="Google Icon" class="google-icon" />
                Sign in with Google
            </button>
        </div>

       
        <div class="signup-section">
            <span class="signup-text">Already have an account yet?</span>
            <a href="/login" class="signup-link">Sign in</a>
        </div>
    </main>
</body>
</html>
