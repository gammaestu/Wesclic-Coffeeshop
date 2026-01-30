Panduan Setup Project Laravel
Persyaratan

Pastikan sudah terinstall:

PHP

Composer

Node.js & NPM

Database (MySQL / dll)

Instalasi & Setup
composer install
npm install


Copy file environment:

cp .env.example .env


Edit file .env dan sesuaikan konfigurasi database:

DB_DATABASE=nama_database
DB_USERNAME=username
DB_PASSWORD=password


Generate application key:

php artisan key:generate


Migrasi dan seeding database:

php artisan migrate:fresh --seed


Buat symbolic link storage:

php artisan storage:link

Menjalankan Project

Jalankan asset frontend:

npm run dev


Jalankan server Laravel:

php artisan serve


Akses aplikasi di browser:

http://127.0.0.1:8000
