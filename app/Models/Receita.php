<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receita extends Model
{
    use HasFactory;

    protected $fillable = [
        'mes', 'reserva', 'ginasio', 'campo'
    ];


    public function getTotalEntradaAttribute()
    {
        return $this->reserva + $this->ginasio + $this->campo;
    }
}
