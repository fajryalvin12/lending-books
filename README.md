# 📚 Lending Books Application

A web-based application for managing book data and borrowing system, built with Laravel.  
This project is part of a technical test.

---

## 🚀 Features

### 🔴 Required Features (Implemented)

- CRUD Books (Create, Read, Update, Delete)
- Multi-auth (Admin & Member) using Guard
- DataTables (server-side processing)
- AJAX-based interaction (jQuery)
- RESTful API for books

---

## 🛠 Tech Stack

- Backend: Laravel (PHP)
- Frontend: AdminLTE + jQuery
- Database: SQLite / MySQL
- ORM: Eloquent
- DataTables: Yajra DataTables

---

## 🔐 User Roles

### 👤 Admin

- Manage books (CRUD)
- Access admin dashboard

### 👥 Member

- Access member dashboard
- (Optional) Borrowing feature

---

## 📡 API Endpoints

| Method | Endpoint          | Description      |
| ------ | ----------------- | ---------------- |
| GET    | /api/books        | Get all books    |
| GET    | /api/books/{code} | Get book by code |
| POST   | /api/books        | Create new book  |
| PUT    | /api/books/{code} | Update book      |
| DELETE | /api/books/{code} | Delete book      |

---

## ⚙️ Installation & Setup

1. Clone the repository

```bash
git clone https://github.com/username/lending-books.git
cd lending-books

```

2. Install dependencies

```bash

composer install

```

3. Setup environment

```bash

cp .env.example .env
php artisan key:generate

```

4. Setup database

```bash

php artisan migrate --seed

```

5. Run the application

```bash

php artisan serve

```
