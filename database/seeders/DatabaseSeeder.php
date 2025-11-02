<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\ProfilePerusahaan;
use App\Models\TugasKegiatanHarian;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin User
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@magang.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Mahasiswa Users
        $mahasiswa = [
            [
                'name' => 'akbar hidayat',
                'email' => 'akbar@student.com',
                'nim' => '231001022',
                'kategori' => 'photographer',
                'phone' => '081234567890',
                'address' => 'Jl. Mawar No. 123, Surabaya',
            ],
            [
                'name' => 'Eza al qodri',
                'email' => 'eza@student.com',
                'nim' => '231001023',
                'kategori' => 'videographer',
                'phone' => '081234567891',
                'address' => 'Jl. Melati No. 45, Surabaya',
            ],
            [
                'name' => 'qonita al adiba',
                'email' => 'qonita@student.com',
                'nim' => '231001024',
                'kategori' => 'prerelease',
                'phone' => '081234567892',
                'address' => 'Jl. Anggrek No. 78, Surabaya',
            ],
            [
                'name' => 'Yudistira',
                'email' => 'yudistira@student.com',
                'nim' => '231001025',
                'kategori' => 'prerelease',
                'phone' => '081234567892',
                'address' => 'Jl. Anggrek No. 78, Surabaya',
            ],
        ];

        foreach ($mahasiswa as $mhs) {
            User::create([
                'name' => $mhs['name'],
                'email' => $mhs['email'],
                'password' => Hash::make('password'),
                'role' => 'mahasiswa',
                'nim' => $mhs['nim'],
                'kategori' => $mhs['kategori'],
                'phone' => $mhs['phone'],
                'address' => $mhs['address'],
            ]);
        }

        // Profile Perusahaan
        ProfilePerusahaan::create([
            'nama_perusahaan' => 'INFORMASI KOMUNIKASI DAN PENYIARAN',
            'alamat' => 'Jl. Udayana No.14, Monjok Bar., Kec. Selaparang, Kota Mataram, Nusa Tenggara Bar. 83122',
            'telepon' => '(0370) 644264',
            'email' => 'diskominfotik.ntb@gmail.com',
            'website' => 'https://data.ntbprov.go.id/',
            'deskripsi' => 'DISKOMINFOTIK NTB adalah singkatan dari Dinas Komunikasi, Informatika, Persandian, dan Statistik Provinsi Nusa Tenggara Barat.
            Instansi ini bertugas untuk melaksanakan urusan pemerintahan di bidang komunikasi, informatika, persandian, dan statistik,
            serta membantu Gubernur dalam menyelenggarakan kewenangan di bidang-bidang tersebut.
            Tujuannya adalah untuk membangun NTB yang makmur melalui informasi dan komunikasi yang baik.',
            'direktur' => 'H. Yusron Hadi, S.T., M.UM',
            'pembimbing_lapangan' => 'Bang Edo',
        ]);

        // Sample Tugas Kegiatan Harian
        $tugas = [
            [
                'judul_tugas' => 'Dokumentasi Event Peluncuran Produk',
                'deskripsi' => 'Mengambil foto dokumentasi acara peluncuran produk baru perusahaan',
                'kategori' => 'photographer',
                'tanggal_mulai' => now(),
                'tanggal_selesai' => now()->addDays(7),
            ],
            [
                'judul_tugas' => 'Editing Video Company Profile',
                'deskripsi' => 'Mengedit video company profile untuk keperluan promosi',
                'kategori' => 'videographer',
                'tanggal_mulai' => now(),
                'tanggal_selesai' => now()->addDays(10),
            ],
            [
                'judul_tugas' => 'Persiapan Siaran Pers',
                'deskripsi' => 'Menyusun dan menyiapkan materi siaran pers untuk media massa',
                'kategori' => 'prerelease',
                'tanggal_mulai' => now(),
                'tanggal_selesai' => now()->addDays(5),
            ],
        ];

        foreach ($tugas as $t) {
            TugasKegiatanHarian::create($t);
        }
    }
}
