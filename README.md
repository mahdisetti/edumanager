# EduManager - PHP/JS Student Management Project

A dynamic PHP + JavaScript web application for student management inspired by the provided EduManager interfaces.

## Technologies
- PHP 8+
- MySQL / MariaDB
- XAMPP
- phpMyAdmin
- HTML5, CSS3, Vanilla JavaScript
- No external framework

## Main features
- Authentication with PHP sessions and hashed passwords
- Dashboard statistics
- Student CRUD
- Services CRUD
- Bookings / reservations CRUD
- Presence / attendance management
- Comments / recent activity
- File upload for student avatars and service images/PDFs
- JSON API endpoints
- CSV export using JavaScript
- MVC-inspired architecture with OOP classes for every entity

## Installation on XAMPP
1. Copy the folder `edumanager` into:
   `C:/xampp/htdocs/`
2. Start Apache and MySQL in XAMPP.
3. Open phpMyAdmin:
   `http://localhost/phpmyadmin`
4. Import:
   `database/edumanager.sql`
5. Open the app:
   `http://localhost/edumanager/public`

## Default admin account
- Email: `admin@edu-manager.com`
- Password: `admin123`

## Project architecture
```text
edumanager/
├── app/
│   ├── Controllers/      # Auth, dashboard, CRUD controllers
│   ├── Core/             # Database, Controller, Model, Auth, FileUploader
│   ├── Models/           # User, Student, Service, Booking, Presence, Comment, Upload
│   └── Views/            # Login, dashboard, students, services, bookings, presence
├── config/               # Database and app config
├── database/             # SQL schema + seed data
├── public/               # Front controller + public assets
│   ├── assets/css/
│   ├── assets/js/
│   └── uploads/
└── README.md
```

## Routes
- `index.php?route=login`
- `index.php?route=dashboard`
- `index.php?route=students`
- `index.php?route=services`
- `index.php?route=bookings`
- `index.php?route=presence`
- `index.php?route=api.stats`
- `index.php?route=api.students`

## Git / commits suggestion
```bash
git init
git add .
git commit -m "Initial EduManager MVC project"
git branch -M main
git remote add origin YOUR_REPO_URL
git push -u origin main
```

Recommended commits per person:
1. Auth + DB config
2. Student CRUD
3. Service CRUD + upload
4. Bookings + presence
5. Dashboard stats + API
6. UI optimisation + responsive design

## Hosting
For local demo: XAMPP is enough. For online hosting, choose a PHP/MySQL host, upload the project, import `database/edumanager.sql`, then update `config/config.php` with the production database credentials.
