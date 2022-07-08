<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    public    $table      = 'kelas';
    protected $guarded    = ['id'];
    public    $timestamps = false;

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    public function pendaftar()
    {
        return $this->hasMany(Pendaftar::class, 'kelas1_id');
    }
}
