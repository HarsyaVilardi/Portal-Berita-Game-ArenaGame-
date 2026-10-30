# ArenaGame.com - Landing Page Esports

Portal Berita dan Komunitas Esports Terdepan di Indonesia

## 🎮 Deskripsi Proyek

ArenaGame.com adalah landing page dinamis untuk portal berita dan komunitas esports yang dibangun dengan teknologi modern: HTML, Tailwind CSS, JavaScript, dan PHP dengan database MySQL.

## 🚀 Fitur Utama

- ✅ **8 Halaman Lengkap**:

  - `index.php` - Landing page dengan berita esports terkini
  - `about.php` - Tentang ArenaGame dan developer
  - `contact.php` - Form kontak dengan validasi PHP
  - `login.php` - Form login dengan autentikasi database
  - `register.php` - Form registrasi user baru
  - `profile.php` - Halaman profile user dengan edit profile
  - `admin/login.php` - Login admin terpisah dari login publik
  - `admin/index.php` - Dashboard khusus akun berperan admin

- ✅ **Desain Modern**:

  - Dark theme dengan Tailwind CSS
  - Fully responsive (mobile-friendly)
  - Fixed navbar dengan hamburger menu
  - Smooth animations dan hover effects
  - Skeleton loading untuk images

- ✅ **Interaktivitas JavaScript**:

  - Mobile menu toggle
  - Form validation
  - Smooth scrolling
  - Image lazy loading
  - Dynamic notifications

- ✅ **Backend PHP & MySQL**:
  - Database connection dengan MySQLi
  - User authentication system (login/register/logout)
  - User profile management dengan edit profile
  - Contact form dengan database storage
  - Password hashing untuk keamanan
  - Input sanitization
  - Session management

## 📁 Struktur Folder

```
ArenaGame/
├── index.php                 # Halaman utama
├── about.php                 # Halaman tentang
├── contact.php               # Halaman kontak
├── login.php                 # Halaman login
├── register.php              # Halaman registrasi
├── profile.php               # Halaman profile user
│
├── admin/
│   ├── login.php              # Login khusus admin
│   ├── index.php              # Dashboard yang hanya bisa diakses admin
│   ├── process_login.php      # Proses autentikasi admin
│   └── logout.php             # Logout admin
│
├── includes/
│   ├── header.php           # Header & navbar (with auth status)
│   ├── footer.php           # Footer
│   └── admin_auth.php       # Pemeriksaan sesi dan peran admin
│
├── assets/
│   ├── css/
│   │   └── style.css        # Custom CSS + skeleton loading
│   └── js/
│       └── main.js          # JavaScript + skeleton loader
│
├── config/
│   └── database.php         # Konfigurasi database
│
├── processes/
│   ├── handle_contact.php   # Proses form kontak
│   ├── handle_login.php     # Proses login
│   ├── handle_register.php  # Proses registrasi
│   ├── handle_logout.php    # Proses logout
│   └── handle_update_profile.php  # Proses update profile
│
├── database/
│   └── arenagame.sql        # SQL schema & sample data
│
└── README.md                # Dokumentasi
```

## 🔧 Instalasi & Setup

### Prasyarat

- Laragon (sudah terinstall)
- PHP 7.4+
- MySQL/MariaDB

### Langkah-langkah:

1. **Clone/Copy project ke folder Laragon**

   ```
   Letakkan folder ArenaGame di: C:\laragon\www\ArenaGame
   ```

