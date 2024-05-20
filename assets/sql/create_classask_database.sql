CREATE DATABASE IF NOT EXISTS classask;

USE classask;

-- Create the Session table
CREATE TABLE IF NOT EXISTS `ci_sessions` (
    `id` VARCHAR(128) NOT NULL,
    `ip_address` VARCHAR(45) NOT NULL,
    `timestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `data` BLOB NOT NULL,
    KEY `ci_sessions_timestamp` (`timestamp`)
);

-- Create the User table
CREATE TABLE IF NOT EXISTS `user` (
    `user_id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_name` VARCHAR(255) NOT NULL,
    `user_email` VARCHAR(255) NOT NULL UNIQUE,
    `user_type` ENUM('s', 't') NOT NULL,
    `user_password` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL
);

-- Create the Question table
CREATE TABLE IF NOT EXISTS `question` (
    `question_id` INT AUTO_INCREMENT PRIMARY KEY,
    `question_title` VARCHAR(255) NOT NULL,
    `question_content` LONGTEXT NOT NULL,
    `user_id` INT,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `vote_count` INT DEFAULT 0,
    `star_count` INT DEFAULT 0,
    FOREIGN KEY (`user_id`) REFERENCES `user`(`user_id`)
);

-- Create the Answer table
CREATE TABLE IF NOT EXISTS `answer` (
    `answer_id` INT AUTO_INCREMENT PRIMARY KEY,
    `answer_content` LONGTEXT NOT NULL,
    `question_id` INT,
    `user_id` INT,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    `vote_count` INT DEFAULT 0,
    `star_count` INT DEFAULT 0,
    FOREIGN KEY (`question_id`) REFERENCES `question`(`question_id`),
    FOREIGN KEY (`user_id`) REFERENCES `user`(`user_id`)
);

-- Create the Tag table
CREATE TABLE IF NOT EXISTS `tag` (
    `tag_id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL
);

-- Create the Question_Tag table
CREATE TABLE IF NOT EXISTS `question_tag` (
    `question_id` INT,
    `tag_id` INT,
    PRIMARY KEY (`question_id`, `tag_id`),
    FOREIGN KEY (`question_id`) REFERENCES `question`(`question_id`),
    FOREIGN KEY (`tag_id`) REFERENCES `tag`(`tag_id`)
);
