-- database setup for laptop shop

CREATE DATABASE IF NOT EXISTS laptop_shop;
USE laptop_shop;

-- admin table
CREATE TABLE IF NOT EXISTS admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- products table
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    model VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    specs TEXT,
    description TEXT,
    image VARCHAR(255),
    stock INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- sample admin user (password: admin123)
INSERT INTO admin_users (name, email, password) VALUES
('Ekin Taha', 'mokhoudimi@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- sample products
INSERT INTO products (model, price, specs, description, image, stock) VALUES
('Predator X15', 1299.00, 'RTX 4060, i7-13700H, 16GB RAM, 512GB SSD', 'High performance gaming laptop with advanced cooling system and RGB keyboard.', 'laptop1.jpg', 5),
('ROG Strix G17', 1599.00, 'RTX 4070, Ryzen 9 7940HS, 32GB RAM, 1TB SSD', 'Premium AMD gaming machine with stunning 17-inch display and premium build quality.', 'laptop2.jpg', 3),
('Legion 5 Pro', 1899.00, 'RTX 4080, i9-13900H, 32GB RAM, 1TB SSD', 'Top tier performance laptop designed for competitive gaming and content creation.', 'laptop3.jpg', 4),
('Razer Blade 15', 2199.00, 'RTX 4090, i9-13900HX, 32GB RAM, 2TB SSD', 'Ultra premium gaming laptop with sleek aluminum chassis and powerful specs.', 'laptop4.jpg', 2),
('MSI Stealth 16', 1799.00, 'RTX 4070, i7-13700H, 16GB RAM, 1TB SSD', 'Sleek and powerful gaming laptop with excellent portability and battery life.', 'laptop5.jpg', 6),
('Alienware M17', 2499.00, 'RTX 4090, i9-13980HX, 64GB RAM, 2TB SSD', 'Ultimate gaming beast with distinctive design and unmatched performance.', 'laptop6.jpg', 1);
