CREATE DATABASE registrasi;
USE registrasi;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    tanggal_daftar TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
