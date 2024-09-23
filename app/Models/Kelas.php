<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $table = 'kelas';
    //mapping kolom atau field
    protected $fillable = [
        'id','name', 'jumlah', 
    ];
    public $timestamps = false;

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'kelas_id');
    }

    public function jumlahMahasiswa()
    {
        return $this->mahasiswa()->count();
    }

    public function dosen()
    {
        return $this->belongsToMany(Dosen::class, 'kelas_dosen');
    }

    public function mahasiswaPivot()
    {
        return $this->belongsToMany(Mahasiswa::class, 'kelas_mahasiswa');
    }
}
