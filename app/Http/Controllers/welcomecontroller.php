<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campo;
use App\Models\Ginasio;
use App\Models\Reserva;
use App\Models\Receita;
use Carbon\Carbon;

class WelcomeController extends Controller
{
    public function index()
    {
        // Obtém o último e penúltimo pagamento da tabela "campos"
        $ultimoPagamentoCampo = Campo::orderBy('created_at', 'desc')->first();
        $penultimoPagamentoCampo = Campo::orderBy('created_at', 'desc')->skip(1)->first();

        // Calcula a variação percentual para "campos"
        $variacaoPercentualCampo = 0;
        if ($ultimoPagamentoCampo && $penultimoPagamentoCampo) {
            $variacaoPercentualCampo = (($ultimoPagamentoCampo->pagamento - $penultimoPagamentoCampo->pagamento) / $penultimoPagamentoCampo->pagamento) * 100;
        }

        // Obtém o último e penúltimo pagamento da tabela "ginasio"
        $ultimoPagamentoGinasio = Ginasio::orderBy('created_at', 'desc')->first();
        $penultimoPagamentoGinasio = Ginasio::orderBy('created_at', 'desc')->skip(1)->first();

        // Calcula a variação percentual para "ginasio"
        $variacaoPercentualGinasio = 0;
        if ($ultimoPagamentoGinasio && $penultimoPagamentoGinasio) {
            $variacaoPercentualGinasio = (($ultimoPagamentoGinasio->pagamento - $penultimoPagamentoGinasio->pagamento) / $penultimoPagamentoGinasio->pagamento) * 100;
        }

 // Obtém o último e penúltimo pagamento da tabela "reservas"
 $ultimaReserva = Reserva::orderBy('created_at', 'desc')->first();
 $penultimaReserva = Reserva::orderBy('created_at', 'desc')->skip(1)->first();

 // Calcula a variação percentual para "reservas"
 $variacaoPercentualReserva = 0;
 if ($ultimaReserva && $penultimaReserva) {
     $variacaoPercentualReserva = (($ultimaReserva->valor_total - $penultimaReserva->valor_total) / $penultimaReserva->valor_total) * 100;
 }


 $dataAtual = now();
        $receitasMesAtual = Receita::whereYear('created_at', $dataAtual->year)
                                    ->whereMonth('created_at', $dataAtual->month)
                                    ->sum('valor_existente');

        // Obtém os valores de receita do mês anterior
        $mesAnterior = $dataAtual->subMonth();
        $receitasMesAnterior = Receita::whereYear('created_at', $mesAnterior->year)
                                      ->whereMonth('created_at', $mesAnterior->month)
                                      ->sum('valor_existente');

        // Calcula a variação percentual para "receitas"
        $variacaoPercentualReceita = 0;
        if ($receitasMesAnterior > 0) {
            $variacaoPercentualReceita = (($receitasMesAtual - $receitasMesAnterior) / $receitasMesAnterior) * 100;
        }



        $dataAtual = Carbon::now();
        $mesAtual = $dataAtual->format('m'); // Mês atual no formato numérico, ex: "06" para Junho
        $anoAtual = $dataAtual->format('Y'); // Ano atual

        // Calcular o somatório total de 'valor_existe' na tabela 'receitas'
        $totalValorExiste = Receita::sum('valor_existente');

        // Calcular as entradas do mês atual
        $entradasCamposMesAtual = Campo::whereYear('created_at', $anoAtual)
                                       ->whereMonth('created_at', $mesAtual)
                                       ->sum('pagamento');

        $entradasGinasioMesAtual = Ginasio::whereYear('created_at', $anoAtual)
                                          ->whereMonth('created_at', $mesAtual)
                                          ->sum('pagamento');

        $entradasReservasMesAtual = Reserva::whereYear('created_at', $anoAtual)
                                           ->whereMonth('created_at', $mesAtual)
                                           ->sum('valor_total');

        $entradasMesAtual = $entradasCamposMesAtual + $entradasGinasioMesAtual + $entradasReservasMesAtual;

        // Calcular as saídas do mês atual
        $saidasMesAtual = Receita::where('mes', $mesAtual)
                                 ->whereYear('created_at', $anoAtual)
                                 ->where('mes', 'saidas')
                                 ->sum('valor_existente');



        // Passa os dados para a view
        return view('dashboard', [
            'ultimoPagamentoCampo' => $ultimoPagamentoCampo,
            'variacaoPercentualCampo' => $variacaoPercentualCampo,
            'ultimoPagamentoGinasio' => $ultimoPagamentoGinasio,
            'variacaoPercentualGinasio' => $variacaoPercentualGinasio,
            'ultimaReserva' => $ultimaReserva,
            'variacaoPercentualReserva' => $variacaoPercentualReserva,
            'receitasMesAtual' => $receitasMesAtual,
            'variacaoPercentualReceita' => $variacaoPercentualReceita,

            'totalValorExiste' => $totalValorExiste,
            'entradasMesAtual' => $entradasMesAtual,
            'saidasMesAtual' => $saidasMesAtual,
        ]);
    }
}
