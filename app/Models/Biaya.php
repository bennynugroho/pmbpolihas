<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biaya extends Model
{
    use HasFactory;
    public    $table      = 'biaya';
    protected $guarded    = ['id'];
    public    $timestamps = false;

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }
    
    public function getGetUangPangkalAttribute()
    {
        return 'Rp '. number_format($this->uang_pangkal, 2, ',', '.');
    }
    
    public function getGetSppAttribute()
    {
        return 'Rp '. number_format($this->spp, 2, ',', '.');
    }
}
