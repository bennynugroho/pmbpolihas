<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Pendaftar extends Model
{
    use HasFactory;
    public    $table   = 'pendaftar';
    protected $guarded = ['id'];

    public function jalur()
    {
        return $this->belongsTo(JalurMasuk::class, 'jalur_id');
    }

    public function kelas1()
    {
        return $this->belongsTo(Kelas::class, 'kelas1_id');
    }

    public function kelas2()
    {
        return $this->belongsTo(Kelas::class, 'kelas2_id');
    }
    
    public function tahun_akd()
    {
        return $this->belongsTo(TahunAkademik::class, 'thn_akd_id');
    }

    public function getGetSumberInfoAttribute()
    {
        $sumber = explode(',', $this->sumber_info);
        $result = SumberInfo::whereIn('id', $sumber)->get();

        return $result;
    }

    public function getGetIdSumberInfoAttribute()
    {
        $sumber = explode(',', $this->sumber_info);

        return $sumber;
    }

    public function getGetFotoAttribute()
    {
        return asset('storage/pendaftar/'. $this->foto);
    }

    public function getGetTanggalDaftarAttribute()
    {
        return Carbon::parse($this->tgl_daftar)->locale('id')->isoFormat('DD MMMM YYYY');
    }

    public function getGetTanggalLahirAttribute()
    {
        return Carbon::parse($this->tanggal_lahir)->locale('id')->isoFormat('DD MMMM YYYY');
    }

    public function setSumberInfoAttribute($sumber)
    {
        $this->attributes['sumber_info'] = implode(',', $sumber);
    }
}
