CREATE DATABASE IF NOT EXISTS edumanager_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE edumanager_db;

DROP TABLE IF EXISTS uploads;
DROP TABLE IF EXISTS comments;
DROP TABLE IF EXISTS presences;
DROP TABLE IF EXISTS bookings;
DROP TABLE IF EXISTS services;
DROP TABLE IF EXISTS students;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  email VARCHAR(160) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role ENUM('admin','agent','student') DEFAULT 'admin',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE students (
  id INT AUTO_INCREMENT PRIMARY KEY,
  student_code VARCHAR(30) NOT NULL UNIQUE,
  first_name VARCHAR(80) NOT NULL,
  last_name VARCHAR(80) NOT NULL,
  email VARCHAR(160) UNIQUE,
  phone VARCHAR(40),
  class_name VARCHAR(120),
  status ENUM('Active','Pending','Suspended','At Risk') DEFAULT 'Active',
  avatar VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_student_search(first_name,last_name,email,class_name)
) ENGINE=InnoDB;

CREATE TABLE services (
  id INT AUTO_INCREMENT PRIMARY KEY,
  service_code VARCHAR(30) NOT NULL UNIQUE,
  name VARCHAR(160) NOT NULL,
  category ENUM('Academic','Healthcare','Residential','Auxiliary') DEFAULT 'Academic',
  price DECIMAL(10,2) DEFAULT 0,
  description TEXT,
  status ENUM('Active','Pending','Archived') DEFAULT 'Active',
  image VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_services(category,status)
) ENGINE=InnoDB;

CREATE TABLE bookings (
  id INT AUTO_INCREMENT PRIMARY KEY,
  student_id INT NOT NULL,
  service_id INT NOT NULL,
  booking_date DATE NOT NULL,
  status ENUM('Pending','Confirmed','Cancelled','Done') DEFAULT 'Pending',
  comment TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY(student_id) REFERENCES students(id) ON DELETE CASCADE,
  FOREIGN KEY(service_id) REFERENCES services(id) ON DELETE CASCADE,
  INDEX idx_booking_status(status, booking_date)
) ENGINE=InnoDB;

CREATE TABLE presences (
  id INT AUTO_INCREMENT PRIMARY KEY,
  student_id INT NOT NULL,
  presence_date DATE NOT NULL,
  status ENUM('Present','Absent','Late') DEFAULT 'Present',
  note VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY(student_id) REFERENCES students(id) ON DELETE CASCADE,
  UNIQUE KEY unique_presence(student_id, presence_date)
) ENGINE=InnoDB;

CREATE TABLE comments (
  id INT AUTO_INCREMENT PRIMARY KEY,
  student_id INT NOT NULL,
  content TEXT NOT NULL,
  type VARCHAR(60) DEFAULT 'Note',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY(student_id) REFERENCES students(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE uploads (
  id INT AUTO_INCREMENT PRIMARY KEY,
  file_name VARCHAR(255) NOT NULL,
  file_path VARCHAR(255) NOT NULL,
  mime_type VARCHAR(100),
  size INT,
  entity_type VARCHAR(50),
  entity_id INT DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

INSERT INTO users(name,email,password,role) VALUES
('Admin User','admin@edu-manager.com','$2y$12$twDIXKEsuZfsgN9AttDhpe6zZ7/Zd0JZR6sUxBhKJP7rTEIdJm8Oe','admin');
-- password: admin123

INSERT INTO students(student_code,first_name,last_name,email,phone,class_name,status) VALUES
('ST-8821','Jane','Doe','jane.doe@edu.manager','+216 55 111 111','Grade 12 - Advanced Physics','Active'),
('ST-9014','Marcus','Smith','marcus.smith@edu.manager','+216 55 222 222','Grade 11 - Computer Science','Pending'),
('ST-7732','Alicia','Lopez','alicia.l@edu.manager','+216 55 333 333','Grade 12 - Visual Arts','Suspended'),
('ST-9122','Robert','King','rking@edu.manager','+216 55 444 444','Grade 10 - Mathematics','Active');

INSERT INTO services(service_code,name,category,price,description,status) VALUES
('EDU-901','Data Analytics Masters','Academic',12400,'Full-term academic enrollment for advanced data programs.','Active'),
('EDU-722','Student Housing - Hall A','Residential',850,'Dormitory housing application and room management.','Active'),
('EDU-441','Summer Language Camp','Auxiliary',120,'Short language camp for new students.','Archived'),
('EDU-555','Campus Health Plan','Healthcare',450,'Comprehensive medical insurance and clinic access for students.','Active');

INSERT INTO bookings(student_id,service_id,booking_date,status,comment) VALUES
(1,1,CURDATE(),'Confirmed','Advanced Calculus II enrollment'),
(2,2,CURDATE(),'Pending','Waiting for housing approval'),
(3,4,CURDATE(),'Cancelled','Payment failed');

INSERT INTO presences(student_id,presence_date,status,note) VALUES
(1,CURDATE(),'Present','On time'),(2,CURDATE(),'Late','10 minutes late'),(3,CURDATE(),'Absent','No justification');

INSERT INTO comments(student_id,content,type) VALUES
(1,'Julianne Moore enrolled in Advanced Calculus II','New Enrollment'),
(3,'Attempted transaction for Semester Fee failed','Payment Failed'),
(2,'Laboratory Access Level 3 approved by Supervisor','Service Verified');
