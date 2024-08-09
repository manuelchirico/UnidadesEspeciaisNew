<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'nome',
        'tipo',
        'numero_celular',
        'email',
        'password', // Campo correto para senha
    ];

    protected $hidden = [
        'password', // Campo correto para senha
        'remember_token',
    ];

    protected $table = 'usuarios';

    public function getAuthPassword()
    {
        return $this->password; // Campo correto para senha
    }
}