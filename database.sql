-- database setup for phase 1

CREATE DATABASE IF NOT EXISTS gaming_store;
USE gaming_store;

-- admin users table
CREATE TABLE admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- products table
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    model VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    specs TEXT,
    description TEXT,
    img VARCHAR(255),
    stock INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- sample data for testing
INSERT INTO products (model, price, specs, description, img, stock) VALUES
('Predator X15', 1299.00, 'RTX 4060, i7-13700H, 16GB RAM', 'High performance gaming laptop', 'laptop1.jpg', 5),
('ROG Strix G17', 1599.00, 'RTX 4070, Ryzen 9, 32GB RAM', 'Premium AMD gaming machine', 'laptop2.jpg', 3),
('Legion 5 Pro', 1899.00, 'RTX 4080, i9-13900H, 32GB RAM', 'Top tier performance laptop', 'laptop3.jpg', 4),
('Razer Blade 15', 2199.00, 'RTX 4090, i9-13900HX, 32GB RAM', 'Ultra premium gaming laptop', 'laptop4.jpg', 2),
('MSI Stealth 16', 1799.00, 'RTX 4070, i7-13700H, 16GB RAM', 'Sleek and powerful', 'laptop5.jpg', 6),
('Alienware M17', 2499.00, 'RTX 4090, i9-13980HX, 64GB RAM', 'Ultimate gaming beast', 'laptop6.jpg', 1);