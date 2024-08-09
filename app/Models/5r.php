<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
    ];
}
