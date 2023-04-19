<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use HasFactory;
    protected $table = "token";
    protected $fillable = [
        'token_web',
        'token_verificacion_web',
        'Envio_user_id',
        'Token_user_id',
        'status',
    ];
}
