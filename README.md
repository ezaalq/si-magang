# 💼 Sistem Informasi Kegiatan Magang Mahasiswa (SI-MAGANG)

> *"Digitalisasi magang untuk generasi yang bergerak cepat."*  
> **SI-MAGANG** adalah aplikasi berbasis web yang dirancang untuk mempermudah pengelolaan kegiatan magang mahasiswa — mulai dari absensi, tugas, laporan akhir, hingga sertifikasi.  
> Dibangun menggunakan **Laravel 12** dan **Filament Admin Panel**, sistem ini menjadi jembatan kolaborasi antara mahasiswa, koordinator lapangan, perusahaan, dan dinas terkait.

---

## ⚡ Tech Stack

| Kategori | Teknologi |
|:----------|:------------|
| **Framework** | Laravel 12 (PHP 8+) |
| **Admin Panel** | Filament v3 |
| **Database** | MySQL / MariaDB |
| **Frontend** | Blade + Sneat Template |
| **Auth** | Manual Bikin Sendiri |
| **Storage** | Laravel Filesystem (Public Disk) |
| **Dependency Tools** | Composer, NPM, Artisan CLI |

---

## 🚀 Fitur Utama Untuk Mahasiswa

| Fitur | Deskripsi |
|:------|:-----------|
| 📊 **Dashboard** | Menyajikan ringkasan kegiatan, absensi, dan progress mahasiswa. |
| 🕒 **Absensi Magang** | Mahasiswa mengisi kehadiran harian yang dapat diverifikasi admin. |
| 📸 **Tugas & Kegiatan** | Upload dokumentasi kegiatan (foto, video, atau laporan kegiatan). |
| 🧾 **Laporan Akhir** | Mahasiswa mengunggah laporan akhir dalam format terstruktur. |
| 🏅 **Sertifikat Magang** | mahasiswa dapat mengunduh sertifikat hasil magang. |
| 🙋‍♂️ **Profil Pengguna** | Profil lengkap setiap pengguna dengan data personal dan aktivitas. |

---

## 🚀 Fitur Utama Untuk admin

| Fitur | Deskripsi |
|:------|:-----------|
| 📊 **Dashboard** | Menyajikan Data mahasiswa Magang. |
| 🕒 **Absensi Magang** | admin dapat mengisi kehadiran harian mahasiswa. |
| 📸 **Tugas & Kegiatan** | admin dapat mengedit dokumentasi kegiatan (foto, video, atau laporan kegiatan). |
| 🧾 **Laporan Akhir** | admin dapat mengecek Mahasiswa mengunggah laporan akhir atau tidak dan menyetujui atau tidak. |
| 🏅 **Sertifikat Magang** | Admin mengunggah dan mahasiswa dapat mengunduh sertifikat hasil magang. |
| 🙋‍♂️ **Profil Pengguna** | admin dapat mengganti Profil lengkap mahasiswa serta dapat menganti kategori mahasiswa. |
| 🙋‍♂️ **Lebih Lengkap** | Untuk Lebih lanjut silahkan cek pada admin filament |

---

## 🧭 Struktur Pengguna

| Role | Deskripsi Tugas |
|:------|:----------------|
| 👨‍💼 **Koordinator Lapangan** | Mengatur data mahasiswa, memverifikasi laporan, serta memantau kegiatan magang. |
| 🏢 **Perusahaan / Instansi** | Memberikan tugas, memantau aktivitas, dan menilai kinerja mahasiswa magang. |
| 🏛️ **Dinas Terkait** | Melakukan supervisi terhadap seluruh kegiatan magang serta menerbitkan sertifikat resmi. |
| 🎓 **Mahasiswa** | Melakukan absensi, mengunggah tugas & laporan, serta melihat nilai akhir dan sertifikat. |

---

## 🧩 Fitur Tambahan (Roadmap)

- 📅 **Notifikasi otomatis** untuk jadwal kegiatan & deadline laporan.  
- 💬 **Chat internal** antara mahasiswa dan pembimbing.  
- 🧾 **Export laporan ke PDF** untuk administrasi resmi.  
- 🔔 **Reminder harian absensi** via email atau notifikasi dashboard.  
- 📊 **Analitik performa magang** untuk dinas & perusahaan.

---

## ⚙️ Instalasi & Setup Lokal

### 1️⃣ Clone Repositori
```bash
git clone https://github.com/username/si-magang.git
cd si-magang

### 2️⃣ Install Dependensi
composer install
npm install && npm run build

### 3️⃣ Konfigurasi Environment
cp .env.example .env
php artisan key:generate

#### Edit file .env dan atur koneksi database sesuai kebutuhan kamu.

### 4️⃣ Migrasi & Seeder
php artisan migrate --seed

### 5️⃣ Jalankan Server Lokal
php artisan serve
```

### Akses sistem di:
🔗 http://127.0.0.1:8000

| Role                        | URL            | Email                                                     | Password |
| :-------------------------- | :------------- | :-------------------------------------------------------- | :------- |
| 🧑‍💼 **Admin (Filament)**     | `/admin/login` | [admin@example.com](mailto:admin@example.com)             | password |
| 🎓 **Mahasiswa**            | `/login`       | [mahasiswa@example.com](mailto:mahasiswa@example.com)     | password |
| 🏢 **Perusahaan**           | `/login`       | [perusahaan@example.com](mailto:perusahaan@example.com)   | password |
| 🏛️ **Dinas / Koordinator**  | `/login`       | [koordinator@example.com](mailto:koordinator@example.com) | password |


### 🖥️ Preview Antarmuka
Dashboard Admin (Filament)

Tampilan Mahasiswa (Sneat Template)

Form Absensi & Kegiatan

Laporan Akhir & Sertifikat

### 🧱 Struktur Folder Penting
```
si-magang/
├── app/
│   ├── Models/        # Model utama (Mahasiswa, Tugas, Absensi, dll)
│   ├── Http/Controllers/ # Logic utama aplikasi
│   ├── Filament/      # Resource dan halaman admin
│
├── database/
│   ├── migrations/    # Struktur database
│   ├── seeders/       # Data awal sistem
│
├── resources/
│   ├── views/         # Blade template mahasiswa
│   ├── js/ & css/     # Asset frontend
│
└── routes/
    ├── web.php        # Routing utama aplikasi
```

## 🧑‍💻 Kontributor
| Nama         | Peran                 | Kontak                                                                       |
| :----------- | :-------------------- | :--------------------------------------------------------------------------- |
| **HazelDev** | Developer & Architect | [GitHub](https://github.com/username) / [Email](mailto:hazeldev@example.com) |

## 🧠 Lisensi

Proyek ini dilindungi oleh MIT License.
Kamu bebas menggunakan, memodifikasi, dan mengembangkan proyek ini,
asalkan tetap memberikan kredit kepada pengembang asli.

MIT License © 2025 HazelDev
Permission is hereby granted, free of charge, to any person obtaining a copy
of this software to deal in the Software without restriction.

## 🌟 Dukung Proyek Ini

Kalau kamu suka proyek ini, bantu dengan:
Memberi ⭐ di repositori GitHub
Menggunakan dan mengembangkan SI-MAGANG di instansi atau kampus kamu
Menyebarkan semangat digitalisasi magang ke lebih banyak mahasiswa 🚀

## 🐦‍🔥 Harapan
“SI-MAGANG bukan cuma aplikasi, tapi gerakan menuju sistem magang yang transparan, efisien, dan berdaya.”
— Made with ❤️ by HazelDev | Akhbar Hidayat