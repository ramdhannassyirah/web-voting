# Web Voting dengan Laravel

## Pendahuluan
Proyek ini adalah aplikasi web voting berbasis Laravel yang memungkinkan pengguna untuk memberikan suara pada opsi yang tersedia dalam suatu polling. Aplikasi ini dirancang untuk mudah digunakan dan dapat disesuaikan dengan kebutuhan.

## Fitur
- Registrasi dan login pengguna
- Buat, edit, dan hapus polling
- Beri suara dalam polling yang tersedia
- Lihat hasil voting secara real-time
- Manajemen pengguna (admin)
- Middleware untuk perlindungan akses

## Instalasi
1. Clone repositori ini:
   ```sh
   git clone https://github.com/username/web-voting-laravel.git
   cd web-voting-laravel
   ```

2. Instal dependensi dengan Composer:
   ```sh
   composer install
   ```

3. Salin file `.env.example` menjadi `.env`:
   ```sh
   cp .env.example .env
   ```

4. Atur konfigurasi database di file `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nama_database
   DB_USERNAME=username_database
   DB_PASSWORD=password_database
   ```

5. Generate key aplikasi:
   ```sh
   php artisan key:generate
   ```

6. Jalankan migrasi database:
   ```sh
   php artisan migrate --seed
   ```
   Opsi `--seed` digunakan untuk mengisi data awal.

7. Jalankan server aplikasi:
   ```sh
   php artisan serve
   ```
   Akses aplikasi di `http://127.0.0.1:8000`

## Penggunaan
1. Registrasi pengguna atau login sebagai admin.
2. Buat polling baru dari dashboard admin.
3. Bagikan polling kepada pengguna.
4. Pengguna memberikan suara.
5. Lihat hasil voting secara real-time.

## Build Frontend
Jika menggunakan Vite atau Laravel Mix:
```sh
npm install
npm run dev
```
Untuk produksi:
```sh
npm run build
```

## Kontribusi
Silakan fork repositori ini dan ajukan pull request untuk kontribusi lebih lanjut.

## Lisensi
Proyek ini dirilis di bawah lisensi MIT.

---
Dikembangkan dengan ❤️ menggunakan Laravel.

