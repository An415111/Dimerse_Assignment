-- Database Schema for Bombay Chai & Roast Co. (Mumbai Cafe)
-- MySQL 8.0+ / MariaDB compatible

CREATE DATABASE IF NOT EXISTS mumbai_cafe
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE mumbai_cafe;

-- Drop table if exists for clean re-runs
DROP TABLE IF EXISTS posts;

CREATE TABLE posts (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    excerpt TEXT NOT NULL,
    content MEDIUMTEXT NOT NULL,
    meta_title VARCHAR(255) NOT NULL,
    meta_description VARCHAR(320) NOT NULL,
    image_url VARCHAR(255) NOT NULL,
    image_alt VARCHAR(255) NOT NULL,
    category VARCHAR(100) NOT NULL DEFAULT 'Culture & Brews',
    reading_time VARCHAR(20) NOT NULL DEFAULT '4 min read',
    author VARCHAR(100) NOT NULL DEFAULT 'Farhan Merchant, Head Roaster',
    published_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_slug (slug),
    INDEX idx_published_at (published_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
