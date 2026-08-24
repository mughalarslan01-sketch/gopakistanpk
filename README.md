# GoPakistan.PK – Travel & Tours Website

GoPakistan.PK is a complete Core PHP tourism website for Pakistan that showcases travel destinations, tour packages, services, and travel articles. The project uses a simple modular folder structure and avoids the use of any PHP framework or MVC pattern.

## Features

- Public website with Home, About Us, Services, Blog, Contact, and detail pages
- Dynamic tour package listings from a MySQL database
- Dynamic blog article listings and article detail pages
- Secure admin panel with PHP sessions and password hashing
- Tour CRUD, article CRUD, contact message management, and admin user management
- CSRF protection on administrative forms
- Prepared statements for all database interactions
- Bootstrap 5 responsive design and jQuery enhancements
- File upload support for tour and article images
- Clean modular includes for header, footer, navbar, and authentication logic

## Technologies

- PHP 8+
- MySQL / MariaDB
- Bootstrap 5
- jQuery
- Font Awesome
- XAMPP / Apache

## Requirements

- XAMPP with Apache and MySQL enabled
- PHP 8.1 or later recommended
- Modern browser such as Chrome or Edge

## XAMPP Installation

1. Install XAMPP.
2. Start Apache and MySQL from the XAMPP control panel.
3. Place the project under `C:\xampp\htdocs\gopakistan`.
4. Open `http://localhost/gopakistan/` in your browser.
5. Open phpMyAdmin and import the file `database/gopakistan.sql`.

## Database Setup

1. Create a database named `gopakistan` in phpMyAdmin.
2. Import the SQL from `database/gopakistan.sql`.
3. Ensure the database credentials match the configuration in `config/database.php`.

## How to Run the Project

1. Copy the project folder into `C:\xampp\htdocs\gopakistan`.
2. Start Apache and MySQL.
3. Import the SQL file.
4. Visit `http://localhost/gopakistan/` to view the website.
5. Visit `http://localhost/gopakistan/admin/login.php` for admin access.

## Admin Login Setup

Default admin account:

- Email: `admin@gopakistan.pk`
- Password: `admin123`

The password is stored using `password_hash()` in the database.

## Folder Structure

```text
gopakistan/
├── index.php
├── about.php
├── services.php
├── blog.php
├── article-details.php
├── tour-details.php
├── contact.php
├── config/
│   ├── database.php
│   └── config.php
├── includes/
│   ├── header.php
│   ├── footer.php
│   ├── navbar.php
│   ├── functions.php
│   └── auth.php
├── assets/
│   ├── css/
│   ├── js/
│   └── images/
├── uploads/
│   ├── tours/
│   └── articles/
├── admin/
│   ├── login.php
│   ├── logout.php
│   ├── dashboard.php
│   ├── includes/
│   ├── tours/
│   ├── articles/
│   ├── messages/
│   └── admins/
├── database/
│   └── gopakistan.sql
├── .gitignore
├── README.md
└── uploads/.gitkeep
```

## CRUD Functionality

### Tour Packages
- Create new tours
- View all tours
- Edit existing tours
- Delete tours
- Upload and manage tour cover images

### Articles
- Create new blog articles
- View articles in the admin panel
- Edit and update article content
- Delete article records

### Contact Messages
- View submitted messages
- Open individual messages
- Mark as read/unread
- Delete messages

### Admin Users
- Add new admin users
- Edit existing users
- Change passwords securely
- Remove admin accounts

## Security Features

- Prepared SQL statements
- XSS output escaping via `htmlspecialchars()`
- Password hashing with `password_hash()` and verification with `password_verify()`
- Session-based admin authentication
- CSRF token validation on admin forms
- File upload validation and sanitization
- Role-based route checks for admin modules

## Notes

This project is intentionally built without Laravel, CodeIgniter, Symfony, or MVC patterns. The goal is to keep the code readable and beginner-friendly while still being robust for a real-world travel website build.
