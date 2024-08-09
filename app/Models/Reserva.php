<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_ocupante',
        'casa_a_ocupar',
        'data_entrada',
        'data_saida',
        'numero_dias',
        'valor_total',
        'pagamento',
        'contacto'
    ];
}
