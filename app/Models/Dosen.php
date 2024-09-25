<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;
    protected $table = 'dosen';

    protected $fillable = [
        'user_id', 'kode_dosen', 'nip','name', 'jenis_dosen', 
    ];
    public $timestamps = false;

    public function requests()
    {
        return $this->hasMany(Request::class, 'kelas_id');
    }

    public function user()
    {
        return $this->belongsTo(Dosen::class);
    }

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'kelas_dosen','dosen_id','kelas_id');
    }

    public function kelasPivot()
    {
        return $this->belongsToMany(Kelas::class, 'kelas_dosen');
    }

    public function mahasiswaPivot()
    {
        return $this->belongsToMany(Mahasiswa::class, 'kelas_mahasiswa');
    }
}
