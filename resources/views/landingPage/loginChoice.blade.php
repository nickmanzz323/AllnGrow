<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Get Started - AllnGrow</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: #000000;
      color: #f5f5f5;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    /* Header */
    .header {
      padding: 1.5rem 2rem;
      display: flex;
      justify-content: center;
    }

    .logo {
      display: flex;
      align-items: center;
    }

    .logo img {
      height: 40px;
    }

    /* Main Content */
    .main-content {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem;
    }

    .choice-container {
      text-align: center;
      max-width: 800px;
      width: 100%;
    }

    .choice-header {
      margin-bottom: 3rem;
    }

    .choice-header h1 {
      font-size: 2.5rem;
      font-weight: 700;
      color: #ffffff;
      margin-bottom: 1rem;
    }

    .choice-header p {
      font-size: 1.1rem;
      color: #a3a3a3;
      max-width: 500px;
      margin: 0 auto;
    }

    .choice-cards {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 2rem;
      margin-bottom: 2rem;
    }

    .choice-card {
      background: #0f0f0f;
      border: 2px solid #262626;
      border-radius: 20px;
      padding: 2.5rem 2rem;
      text-decoration: none;
      color: inherit;
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }

    .choice-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: transparent;
      transition: background 0.3s ease;
    }

    .choice-card:hover {
      border-color: #ffffff;
      transform: translateY(-8px);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
    }

    .choice-card:hover::before {
      background: #ffffff;
    }

    .choice-card.student:hover {
      border-color: #4ade80;
    }

    .choice-card.student:hover::before {
      background: #4ade80;
    }

    .choice-card.instructor:hover {
      border-color: #60a5fa;
    }

    .choice-card.instructor:hover::before {
      background: #60a5fa;
    }

    .card-icon {
      width: 80px;
      height: 80px;
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 1.5rem;
      font-size: 2rem;
      transition: all 0.3s ease;
    }

    .choice-card.student .card-icon {
      background: rgba(74, 222, 128, 0.1);
      color: #4ade80;
    }

    .choice-card.student:hover .card-icon {
      background: rgba(74, 222, 128, 0.2);
      transform: scale(1.1);
    }

    .choice-card.instructor .card-icon {
      background: rgba(96, 165, 250, 0.1);
      color: #60a5fa;
    }

    .choice-card.instructor:hover .card-icon {
      background: rgba(96, 165, 250, 0.2);
      transform: scale(1.1);
    }

    .card-title {
      font-size: 1.5rem;
      font-weight: 600;
      color: #ffffff;
      margin-bottom: 0.75rem;
    }

    .card-description {
      font-size: 0.95rem;
      color: #a3a3a3;
      line-height: 1.6;
      margin-bottom: 1.5rem;
    }

    .card-features {
      text-align: left;
      margin-bottom: 1.5rem;
    }

    .feature-item {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      padding: 0.5rem 0;
      font-size: 0.85rem;
      color: #d4d4d4;
    }

    .feature-item i {
      font-size: 0.75rem;
    }

    .choice-card.student .feature-item i {
      color: #4ade80;
    }

    .choice-card.instructor .feature-item i {
      color: #60a5fa;
    }

    .card-button {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      padding: 0.875rem 1.5rem;
      border-radius: 10px;
      font-weight: 600;
      font-size: 0.95rem;
      transition: all 0.2s ease;
    }

    .choice-card.student .card-button {
      background: #4ade80;
      color: #000000;
    }

    .choice-card.student:hover .card-button {
      background: #22c55e;
    }

    .choice-card.instructor .card-button {
      background: #60a5fa;
      color: #000000;
    }

    .choice-card.instructor:hover .card-button {
      background: #3b82f6;
    }

    .back-link {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      color: #a3a3a3;
      text-decoration: none;
      font-size: 0.9rem;
      transition: color 0.2s;
      margin-top: 1rem;
    }

    .back-link:hover {
      color: #ffffff;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .choice-cards {
        grid-template-columns: 1fr;
        gap: 1.5rem;
      }

      .choice-header h1 {
        font-size: 1.75rem;
      }

      .choice-header p {
        font-size: 1rem;
      }

      .choice-card {
        padding: 2rem 1.5rem;
      }

      .card-icon {
        width: 60px;
        height: 60px;
        font-size: 1.5rem;
      }

      .card-title {
        font-size: 1.25rem;
      }
    }
  </style>
</head>
<body>
  <!-- Header -->
  <header class="header">
    <a href="{{ route('home') }}" class="logo">
      <img src="{{ asset('images/AllnGrowLogo.svg') }}" alt="AllnGrow Logo">
    </a>
  </header>

  <!-- Main Content -->
  <main class="main-content">
    <div class="choice-container">
      <div class="choice-header">
        <h1>Selamat Datang di AllnGrow</h1>
        <p>Pilih bagaimana Anda ingin bergabung dengan platform pembelajaran kami</p>
      </div>

      <div class="choice-cards">
        <!-- Student Card -->
        <a href="{{ route('student.login') }}" class="choice-card student">
          <div class="card-icon">
            <i class="fas fa-user-graduate"></i>
          </div>
          <h2 class="card-title">Saya Seorang Pelajar</h2>
          <p class="card-description">
            Akses berbagai kursus berkualitas dan tingkatkan keterampilan Anda
          </p>
          <div class="card-features">
            <div class="feature-item">
              <i class="fas fa-check"></i>
              <span>Akses ribuan kursus</span>
            </div>
            <div class="feature-item">
              <i class="fas fa-check"></i>
              <span>Sertifikat digital</span>
            </div>
            <div class="feature-item">
              <i class="fas fa-check"></i>
              <span>Belajar kapan saja</span>
            </div>
          </div>
          <span class="card-button">
            <span>Masuk sebagai Pelajar</span>
            <i class="fas fa-arrow-right"></i>
          </span>
        </a>

        <!-- Instructor Card -->
        <a href="{{ route('instructor.login') }}" class="choice-card instructor">
          <div class="card-icon">
            <i class="fas fa-chalkboard-teacher"></i>
          </div>
          <h2 class="card-title">Saya Seorang Instruktur</h2>
          <p class="card-description">
            Bagikan pengetahuan Anda dan bantu orang lain berkembang
          </p>
          <div class="card-features">
            <div class="feature-item">
              <i class="fas fa-check"></i>
              <span>Buat dan kelola kursus</span>
            </div>
            <div class="feature-item">
              <i class="fas fa-check"></i>
              <span>Jangkau lebih banyak pelajar</span>
            </div>
            <div class="feature-item">
              <i class="fas fa-check"></i>
              <span>Dapatkan penghasilan</span>
            </div>
          </div>
          <span class="card-button">
            <span>Masuk sebagai Instruktur</span>
            <i class="fas fa-arrow-right"></i>
          </span>
        </a>
      </div>

      <a href="{{ route('home') }}" class="back-link">
        <i class="fas fa-arrow-left"></i>
        Kembali ke Beranda
      </a>
    </div>
  </main>
</body>
</html>
