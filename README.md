# Gaming Laptop Marketplace

## Description
A dynamic e-commerce platform for gaming laptops built with PHP, MySQL, HTML, and CSS. Features both a public customer view and a secure admin backend for product management.

## Technologies
- **Frontend:** HTML, CSS (Flexbox)
- **Backend:** PHP (Sessions, CRUD operations, Template system)
- **Database:** MySQL (Admin users, Products)
- **Version Control:** Git & GitHub

## Project Structure
```
PHPCSSFINAL/
├── index.php
├── shop.php
├── product.php
├── about.php
├── contact.php
├── register.php
├── login.php
├── css/
│   └── style.css
├── templates/
│   ├── header.php
│   └── footer.php
├── includes/
│   ├── config.php
│   └── Database.php
├── assets/
│   └── (placeholder images)
└── sql/
    └── schema.sql
```

## Database Schema

### admin_users Table
| Field | Type | Constraints |
|-------|------|-------------|
| id | INT | PRIMARY KEY, AUTO_INCREMENT |
| name | VARCHAR(100) | NOT NULL |
| email | VARCHAR(100) | UNIQUE, NOT NULL |
| password | VARCHAR(255) | NOT NULL (hashed) |

### products Table
| Field | Type | Constraints |
|-------|------|-------------|
| id | INT | PRIMARY KEY, AUTO_INCREMENT |
## Setup Instructions

### Requirements
- PHP 7.4+
- MySQL 5.7+
- Apache/XAMPP/WAMP

### Installation Steps

1. **Clone Repository**
   ```
   git clone https://github.com/yourusername/PHPCSSFINAL.git
   cd PHPCSSFINAL
   ```

2. **Create Database**
   - Open phpMyAdmin
   - Import `sql/schema.sql`
   - This creates `admin_users` and `products` tables

3. **Configure Database**
   - Edit `includes/config.php`
   - Update DB_HOST, DB_USER, DB_PASS, DB_NAME

4. **Run Project**
   - Place folder in `htdocs/` (XAMPP) or `www/` (WAMP)
   - Start Apache & MySQL
   - Visit `http://localhost/PHPCSSFINAL`

## Features

### Public Pages
- Homepage with featured products
- Product listing with filter sidebar
- Single product detail pages
- About page
- Contact form
- User registration with email validation

### Security
- CSRF token protection
- Password hashing (bcrypt)
- Prepared statements (SQL injection prevention)
- Input validation & sanitization
- Session-based authentication

## Phase 1 Status (Nov 11)

### Completed
- All customer-facing pages (HTML/CSS)
- Header/Footer templating
- Responsive Flexbox design
- Basic security implementation
- Database schema
- Color scheme (Red & Dark palette)
- Two fonts (Georgia + Arial)

### Next Phase (Phase 2)
- Database integration for product listing
- Admin CRUD functionality
- Login/Logout with session control
- Dynamic product pages from database
- Update `README.md` with full setup instructions and screenshots.
- Deploy to Georgian College server and confirm functionality.
- Submit GitHub link + server URL by **December 12**.
---