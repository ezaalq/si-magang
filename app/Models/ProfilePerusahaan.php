<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// ProfilePerusahaan Model
class ProfilePerusahaan extends Model
{
    use HasFactory;

    protected $table = 'profile_perusahaan';

    protected $fillable = [
        'nama_perusahaan',
        'logo',
        'alamat',
        'telepon',
        'email',
        'website',
        'deskripsi',
        'direktur',
        'pembimbing_lapangan',
    ];
}
