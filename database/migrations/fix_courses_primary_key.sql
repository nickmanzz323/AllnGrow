-- SQL untuk memperbaiki struktur tabel courses dan subcourses
-- Jalankan query ini di phpMyAdmin atau MySQL client

-- BACKUP DATA DULU!
-- CREATE TABLE courses_backup AS SELECT * FROM courses;
-- CREATE TABLE subcourses_backup AS SELECT * FROM subcourses;

-- 1. Drop foreign key yang ada
ALTER TABLE `subcourses` DROP FOREIGN KEY IF EXISTS `subcourses_course_id_foreign`;
ALTER TABLE `student_course` DROP FOREIGN KEY IF EXISTS `student_course_courseID_foreign`;
ALTER TABLE `course_rating` DROP FOREIGN KEY IF EXISTS `course_rating_courseID_foreign`;

-- 2. Rename kolom id menjadi courseID di tabel courses (jika masih id)
-- Cek dulu apakah primary key adalah 'id' atau 'courseID'
-- SHOW KEYS FROM courses WHERE Key_name = 'PRIMARY';

-- Jika primary key masih 'id', rename ke 'courseID'
ALTER TABLE `courses` 
CHANGE COLUMN `id` `courseID` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT;

-- 3. Recreate foreign key dengan referensi yang benar
ALTER TABLE `subcourses`
ADD CONSTRAINT `subcourses_course_id_foreign` 
FOREIGN KEY (`course_id`) 
REFERENCES `courses` (`courseID`) 
ON DELETE CASCADE;

ALTER TABLE `student_course`
ADD CONSTRAINT `student_course_courseID_foreign` 
FOREIGN KEY (`courseID`) 
REFERENCES `courses` (`courseID`) 
ON DELETE CASCADE;

ALTER TABLE `course_rating`
ADD CONSTRAINT `course_rating_courseID_foreign` 
FOREIGN KEY (`courseID`) 
REFERENCES `courses` (`courseID`) 
ON DELETE CASCADE;

-- 4. Verifikasi struktur
DESCRIBE courses;
SHOW CREATE TABLE subcourses;
SHOW CREATE TABLE student_course;
SHOW CREATE TABLE course_rating;
