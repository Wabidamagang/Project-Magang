<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $table = 'mahasiswa';
    
    protected $fillable = [
        'user_id', 'kelas_id', 'nim','name','tempat_lahir','tanggal_lahir','edit' 
    ];
    public $timestamps = false;

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function request()
    {
        return $this->hasMany(Request::class, 'mahasiswa_id');
    }

    public function user()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function kelasPivot()
    {
        return $this->belongsToMany(Kelas::class, 'kelas_mahasiswa');
    }

}
