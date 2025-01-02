DROP DATABASE IF EXISTS devblog_db;
CREATE DATABASE devblog_db;

-- Connect to the database
USE devblog_db;

-- Create table for categories
CREATE TABLE categories (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    name TEXT NOT NULL
);

-- Create table for users
CREATE TABLE users (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(20) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    bio TEXT,
    profile_picture_url VARCHAR(255)
);

-- Create table for articles

CREATE TABLE articles (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    excerpt TEXT,
    meta_description VARCHAR(160),
    category_id BIGINT NOT NULL,
    featured_image VARCHAR(255),
    status ENUM('draft', 'published', 'scheduled') NOT NULL DEFAULT 'draft',
    scheduled_date DATETIME NULL,
    author_id BIGINT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    views INTEGER DEFAULT 0,
    UNIQUE KEY idx_articles_slug (slug),
    KEY idx_articles_category (category_id),
    KEY idx_articles_author (author_id),
    KEY idx_articles_status_date (status, scheduled_date),
    CONSTRAINT fk_articles_category FOREIGN KEY (category_id) 
        REFERENCES categories (id),
    CONSTRAINT fk_articles_author FOREIGN KEY (author_id) 
        REFERENCES users (id),
    CONSTRAINT chk_scheduled_date CHECK (
        (status != 'scheduled') OR 
        (status = 'scheduled' AND scheduled_date IS NOT NULL)
    )
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- Create table for tags
CREATE TABLE tags (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL UNIQUE
);

-- Create table for article_tags to handle many-to-many relationship
CREATE TABLE article_tags (
    article_id BIGINT,
    tag_id BIGINT,
    PRIMARY KEY (article_id, tag_id),
    FOREIGN KEY (article_id) REFERENCES articles(id) ON DELETE CASCADE,
    FOREIGN KEY (tag_id) REFERENCES tags(id) ON DELETE CASCADE
);

-- Insert Categories
-- Insert Categories
INSERT INTO categories (id, name) VALUES
(1, 'Web Development'),
(2, 'Mobile Development'),
(3, 'DevOps'),
(4, 'Data Science'),
(5, 'Artificial Intelligence');

-- Insert Users
INSERT INTO users (id, username, email, password_hash, bio, profile_picture_url) VALUES
(5, 'john_doe', 'john@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Senior Web Developer with 10 years of experience', 'profiles/john.jpg'),
(6, 'jane_smith', 'jane@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Full Stack Developer and AI enthusiast', 'profiles/jane.jpg'),
(7, 'michelle_wilson', 'michelle@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'DevOps Engineer and Cloud Architect', 'profiles/mike.jpg');

-- Insert Articles
INSERT INTO articles (
    title, 
    slug, 
    content, 
    excerpt, 
    meta_description, 
    category_id, 
    featured_image, 
    status, 
    scheduled_date, 
    author_id
) VALUES
(
    'Getting Started with React Hooks',
    'getting-started-with-react-hooks',
    'React Hooks are a powerful feature that allows you to use state and other React features without writing a class component...',
    'Learn how to use React Hooks in your applications',
    'A comprehensive guide to React Hooks for beginners',
    1, -- category_id for Web Development
    'images/react-hooks.jpg',
    'published',
    NULL,
    5  -- author_id for john_doe
),
(
    'Docker Container Basics',
    'docker-container-basics',
    'Docker containers provide a way to package applications with all their dependencies...',
    'Understanding Docker containers and their benefits',
    'Learn Docker container basics and best practices',
    3, -- category_id for DevOps
    'images/docker-basics.jpg',
    'published',
    NULL,
    7  -- author_id for mike_wilson
);

-- Insert Article Tags (after articles are inserted)
INSERT INTO article_tags (article_id, tag_id)
SELECT a.id, t.id
FROM articles a, tags t
WHERE a.slug = 'getting-started-with-react-hooks'
AND t.name IN ('JavaScript', 'React', 'Web Development');

INSERT INTO article_tags (article_id, tag_id)
SELECT a.id, t.id
FROM articles a, tags t
WHERE a.slug = 'docker-container-basics'
AND t.name IN ('Docker', 'DevOps');

-- Insert Tags
INSERT INTO tags (id, name) VALUES
(1, 'JavaScript'),
(2, 'React'),
(3, 'Docker'),
(4, 'Machine Learning'),
(5, 'Web Development'),
(6, 'DevOps'),
(7, 'Python'),
(8, 'AI');

-- Insert Article Tags
INSERT INTO article_tags (article_id, tag_id) VALUES
(1, 1), -- React Hooks article - JavaScript
(1, 2), -- React Hooks article - React
(1, 5), -- React Hooks article - Web Development
(2, 3), -- Docker article - Docker
(2, 6), -- Docker article - DevOps
(3, 4), -- ML article - Machine Learning
(3, 8), -- ML article - AI
(4, 1), -- JavaScript article - JavaScript
(4, 5); -- JavaScript article - Web Development

