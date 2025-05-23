# Aplikasi TryOut - Pengerjaan Soal Sederhana

Aplikasi TryOut ini merupakan aplikasi web sederhana untuk pengerjaan soal ujian online dengan fitur lengkap seperti Login, Register, pengerjaan soal, melihat hasil, dan Logout.  
Aplikasi ini menggunakan JWT untuk autentikasi dan berkomunikasi dengan API backend yang sudah disediakan.

---

## Fitur

1. **Login**  
   Pengguna dapat masuk menggunakan email dan password yang sudah terdaftar. Sistem menggunakan JWT untuk autentikasi.

2. **Register**  
   Pengguna baru dapat mendaftar dengan mengisi nama, email, dan password.

3. **Pengerjaan Soal**  
   Pengguna dapat mengerjakan soal secara interaktif dengan navigasi soal sebelumnya dan berikutnya.

4. **Hasil**  
   Setelah selesai, pengguna dapat melihat hasil nilai dan detail jawaban.

5. **Logout**  
   Pengguna dapat keluar dari aplikasi dengan aman, menghapus token, dan kembali ke halaman login.

---

## Teknologi yang Digunakan

- **Frontend**  
  - HTML5, CSS3 (Bootstrap 5)  
  - JavaScript (Vanilla + jQuery)  
  - SweetAlert2 (alert interaktif)  
  - Toastr (notifikasi)  
  - js-loading-overlay (loading indicator)

- **Backend API**  
  - Sudah tersedia dan menggunakan JWT untuk autentikasi  
  - Menggunakan metode RESTful untuk komunikasi data

---

## Cara Penggunaan

1. Clone repositori ini:

   ```bash
   git clone https://github.com/Rzal2726/web-test-eksam.git
