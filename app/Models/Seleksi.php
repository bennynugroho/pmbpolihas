<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seleksi extends Model
{
    use HasFactory;

    public $table = 'seleksi';
    protected $guarded = ['id'];
    
    public function daftar()
    {
        return $this->belongsTo(Pendaftar::class, 'daftar_id');
    }
    
    public function tahun_akademik()
    {
        return $this->belongsTo(TahunAkademik::class, 'thn_akd_id');
    }
}