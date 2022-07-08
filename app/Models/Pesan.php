<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Pesan extends Model
{
    use HasFactory;
    protected $table = 'pesan';
    protected $guarded = ['id'];
    
    public function balasan()
    {
        return $this->hasOne(Balasan::class);
    }
    
    public function getGetTanggalPesanAttribute()
    {
        return Carbon::parse($this->tgl_pesan)->locale('id')->isoFormat('DD MMMM YYYY');
    }
}
