<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class InfoPendaftaran extends Model
{
    use HasFactory;
    protected $table       = 'info_daftar';
    protected $guarded     = ['id'];
    public    $timestamps = false;

    public function getGetTanggalAwalAttribute()
    {
        return Carbon::parse($this->tgl_awal_daftar)->locale('id')->isoFormat('DD MMMM YYYY');
    }

    public function getGetTanggalAkhirAttribute()
    {
        return Carbon::parse($this->tgl_akhir_daftar)->locale('id')->isoFormat('DD MMMM YYYY');
    }

    public function getGetTanggalBayarAttribute()
    {
        return Carbon::parse($this->terakhir_pembayaran)->locale('id')->isoFormat('DD MMMM YYYY');
    }
}
