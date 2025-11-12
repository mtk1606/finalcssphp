# Gaming Laptop Store - Phase 1

A gaming laptop e-commerce website built with PHP and custom CSS as a college project.

## Project Overview
This is Phase 1 of a two-phase project for Intro to Web Programming (PHP) and Interface Design (CSS) courses. Currently displays static product data with a focus on layout, design, and front-end functionality.

## Technologies Used
- **PHP** - Server-side templating
- **HTML5** - Semantic markup
- **CSS3** - Custom styling (Flexbox-based layout)
- **MySQL** - Database structure (ready for Phase 2)

## Current Features (Phase 1)
- Homepage with featured products section
- Full product catalog page
- About page with company information
- Contact form with basic validation
- Login/Register pages (authentication coming in Phase 2)
- Responsive design for mobile and desktop
- Header/Footer template system

## Project Structure
```
gaming-laptop-store/
├── index.php           # Homepage
├── shop.php            # All products page
├── about.php           # About us page
├── contact.php         # Contact form
├── login.php           # Login page
├── register.php        # Registration page
├── css/
│   └── style.css       # All custom styling
├── templates/
│   ├── header.php      # Reusable header
│   └── footer.php      # Reusable footer
├── assets/
│   └── (laptop images) # Product images
└── database.sql        # Database structure
```

## Design Specifications
- **Color Scheme:** Red (#cc0000, #ff3333) and dark tones (#1a0000, #2b2b2b)
- **Typography:** 
  - Headings: Orbitron (bold, futuristic)
  - Body: Roboto (clean, readable)
- **Layout:** Flexbox-based responsive grid
- **Effects:** Hover animations, transitions, box shadows

## Database Setup
1. Create a MySQL database
2. Import `database.sql` to create tables:
   - `admin_users` - For admin authentication (Phase 2)
   - `products` - For laptop inventory (Phase 2)

## Local Setup
1. Clone or download this repository
2. Place in your web server directory (e.g., `htdocs/` for XAMPP)
3. Import `database.sql` into phpMyAdmin
4. Add laptop images to `/assets` folder
5. Visit `http://localhost/gaming-laptop-store` in browser

## Phase 1 Completion Checklist
- [x] All customer-facing pages built
- [x] Header/Footer templating
- [x] Custom CSS (no Bootstrap/frameworks)
- [x] Two different fonts implemented
- [x] Consistent color scheme
- [x] Responsive design
- [x] Database structure created
- [x] Static placeholder content

## What's Coming in Phase 2
- Database connection and dynamic content
- Admin dashboard with CRUD functionality
- User authentication with sessions
- Password hashing and security
- Image upload system
- Product management system

## Notes
All content is currently static (hardcoded arrays). Database integration scheduled for Phase 2.

---

**Course:** Intro to Web Programming (PHP) & Interface Design (CSS)  
**Due Date:** Phase 1 - November 11, 2025 | Phase 2 - December 12, 2025  
**Student:** Mohamed el khoudimi
