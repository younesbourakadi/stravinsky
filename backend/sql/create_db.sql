CREATE DATABASE IF NOT EXISTS stravinsky;

USE stravinsky;

CREATE TABLE IF NOT EXISTS USERS (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS ACTIVITIES (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    activity_id BIGINT NOT NULL,
    stream_distance JSON,
    stream_time JSON,
    activity_date DATETIME,
    FOREIGN KEY (user_id) REFERENCES USERS(id) ON DELETE CASCADE
);

