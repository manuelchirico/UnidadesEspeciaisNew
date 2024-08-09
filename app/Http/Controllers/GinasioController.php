<?php

namespace App\Http\Controllers;

use App\Models\Ginasio;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;



class GinasioController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'entidade' => 'required',
            'nome_instituicao' => 'nullable',
            'nome_ocupante' => 'required',
            'tipo_evento' => 'required',
            'data_evento' => 'required|date',
            'hora_inicio' => 'required',
            'hora_fim' => 'required',
            'contacto' => 'required',
            'responsavel' => 'nullable',
        ]);

        $dataEvento = strtotime($request->data_evento);
        $horaInicio = strtotime($request->hora_inicio);
        $horaFim = strtotime($request->hora_fim);

        // Calcular o tempo total em horas
        $tempoTotalHoras = ($horaFim - $horaInicio) / 3600;

        // Calcular o número de dias
        $numeroDias = ceil($tempoTotalHoras / 24);

        // Calcular o pagamento com base no número de dias
        $pagamento = 50000;

        Ginasio::create([
            'entidade' => $request->entidade,
            'nome_instituicao' => $request->nome_instituicao,
            'nome_ocupante' => $request->nome_ocupante,
            'tipo_evento' => $request->tipo_evento,
            'data_evento' => $request->data_evento,
            'hora_inicio' => $request->hora_inicio,
            'hora_fim' => $request->hora_fim,
            'contacto' => $request->contacto,
            'responsavel' => $request->responsavel,
            'pagamento' => $pagamento,
        ]);

        return redirect()->route('ginasio.index')->with('success', 'Evento criado com sucesso!');
    }

    public function create()
    {
        return view('ginasio.create');
    }

    public function index(Request $request)
    {
        // Filtro opcional por mês
        $query = Ginasio::query();

        if ($request->has('month')) {
            $month = $request->input('month');
            $query->whereMonth('data_evento', '=', date('m', strtotime($month)))
                  ->whereYear('data_evento', '=', date('Y', strtotime($month)));
        }

        $ginasios = $query->paginate(10);

        return view('ginasio.index', compact('ginasios'));
    }

    public function edit($id)
    {
        $ginasio = Ginasio::findOrFail($id);
        return response()->json($ginasio);
    }


    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'entidade' => 'required',
            'nome_instituicao' => 'nullable',
            'nome_ocupante' => 'required',
            'tipo_evento' => 'required',
            'data_evento' => 'required|date',
            'hora_inicio' => 'required',
            'hora_fim' => 'required',
            'contacto' => 'required',
            'responsavel' => 'nullable',
        ]);

        $ginasio = Ginasio::findOrFail($id);

        $dataEvento = strtotime($request->data_evento);
        $horaInicio = strtotime($request->hora_inicio);
        $horaFim = strtotime($request->hora_fim);

        // Calcular o tempo total em horas
        $tempoTotalHoras = ($horaFim - $horaInicio) / 3600;

        // Calcular o número de dias
        $numeroDias = ceil($tempoTotalHoras / 24);

        // Calcular o pagamento com base no número de dias
        $pagamento = 50000;

        $ginasio->update([
            'entidade' => $request->entidade,
            'nome_instituicao' => $request->nome_instituicao,
            'nome_ocupante' => $request->nome_ocupante,
            'tipo_evento' => $request->tipo_evento,
            'data_evento' => $request->data_evento,
            'hora_inicio' => $request->hora_inicio,
            'hora_fim' => $request->hora_fim,
            'contacto' => $request->contacto,
            'responsavel' => $request->responsavel,
            'pagamento' => $pagamento,
        ]);

        return redirect()->route('ginasio.index')->with('success', 'Evento atualizado com sucesso.');
    }

    public function destroy($id)
    {
        $ginasio = Ginasio::findOrFail($id);
        $ginasio->delete();

        return redirect()->route('ginasio.index')->with('success', 'Evento apagado com sucesso.');
    }




    public function generatePDF(Request $request)
{
    ini_set('max_execution_time', 120); // Aumenta o tempo máximo de execução

    $month = $request->input('month');

    $query = Ginasio::query();
    
    if ($month) {
        $query->whereMonth('data_evento', '=', date('m', strtotime($month)))
              ->whereYear('data_evento', '=', date('Y', strtotime($month)));
    }

    // Obter os dados dos ginásios
    $ginasios = $query->get();
    
    // Configurar as opções do Dompdf
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isPhpEnabled', false);
    $options->set('isRemoteEnabled', true);
    
    // Instanciar o Dompdf com as opções configuradas
    $dompdf = new Dompdf($options);
    
    // Configurar a orientação do papel como paisagem
    $dompdf->setPaper('A4', 'landscape');
    
    // HTML da tabela
    $html = view('ginasio.pdf', compact('ginasios', 'month'))->render();
    
    // Carregar o HTML no Dompdf
    $dompdf->loadHtml($html);
    
    // Renderizar o PDF
    $dompdf->render();
    
    // Retornar a resposta com o PDF para download
    return $dompdf->stream('relatorio_ginasios.pdf');
}
    





}
