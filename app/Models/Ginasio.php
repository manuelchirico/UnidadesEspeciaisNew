<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ginasio extends Model
{
    protected $fillable = [
        'entidade',
        'nome_instituicao',
        'nome_ocupante',
        'tipo_evento',
        'data_evento',
        'hora_inicio',
        'hora_fim',
        'contacto',
        'responsavel',
        'pagamento',
    ];
}
