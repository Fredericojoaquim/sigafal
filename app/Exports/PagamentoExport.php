<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Facades\DB; 

class PagamentoExport implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    private $data1;
    private $data2;
    private $pg;
    private $multas;
    private $total;

    public function __construct()
    {
        $this->data1= $_SESSION['datainicio'];
        $this->data2=  $_SESSION['datafim'];
        $this->pg=DB::table('clientepagamentos')
        ->whereBetween('pagamentos.datapagamento',[ $this->data1, $this->data2])
        ->join('clientes','clientepagamentos.cliente_id','=','clientes.id')
        ->join('pagamentos','pagamentos.id','=','clientepagamentos.pagamento_id')
        ->join('pts','pts.id','=','clientes.pt_id')
        ->select('clientes.nome as cliente','clientes.nif as nif', 'clientepagamentos.ano','clientepagamentos.mes','pagamentos.datapagamento as data','clientepagamentos.estado as estado','pagamentos.datapagamento as data','pagamentos.modopagamento as modo','pagamentos.id as id','clientepagamentos.id as idpagamento', 'clientepagamentos.multa as multa','pts.localizacao as pt', 'clientes.morada as morada', 'clientepagamentos.valor')
        ->orderBy('clientepagamentos.id','asc')
        ->get();

       

        
    }
    public function view():View{
       
       

        return view('relatorios.extratopagamentoexcel',['pg'=>$this->pg]);
    }
    
}
