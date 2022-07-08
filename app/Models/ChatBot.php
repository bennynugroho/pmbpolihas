<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatBot extends Model
{
    use HasFactory;
    public $table = 'chat_bot';
    protected $guarded = ['id'];
    public $timestamps = false;
}
