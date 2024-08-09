<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Funcionario extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'nome', 'email', 'contacto', 'tipo', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
