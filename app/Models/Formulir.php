<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formulir extends Model
{
    use HasFactory;
    public    $table      = 'formulir';
    protected $guarded    = ['id'];
    public    $timestamps = false;

    public function getGetPathAttribute()
    {
        if($this->path){
            return asset('/storage/formulir/'. $this->path);
        }else{
            return asset('');
        }
    }
}
