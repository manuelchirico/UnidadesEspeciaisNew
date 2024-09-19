<?php




namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;

use Dompdf\Dompdf;
use Dompdf\Options;

class ReservaController extends Controller
{
    public function create()
    {
        return view('residencia.entradas.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome_ocupante' => 'required|string|max:255',
            'casa_a_ocupar' => 'required|string',
            'data_entrada' => 'required|date',
            'data_saida' => 'required|date',
            'contacto' => 'required|string|max:255',
        ]);

        $dataEntrada = new \DateTime($validatedData['data_entrada']);
        $dataSaida = new \DateTime($validatedData['data_saida']);
        $intervalo = $dataEntrada->diff($dataSaida);
        $numeroDias = $intervalo->days;
        $valorTotal = $numeroDias * 1700;

        $validatedData['numero_dias'] = $numeroDias;
        $validatedData['valor_total'] = $valorTotal;
        $validatedData['pagamento'] = 'Pendente';

        Reserva::create($validatedData);
       

        return redirect()->route('residencia.entradas.list')->with('success', 'Reserva criada com sucesso!');
    }

    public function index(Request $request)
    {
        $query = Reserva::query()->where('pagamento', 'pendente');
    
        if ($request->has('month')) {
            $month = $request->input('month');
            $startDate = date('Y-m-01', strtotime($month));
            $endDate = date('Y-m-t', strtotime($month));
    
            $query->whereBetween('data_entrada', [$startDate, $endDate]);
        }
    
        $reservas = $query->paginate(10);
    
        return view('residencia.entradas.index', compact('reservas'));
    }

    public function pagas(Request $request)
    {

        $query = Reserva::query()->where('pagamento', 'pago');
    
        if ($request->has('month')) {
            $month = $request->input('month');
            $startDate = date('Y-m-01', strtotime($month));
            $endDate = date('Y-m-t', strtotime($month));
    
            $query->whereBetween('data_entrada', [$startDate, $endDate]);
        }
    
        $reservas = $query->paginate(10);
    
        return view('residencia.saida.index', compact('reservas'));

      

    }
    public function indexRelatorio()
    {
        return view('residencia.relatorio.index');
    }
    

    public function edit($id)
    {
        $reserva = Reserva::findOrFail($id);
        return view('residencia.entradas.edit', compact('reserva'));
    }

    public function update(Request $request, $id)
    {
        $reserva = Reserva::findOrFail($id);
    
        $reserva->nome_ocupante = $request->input('nome_ocupante');
        $reserva->casa_a_ocupar = $request->input('casa_a_ocupar');
        $reserva->data_entrada = $request->input('data_entrada');
        $reserva->data_saida = $request->input('data_saida');
        $reserva->contacto = $request->input('contacto');
        $reserva->pagamento = $request->input('pagamento');
    
        // Calcular número de dias e valor total
        $dataEntrada = new \DateTime($request->input('data_entrada'));
        $dataSaida = new \DateTime($request->input('data_saida'));
        $intervalo = $dataEntrada->diff($dataSaida);
        $numeroDias = $intervalo->days;
        $valorTotal = $numeroDias * 1700;
    
        $reserva->numero_dias = $numeroDias;
        $reserva->valor_total = $valorTotal;
    
        $reserva->save();
    
        return redirect()->route('residencia.entradas.list')->with('success', 'Reserva atualizada com sucesso');
    }
    
    public function destroy($id)
    {
        $reserva = Reserva::findOrFail($id);
        $reserva->delete();

        return redirect()->route('residencia.entradas.list')->with('success', 'Reserva excluída com sucesso!');
    }




  
   
    
    public function filtradas(Request $request)
    {
        // Recupere os parâmetros de filtro do request
        $pagamento = $request->input('pagamento');
        $data = $request->input('data');
        
        // Consulta inicial sem filtro
        $query = Reserva::query();
        
        // Aplicar filtro de pagamento, se fornecido
        if ($pagamento) {
            $query->where('pagamento', $pagamento);
        }
        
        // Aplicar filtro de data, se fornecido
        if ($data) {
            $query->whereDate('data_entrada', $data);
        }
        
        // Obter os resultados da consulta
        $reservas = $query->get();
        
        // Retornar a view com os dados filtrados
        return view('residencia.relatorio.index', compact('reservas'));
    }
    



    
    public function gerarPDF(Request $request)
{
    // Recuperar os parâmetros de filtro do request
    $pagamento = $request->input('pagamento');
    $data = $request->input('data');
    
    // Consulta inicial sem filtro
    $query = Reserva::query();
    
    // Aplicar filtro de pagamento, se fornecido
    if ($pagamento) {
        $query->where('pagamento', $pagamento);
    }
    
    // Aplicar filtro de data, se fornecido
    if ($data) {
        $query->whereDate('data_entrada', $data);
    }
    
    // Obter os resultados da consulta
    $reservas = $query->get();
    
    // Criar uma nova instância do Dompdf
    $dompdf = new Dompdf();
    
    // HTML da tabela
    $html = view('residencia.relatorio.pdf', compact('reservas'))->render();
    
    // Carregar o HTML no Dompdf
    $dompdf->loadHtml($html);
    
    // Renderizar o PDF
    $dompdf->render();
    
    // Retornar a resposta com o PDF para download
    return $dompdf->stream('relatorio_reservas.pdf');
}




}
