<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// TugasKegiatanHarian Model
class TugasKegiatanHarian extends Model
{
    use HasFactory;

    protected $table = 'tugas_kegiatan_harian';

    protected $fillable = [
        'judul_tugas',
        'deskripsi',
        'kategori',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    public function tugasMahasiswa()
    {
        return $this->hasMany(TugasMahasiswa::class, 'tugas_id');
    }
}
