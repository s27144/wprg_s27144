-- Tworzenie bazy danych
CREATE DATABASE IF NOT EXISTS blogDB;
USE blogDB;

-- Tworzenie tabeli użytkowników
CREATE TABLE Users (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       username VARCHAR(255) NOT NULL UNIQUE,
                       email VARCHAR(255) NOT NULL UNIQUE,
                       password_hash VARCHAR(255) NOT NULL,
                       is_admin BOOLEAN NOT NULL DEFAULT FALSE,
                       is_author BOOLEAN NOT NULL DEFAULT FALSE
);

-- Tworzenie tabeli wpisów (postów)
CREATE TABLE Posts (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       title VARCHAR(255) NOT NULL,
                       content TEXT NOT NULL,
                       image_path VARCHAR(255) DEFAULT NULL,
                       date_published DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Tworzenie tabeli komentarzy
CREATE TABLE Comments (
                          id INT AUTO_INCREMENT PRIMARY KEY,
                          post_id INT NOT NULL,
                          author_id INT DEFAULT NULL,
                          author_name VARCHAR(255) DEFAULT 'Gość',
                          content TEXT NOT NULL,
                          date_added DATETIME DEFAULT CURRENT_TIMESTAMP,
                          FOREIGN KEY (post_id) REFERENCES Posts(id) ON DELETE CASCADE,
                          FOREIGN KEY (author_id) REFERENCES Users(id) ON DELETE SET NULL
);

CREATE TABLE issues (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        username VARCHAR(255) NOT NULL,
                        email VARCHAR(255) NOT NULL,
                        description TEXT NOT NULL,
                        report_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

