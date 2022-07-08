<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SumberInfo extends Model
{
    use HasFactory;
    public    $table      = 'sumber_info';
    protected $guarded    = ['id'];
    public    $timestamps = false;
}
