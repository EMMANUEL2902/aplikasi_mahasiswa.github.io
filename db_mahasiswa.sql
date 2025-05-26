-- SQL struktur dasar untuk aplikasi mahasiswa
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50),
  password VARCHAR(100),
  role ENUM('admin','user') DEFAULT 'user'
);

INSERT INTO users (username, password, role) VALUES
('admin', 'admin123', 'admin'),
('user', 'user123', 'user');

CREATE TABLE mahasiswa (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nim VARCHAR(20),
  nama VARCHAR(100),
  jurusan VARCHAR(100),
  foto VARCHAR(255)
);