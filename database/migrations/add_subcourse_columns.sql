-- SQL untuk menambahkan kolom video_url, description, dan order ke tabel subcourses
-- Jalankan query ini di phpMyAdmin atau MySQL client

-- Cek kolom yang sudah ada
DESCRIBE subcourses;

-- Jika kolom description belum ada, jalankan:
-- ALTER TABLE `subcourses` 
-- ADD COLUMN `description` TEXT NULL AFTER `title`;

-- Jika kolom video_url belum ada, jalankan:
ALTER TABLE `subcourses` 
ADD COLUMN `video_url` VARCHAR(255) NULL AFTER `content`;

-- Jika kolom order belum ada, jalankan:
ALTER TABLE `subcourses` 
ADD COLUMN `order` INT NOT NULL DEFAULT 0 AFTER `video_url`;

-- Verifikasi struktur tabel setelah update
DESCRIBE subcourses;
