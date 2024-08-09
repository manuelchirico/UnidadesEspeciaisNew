<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usuario extends Model implements Authenticatable
{
    use HasFactory;

    // Definindo os campos que podem ser atribuídos em massa
    protected $fillable = [
        'nome',
        'email',
        'senha'
    ];

    // Definindo o nome da tabela explicitamente
    protected $table = 'usuarios';

    // Ocultando o campo 'senha' ao serializar o modelo
    protected $hidden = [
        'senha',
    ];

    // Métodos obrigatórios da interface Authenticatable

    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->senha;
    }

    public function getRememberToken()
    {
        return null;
    }

    public function setRememberToken($value)
    {
        // Not implemented
    }

    public function getRememberTokenName()
    {
        return null;
    }

    // Implementação do método obrigatório ausente
    public function getAuthPasswordName()
    {
        return 'senha';
    }
}
