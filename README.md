# 📝 UJIAN AI – Aplikasi Ujian Berbasis AI

Aplikasi ini memungkinkan Guru untuk **membuat soal ujian otomatis dengan AI**, dan Murid dapat **mengerjakannya langsung secara online**. Soal dibuat berdasarkan jenjang, kelas, dan mata pelajaran sesuai **Kurikulum Merdeka**.

---

## 🔐 Login Sebagai Guru

- **Email:** `admin@gmail.com`  
- **Password:** `123`

---

## 🧑‍🏫 Langkah Guru untuk Membuat Ujian

1. Masuk ke menu **"Data Ujian"**
2. Klik tombol **"Buat Ujian"**
3. Isi formulir berikut:
   - Jenjang Sekolah (SD, SMP, SMA, dll)
   - Kelas
   - Mata Pelajaran
   - Jumlah Soal
   - Nilai Minimal Lulus
4. Klik **"Generate Soal Ujian"**  
   Aplikasi akan menggunakan AI untuk membuat soal pilihan ganda lengkap dengan jawaban.
5. Klik **"Simpan"**
6. Setelah disimpan, salin **kode ujian** yang muncul — kode ini dibagikan ke Murid.

---

## 🎓 Langkah Murid untuk Mengerjakan Ujian

1. **Login / Register** terlebih dahulu
2. Masuk ke menu **"Kerjakan Ujian"**
3. Masukkan **kode ujian** yang diberikan oleh Guru
4. Ujian akan dimulai secara interaktif
5. Jawab semua soal
6. Setelah selesai, nilai dan pesan kesimpulan akan muncul (otomatis dari AI)

---

## 🤖 Fitur AI Otomatis

- Soal otomatis dibuat oleh AI berdasarkan kurikulum
- Penilaian otomatis berdasarkan jawaban siswa
- AI memberikan pesan evaluasi yang personal dan memotivasi

---

## 💡 Teknologi Digunakan

- Laravel + Livewire
- Bootstrap / TailwindCSS
- Replicate API (ibm-granite-3.3-8b-instruct)

---

## 🚀 Catatan Pengembangan

- Semua soal dan evaluasi bersifat otomatis
- Admin dapat melihat hasil dan statistik ujian

---

## 🧠 AI Support Explanation

Aplikasi ini memanfaatkan teknologi AI untuk dua hal utama:

1. **Generate Soal Ujian Otomatis**
   - Berdasarkan input dari form: jenjang pendidikan, kelas, mata pelajaran, jumlah soal, dan nilai minimal lulus.
   - AI akan menghasilkan soal pilihan ganda lengkap dengan jawaban yang relevan sesuai Kurikulum Merdeka.

2. **Membuat Summary Message (Evaluasi)**
   - Setelah siswa mengerjakan ujian, AI akan menganalisis hasilnya.
   - AI memberikan pesan evaluatif yang personal, menjelaskan area yang perlu ditingkatkan atau diperbaiki oleh siswa.
   - Bahasa yang digunakan ramah, memotivasi, dan menyerupai bimbingan seorang guru.

Teknologi AI yang digunakan: `ibm-granite-3.3-8b-instruct` melalui layanan Replicate API.