# CookaBite Website

Proyek ini adalah landing page statis `cookabite.html` dengan backend PHP sederhana untuk menyimpan dan menampilkan rating/ulasan menggunakan MySQL.

## Isi Proyek

- `cookabite.html` - halaman utama yang berisi katalog produk, carousel best seller, testimonial, dan form review.
- `rating.php` - API backend untuk GET/POST review.
- `dbconfig.php` - konfigurasi koneksi database.
- `init_db.sql` - skrip SQL untuk membuat database dan tabel `reviews`.
- `.htaccess` - (opsional) konfigurasi Apache untuk menjadikan `cookabite.html` sebagai halaman utama.
- Gambar produk dan aset lainnya di folder root.

## Persyaratan Hosting

- Hosting yang mendukung PHP 7.4+ dan MySQL/MariaDB.
- Akses ke database MySQL dan kemampuan membuat database atau tabel.
- Domain / subdomain yang diarahkan ke folder proyek.

> **Catatan penting:** GitHub Pages hanya melayani file statis dan tidak menjalankan PHP. Jika Anda membuka situs dari GitHub Pages, fitur rating tidak akan berfungsi permanen — review hanya tersimpan lokal di browser Anda dan tidak akan muncul di perangkat lain.
>
> Untuk review yang dapat dilihat bersama, deploy ke hosting yang mendukung PHP + MySQL.

## Langkah Deploy

1. **Upload semua file** ke folder root domain Anda.
   - `cookabite.html`
   - `rating.php`
   - `dbconfig.php`
   - `init_db.sql`
   - `.htaccess`
   - semua file gambar (`*.jpg`, `*.jpeg`, `*.png`)

2. **Atur database MySQL**
   - Jalankan `init_db.sql` di server MySQL:
     ```bash
     mysql -u root -p < init_db.sql
     ```
   - Jika hosting menyediakan phpMyAdmin, impor `init_db.sql` di phpMyAdmin.

3. **Sesuaikan `dbconfig.php`**
   - Buka `dbconfig.php` dan ganti `user`, `pass`, `host`, dan `db` dengan data kredensial MySQL hosting Anda.

4. **Uji di browser**
   - Akses `https://your-domain.com/cookabite.html`.
   - Pastikan testimonial memuat dari server dan review dapat dikirim.

## Pengujian Lokal

Jika Anda ingin mencoba secara lokal sebelum deploy:

```bash
cd "c:\tugas html\petloop"
php -S localhost:8000
```

Lalu buka `http://localhost:8000/cookabite.html`.

## Troubleshooting

- Jika review tidak muncul:
  - pastikan `rating.php` dapat diakses di browser.
  - pastikan database `cookabite` dan tabel `reviews` sudah dibuat.
  - periksa kredensial di `dbconfig.php`.
- Jika gambar tidak muncul:
  - pastikan nama file persis sama, termasuk huruf besar/kecil.

## Struktur Database

Tabel `reviews` memiliki kolom:

- `id` INT AUTO_INCREMENT
- `nama` VARCHAR(255)
- `rating` TINYINT
- `ulasan` TEXT
- `created_at` TIMESTAMP

## File `.htaccess`

`.htaccess` akan membuat `cookabite.html` menjadi halaman utama jika server Apache menggunakannya.