2. **Import Database**

   - Buka phpMyAdmin (http://localhost/phpmyadmin)
   - Buat database baru bernama `arenagame`
   - Import file `database/arenagame.sql`

   Atau via command line:

   ```bash
   mysql -u root -p
   CREATE DATABASE arenagame;
   USE arenagame;
   SOURCE C:/laragon/www/ArenaGame/database/arenagame.sql;
   ```

3. **Konfigurasi Database**

   - Edit file `config/database.php` jika diperlukan
   - Default settings:
     ```php
     DB_HOST: localhost
     DB_USER: root
     DB_PASS: (kosong)
     DB_NAME: arenagame
     ```

4. **Jalankan Aplikasi**
   - Start Laragon
   - Buka browser: `http://localhost/ArenaGame` atau `http://arenagame.test`

## 📊 Database Schema

### Tabel: `users`

- `id` - Primary key
- `username` - Username unik
- `name` - Nama lengkap
- `email` - Email unik
- `password` - Password (hashed)
- `role` - Peran akun (`user` atau `admin`, default `user`)
- `created_at` - Timestamp

### Tabel: `contact_messages`

- `id` - Primary key
- `name` - Nama pengirim
- `email` - Email pengirim
- `subject` - Subjek pesan
- `message` - Isi pesan
- `status` - Status (new/read/replied)
- `created_at` - Timestamp

### Tabel: `news_articles` (optional)

- `id` - Primary key
- `title` - Judul artikel
- `slug` - URL-friendly slug
- `category` - Kategori berita
- `content` - Konten artikel
- `author_id` - Foreign key ke users
- `published_at` - Timestamp

## 🔐 Akses Admin

Tidak ada akun admin default. Akun baru dari halaman registrasi selalu memiliki
peran `user`. Setelah mengimpor database, jadikan akun yang sudah ada sebagai
admin secara manual melalui phpMyAdmin atau MySQL:

```sql
-- Untuk database lama yang belum memiliki kolom role, jalankan sekali:
ALTER TABLE users
    ADD COLUMN role ENUM('user', 'admin') NOT NULL DEFAULT 'user';

-- Ganti alamat email dengan email akun yang akan diberi akses admin:
UPDATE users SET role = 'admin' WHERE email = 'email-admin-anda@example.com';
```

Jika database baru dibuat dari `database/arenagame.sql`, kolom `role` sudah
tersedia sehingga cukup jalankan perintah `UPDATE`. Login admin tersedia di
`/ArenaGame/admin/login.php`. URL login dapat dibuka, tetapi dashboard dan
konten admin memerlukan sesi akun berperan `admin`; login user biasa tidak
memberikan akses. Jangan memberikan peran admin kepada akun publik.

## 🎨 Teknologi yang Digunakan

- **Frontend**:

  - HTML5
  - Tailwind CSS (via CDN)
  - JavaScript (Vanilla)
  - Google Fonts (Inter)

- **Backend**:
  - PHP 7.4+
  - MySQLi
  - Password Hashing (bcrypt)

## 📱 Fitur Responsive

Website ini fully responsive dengan breakpoints:

- Mobile: < 768px
- Tablet: 768px - 1024px
- Desktop: > 1024px

## 🛡️ Security Features

- ✅ Password hashing dengan `password_hash()`
- ✅ Input sanitization
- ✅ SQL injection prevention (prepared statements)
- ✅ XSS prevention (`htmlspecialchars`)
- ✅ Email validation
- ✅ CSRF protection ready (dapat ditambahkan)

## 📝 Form Validation

### Contact Form

- Nama: Required, min 1 karakter
- Email: Required, valid email format
- Subjek: Required
- Pesan: Required, min 10 karakter

### Login Form

- Email: Required, valid email format
- Password: Required, min 6 karakter

### Register Form

- Nama: Required, min 3 karakter
- Username: Required, min 4 karakter, alphanumeric + underscore, unique
- Email: Required, valid email format, unique
- Password: Required, min 6 karakter
- Confirm Password: Must match password

### Profile Update Form

- Nama: Required, min 3 karakter
- Username: Required, min 4 karakter, alphanumeric + underscore, unique
- Email: Required, valid email format, unique
- Password Baru: Optional, min 6 karakter jika diisi

## 🚀 Future Enhancements

- [x] Admin login & dashboard dengan pembatasan peran
- [ ] News article CRUD
- [ ] Comment system
- [ ] User avatar upload
- [ ] Newsletter subscription
- [ ] Social media authentication
- [ ] Email notification
- [ ] File upload untuk artikel
- [ ] Search functionality
- [x] Bookmark/favorite articles
- [ ] User activity tracking

## 👥 Developer

**Harsya Vil'ardi**

- NIM: 23552011037
- Role: Lead Developer
- Full-stack developer yang membangun platform ArenaGame dari awal hingga akhir.

## 📞 Kontak

- Email: info@arenagame.com
- Website: http://localhost/ArenaGame
- Support: support@arenagame.com

## 📄 Lisensi

Project ini dibuat untuk keperluan ujian/pembelajaran.

---

**© 2025 ArenaGame.com - Portal Esports Indonesia**
