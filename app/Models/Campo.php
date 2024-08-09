<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campo extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_evento',
        'nome_instituicao',
        'hora_inicio',
        'hora_fim',
        'observacao',
        'tempo_total',
        'pagamento',
    ];
}
