-- Run this SQL in your MySQL database to create the restaurant database and orders table

CREATE DATABASE IF NOT EXISTS restaurant;
USE restaurant;

DROP TABLE IF EXISTS orders;

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(255),
    address TEXT,
    phone VARCHAR(50),
    subtotal DECIMAL(10,2),
    tax DECIMAL(10,2),
    total DECIMAL(10,2),
    items TEXT,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);