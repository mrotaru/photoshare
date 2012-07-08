--
-- Create inital database and tables
--

-- create and start using database
CREATE DATABASE IF NOT EXISTS imgshare;
USE imgshare;

-- create database user
CREATE USER 'imgshare'@'localhost' IDENTIFIED BY 'asdjkl';

-- give all privileges for username-prefix databases
GRANT ALL PRIVILEGES ON imgshare.* TO 'imgshare'@'localhost';

-- users table
CREATE TABLE IF NOT EXISTS `users` (
    id int(11) NOT NULL auto_increment,
    username varchar(50) NOT NULL,
    password varchar(40) NOT NULL,
    first_name varchar(40) NOT NULL,
    last_name varchar(40) NOT NULL,
    email varchar(30) NOT NULL,
    PRIMARY KEY (id));

-- photographs table
CREATE TABLE IF NOT EXISTS `photographs` (
    id int(11) NOT NULL auto_increment PRIMARY KEY,
    filename VARCHAR(255) NOT NULL,
    type VARCHAR(100) NOT NULL,
    size INT(11) NOT NULL,
    caption VARCHAR(255) NOT NULL
);

-- comments table
CREATE TABLE IF NOT EXISTS `comments` (
    id int(11) NOT NULL auto_increment PRIMARY KEY,
    photo_id int(11) NOT NULL,
    user_id int(11) NOT NULL, -- annonymous comments not allowed
    created DATETIME NOT NULL,
    body VARCHAR(255) NOT NULL
);

ALTER TABLE `comments` ADD INDEX (photo_id); -- faster searches

-- add test users
INSERT INTO `users` ( username, password, first_name, last_name, email ) VALUES
( 'derp', 'asdasd', 'Derp', 'Derpowsky', 'derp@gmail.com' );
