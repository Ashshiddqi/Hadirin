## 🖼️ Tampilan Aplikasi Hadirin

### 🏠 Halaman Home
![Tampilan Home](https://github.com/Ashshiddqi/Hadirin/blob/main/public/doc/homepage.jpg?raw=true)

### 👤 Halaman Input Anggota
![Tampilan Halaman Input Anggota](https://github.com/arditam/hadirin/blob/main/public/doc/input_anggota.jpg)

### 📝 Halaman Input Kegiatan
![Tampilan Halaman Input Kegiatan](https://github.com/arditam/hadirin/blob/main/public/doc/input_kegiatan.jpg)

### 🆔 Halaman Generate ID Anggota
![Tampilan Halaman Generate ID](https://github.com/arditam/hadirin/blob/main/public/doc/generate_id.jpg)

### 📷 Halaman Scan Kehadiran
![Tampilan Halaman Scan Kehadiran](https://github.com/arditam/hadirin/blob/main/public/doc/scan_kehadiran.jpg)

### 📆 Halaman Print Kehadiran Harian
![Tampilan Halaman Print Kehadiran Harian](https://github.com/arditam/hadirin/blob/main/public/doc/kehadiran_harian.jpg)

### 🗓️ Halaman Print Kehadiran Bulanan
![Tampilan Halaman Print Kehadiran Bulanan](https://github.com/arditam/hadirin/blob/main/public/doc/kehadiran_bulanan.jpg)

### 🖨️ Halaman Print ID Anggota
![Tampilan Halaman Print ID Anggota](https://github.com/arditam/hadirin/blob/main/public/doc/print_id_anggota.jpg)

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
DB_DATABASE=db_hadirin5
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
