<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Prodi extends Model
{
    use HasFactory, Sluggable;

    public $table = 'prodi';
    protected $guarded = ['id'];


    public function biaya()
    {
        return $this->hasOne(Biaya::class);
    }

    public function getGetVisiAttribute(){
        $visi = explode("•", $this->visi);
        
        return $visi;
    }

    public function getGetMisiAttribute(){
        $misi = explode('•', $this->misi);

        return $misi;
    }
    
    public function getGetFotoAttribute()
    {
        return asset('storage/prodi/'. $this->foto);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama'
            ]
        ];
    }
}
