## 🖼️ Tampilan Aplikasi Hadirin

### 🏠 Halaman Home
![Tampilan Home](https://github.com/Ashshiddqi/Hadirin/blob/main/public/doc/homepage.jpg?raw=true)

### 👤 Halaman User Management
![Tampilan Halaman User Management](https://github.com/Ashshiddqi/Hadirin/blob/main/public/doc/user%20management.jpg?raw=true)

### 📝 Halaman Event Management[
![Tampilan Halaman Event Management](https://github.com/Ashshiddqi/Hadirin/blob/main/public/doc/event%20management.jpg?raw=true)

### 🆔 Halaman Generate ID Anggota
![Tampilan Halaman Generate ID](https://github.com/Ashshiddqi/Hadirin/blob/main/public/doc/generate%20id%20anggota.jpg?raw=true)

### 📷 Halaman Scan Kehadiran
![Tampilan Halaman Scan Kehadiran](https://github.com/Ashshiddqi/Hadirin/blob/main/public/doc/scan%20qr.jpg?raw=true)

### 📆 Halaman Print Kehadiran Harian
![Tampilan Halaman Print Kehadiran Harian](https://github.com/Ashshiddqi/Hadirin/blob/main/public/doc/kehadiran%20harian.jpg?raw=true)

### 🗓️ Halaman Print Kehadiran Bulanan
![Tampilan Halaman Print Kehadiran Bulanan](https://github.com/Ashshiddqi/Hadirin/blob/main/public/doc/IMG-20250607-WA0020.jpg?raw=true)

### 🖨️ Halaman Print ID Anggota
![Tampilan Halaman Print ID Anggota](https://github.com/Ashshiddqi/Hadirin/blob/main/public/doc/cetak%20kartu%20anggota.jpg?raw=true)

## ⚙️ cara menjalankan project

### 1. Clone project
```bash
git clone https://github.com/Ashshiddqi/Hadirin.git
cd hadirin
```
### 2. Copy file .env.example
```bash
copy .env.example .env
```
### 3. Setup database pada komputer anda, lalu masukkan kredensial-kredensialnya ke file .env.
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_hadirin
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Install dependency
```bash
composer install
```

### 5. Generate application key
```bash
php artisan key:generate
```
### 6. Link storage untuk file upload
```bash
php artisan storage:link
```
### 7. Migrasi database
```bash
php artisan migrate
```
### 8. Jalankan aplikasi
```bash
php artisan serve
```
