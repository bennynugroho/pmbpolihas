<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    use HasFactory;

    public $table = 'akun_kontak';
    protected $guarded = ['id'];
    public $timestamps = false;
}
