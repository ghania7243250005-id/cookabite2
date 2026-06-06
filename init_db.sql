-- init_db.sql
-- Creates the `cookabite` database and `reviews` table for the rating API.
-- Usage: mysql -u root -p < init_db.sql

CREATE DATABASE IF NOT EXISTS `cookabite`
  CHARACTER SET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

USE `cookabite`;

CREATE TABLE IF NOT EXISTS `reviews` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` VARCHAR(255) NOT NULL,
  `rating` TINYINT UNSIGNED NOT NULL,
  `ulasan` TEXT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CHECK (`rating` BETWEEN 1 AND 5)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Optional: If your MySQL user does not have privileges, run as an admin
-- then grant permissions to the application DB user, e.g.:
-- GRANT ALL PRIVILEGES ON `cookabite`.* TO 'youruser'@'localhost' IDENTIFIED BY 'yourpassword';
-- FLUSH PRIVILEGES;
