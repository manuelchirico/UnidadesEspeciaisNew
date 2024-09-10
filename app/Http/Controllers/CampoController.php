<?php

namespace App\Http\Controllers;

use App\Models\Campo;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;

class CampoController extends Controller
{
    public function index(Request $request)
    {
        // Obtém o último pagamento da tabela "campos"
        $ultimoPagamentoCampo = Campo::orderBy('created_at', 'desc')->first();

        // Obtém o penúltimo pagamento da tabela "campos"
        $penultimoPagamentoCampo = Campo::orderBy('created_at', 'desc')->skip(1)->first();

        // Calcula a variação percentual
        $variacaoPercentual = 0;
        if ($ultimoPagamentoCampo && $penultimoPagamentoCampo) {
            $variacaoPercentual = (($ultimoPagamentoCampo->pagamento - $penultimoPagamentoCampo->pagamento) / $penultimoPagamentoCampo->pagamento) * 100;
        }

        // Filtra por mês, se necessário
        $query = Campo::query();
        if ($request->has('month')) {
            $month = $request->input('month');
            $query->whereMonth('data_evento', '=', date('m', strtotime($month)))
                  ->whereYear('data_evento', '=', date('Y', strtotime($month)));
        }
        
        // Paginação dos resultados
        $campos = $query->paginate(10);

        return view('campos.index', [
            'ultimoPagamentoCampo' => $ultimoPagamentoCampo,
            'variacaoPercentual' => $variacaoPercentual,
            'campos' => $campos,
            'month' => $request->input('month') // Passa o filtro de mês para a view, se existir
        ]);
    }

    public function store(Request $request)
    {
        // Valida e armazena o novo campo
        $request->validate([
            'data_evento' => 'required|date',
            'nome_instituicao' => 'required|string|max:255',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fim' => 'required|date_format:H:i',
            'observacao' => 'nullable|string',
        ]);

        // Calcula tempo_total e pagamento
        $horaInicio = strtotime($request->hora_inicio);
        $horaFim = strtotime($request->hora_fim);
        $tempoTotal = ($horaFim - $horaInicio) / 3600; // tempo total em horas
        $pagamento = $tempoTotal * 300;

        $campo = new Campo([
            'data_evento' => $request->data_evento,
            'nome_instituicao' => $request->nome_instituicao,
            'hora_inicio' => $request->hora_inicio,
            'hora_fim' => $request->hora_fim,
            'observacao' => $request->observacao,
            'tempo_total' => $tempoTotal,
            'pagamento' => $pagamento,
        ]);

        $campo->save();

        return redirect()->route('campos.index')->with('success', 'Evento criado com sucesso.');
    }
    public function edit($id)
    {
        $campo = Campo::find($id);
        return view('campos.edit', compact('campo'));
    }
    
    public function update(Request $request, Campo $campo)
    {
        // Validação dos dados do formulário
        $validatedData = $request->validate([
            'data_evento' => 'required|date',
            'nome_instituicao' => 'required|string|max:255',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fim' => 'required|date_format:H:i',
            'observacao' => 'nullable|string',
        ]);

        // Calcula tempo_total e pagamento
        $horaInicio = strtotime($request->hora_inicio);
        $horaFim = strtotime($request->hora_fim);
        $tempoTotal = ($horaFim - $horaInicio) / 3600; // tempo total em horas
        $pagamento = $tempoTotal * 300;

        // Atualização dos dados do campo
        $campo->update([
            'data_evento' => $request->data_evento,
            'nome_instituicao' => $request->nome_instituicao,
            'hora_inicio' => $request->hora_inicio,
            'hora_fim' => $request->hora_fim,
            'observacao' => $request->observacao,
            'tempo_total' => $tempoTotal,
            'pagamento' => $pagamento,
        ]);

        return redirect()->route('campos.index')->with('success', 'Evento atualizado com sucesso!');
    }

    public function destroy($id)
    {
        // Encontra e apaga o campo
        $campo = Campo::findOrFail($id);
        $campo->delete();

        return redirect()->route('campos.index')->with('success', 'Evento apagado com sucesso.');
    }

    public function generatePDF(Request $request)
    {
        ini_set('max_execution_time', 120); // Aumenta o tempo máximo de execução
        
        $month = $request->input('month');
        
        // Limita a quantidade de registros a serem processados (Ex: 1000)
        $query = Campo::query();
        
        if ($month) {
            $query->whereMonth('data_evento', '=', date('m', strtotime($month)))
                  ->whereYear('data_evento', '=', date('Y', strtotime($month)));
        }
        
        // Adiciona limite de registros para evitar sobrecarga
        $campos = $query->limit(1000)->get();
        
        // Gera o HTML a partir da view
        $html = view('campos.pdf', compact('campos', 'month'))->render();
        
        // Configurações do Dompdf
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        
        // Otimiza o cache e a renderização
        $options->set('isPhpEnabled', true); // Permite PHP para otimização de cache
        $options->set('debugPng', false); // Desativa depuração de PNG
        $options->set('debugKeepTemp', false); // Não mantém arquivos temporários
        
        // Inicializa o Dompdf com as opções
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        
        // Define a orientação do papel para paisagem
        $dompdf->setPaper('A4', 'landscape');
        
        // Renderiza o PDF
        $dompdf->render();
        
        // Retorna o PDF para download (com menos sobrecarga de download)
        return $dompdf->stream('relatorio_campos.pdf', ['Attachment' => false]); // Exibe sem forçar download imediato
    }
    

    public function create()
    {
        return view('campos.create');
    }
}