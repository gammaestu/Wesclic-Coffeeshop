# Setup Project Laravel

Dokumen ini berisi panduan instalasi dan menjalankan project Laravel di lingkungan lokal.

---

## Persyaratan

Pastikan sudah terinstall:

- PHP
- Composer
- Node.js & NPM
- Database (MySQL / MariaDB / dll)

---

## Instalasi & Setup

### 1. Install Dependency Backend & Frontend

Jalankan perintah berikut di terminal pada folder project:

```bash
composer install
npm install
```

---

### 2. Copy File Environment

Copy file `.env.example` menjadi `.env`:

```bash
cp .env.example .env
```

Kemudian buka file `.env` dan sesuaikan konfigurasi database:

```env
DB_DATABASE=nama_database
DB_USERNAME=username
DB_PASSWORD=password
```

---

### 3. Generate Application Key

```bash
php artisan key:generate
```

---

### 4. Migrasi dan Seeding Database

```bash
php artisan migrate:fresh --seed
```

---

### 5. Buat Symbolic Link Storage

```bash
php artisan storage:link
```

---

## Menjalankan Project

### 1. Jalankan Asset Frontend

```bash
npm run dev
```

### 2. Jalankan Server Laravel

```bash
php artisan serve
```

---

## Akses Aplikasi

Buka browser dan akses:

```
http://127.0.0.1:8000
```

---

Project Laravel siap digunakan.
