<?php


namespace App\Http\Controllers;

use App\Exports\PagamentoExport;
use Illuminate\Http\Request;
use App\Models\Pagamento;
use App\Models\Cliente;
use App\Models\Servico;
use App\Models\Pt;
use App\Models\ClientePagamento;
use App\Models\ContaCliente;
use App\Models\Operacao;
use App\Models\UltimoPagamento;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use DateTime;
use DatePeriod;
use DateInterval;
use Dompdf\Options;
use Maatwebsite\Excel\Facades\Excel;

    session_start();
   // use DateTime;
  

    class Dev{
        public int $codigo;
        public $nome;
        public $nif;
        public array $meses;
    
        public function __construct(){
            $this->codigo = 0; 
            $this->meses = [];
            $this->nome="";
            $this->nif="";
        }
    }

class PagamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pg=$this->todosdados();
       
    //  dd($cp);
       
        return view('admin.pagamentos',['pg'=>$pg]);
    }

    public function buscarCliente(Request $request){
        
        $cliente=DB::table('clientes')->where('clientes.id', $request->nif)
        ->join('servicos','clientes.servico_id','=','servicos.id')
        ->join('pts','clientes.pt_id','=','pts.id')
        ->select('clientes.*', 'servicos.descricao as servico','pts.localizacao as pt')->first();
       
        $cli=array($cliente);
       
        if(!is_null($cli[0])){
            $_SESSION['id_cliente'] = $request->nif;
            $c=Cliente::findOrFail($request->nif);
            $qtdMeses=$this->dividaaPagar($request->nif);
            return view("admin.codigofatura", [
                'cliente' => $cliente,
                'qtd'=>$qtdMeses,
                'valorPagar'=>$c->preco
                
            ]); 
        }
        
        $erro="Cliente não encontrado";
        $pg=$this->todosdados();
        return view('admin.pagamentos', ['erro'=>$erro, 'pg'=>$pg]);
 
    }


    public function buscarclienteId($id){
       
        $cliente=DB::table('clientes')->where('clientes.id',$id)
        ->join('servicos','clientes.servico_id','=','servicos.id')
        ->join('pts','clientes.pt_id','=','pts.id')
        ->select('clientes.*', 'servicos.descricao as servico','pts.localizacao as pt')->first();
       
        
        $cli=array($cliente);
       

        if(!empty($cli)){
            $_SESSION['id_cliente'] = $id;

            $c=Cliente::findOrFail($id);
           
            $qtdMeses=$this->dividaaPagar($id);
           
            return view("admin.codigofatura", [
                'cliente' => $cliente,
                'qtd'=>$qtdMeses,
                'valorPagar'=>$c->preco
                
            ]); 
        }
        $erro="Cliente não encontrado";
        $pg=$this->todosdados();
        return view('admin.pagamentos', ['erro'=>$erro, 'pg'=>$pg]);
    }



    public function pagamento(Request $request){
      //  $this->verificar_idDocumento($numero)
     //$p= Pagamento::where('id_docpagamento',$request->id_documento)->first();
     $pa=DB::table('pagamentos')
     ->where('id_docpagamento','=', $request->id_documento)
     ->where('nomebanco','=', $request->banco)
     ->get();

     $total=count($pa);
     if($total==0){
        $_SESSION['modo']=$request->modo_pagamento;
        $_SESSION['banco']=$request->banco;
        $_SESSION['qtd']=$request->qtd;
        $_SESSION['id_cliente']=$request->id_cliente;
        $_SESSION['valor_total']=$request->valor_total; 
        $_SESSION['id_documento']=$request->id_documento;
       
       return view('admin.dados_pagamento', [
            'qtd' => $_SESSION['qtd']
       ]);
    }
    $cliente=DB::table('clientes')->where('nif', $_SESSION['nif'])
    ->join('servicos','clientes.servico_id','=','servicos.id')
    ->join('pts','clientes.pt_id','=','pts.id')
    ->select('clientes.*', 'servicos.descricao as servico','pts.localizacao as pt')->first();

     return view('admin.pagamento', ['erro' => 'Esta referencia de pagamento ja foi registada','cliente' => $cliente
   ]);

    }


    public function retornaMes($mes){
        switch ($mes){
            case "01":
                return "Janeiro";
            
            case "02":
                return "Fevereiro";
            case "03":
                return "Março";
                
            case "04":
                return "Abril";
            case "05":
                return "Maio";
                    
            case "06":
                return "Junho";
            case "07":
                    return "Julho";
                
            case "08":
                return "Agosto";
            case "09":
                return "Setembro";
                    
            case "10":
                return "Outubro";
            case "11":
                return "Novembro";
                       
            case "12":
                return "Dezembro";
        }
    }



    public function numeroMes($mes){
        switch ($mes){
            case "Janeiro":
                return 1;
            
            case "Fevereiro":
                return 2;
            case "Março":
                return 3;
                
            case "Abril":
                return 4;
            case "Maio":
                return 5;
                    
            case "Junho":
                return 6;
            case "Julho":
                    return 7;
                
            case "Agosto":
                return 8;
            case "Setembro":
                return 9;
                    
            case "Outubro":
                return 10;
            case "Novembro":
                return 11;
                       
            case "Dezembro":
                return 12;
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
      
       $erros=array();
       $mensagem="";
        
        $u= Ultimopagamento::where('cliente_id',$_SESSION['id_cliente'])->get();
     
       // $p=new Pagamento();
        //verificar se é o primeiro pagamento
        if($this->isPrimeiroPagamento($_SESSION['id_cliente'])){
            $p=$this->retornaPagamento();
            $qtd=$p->qtd;
            //loop 
            for($i=0; $i<$qtd; $i++){
                $c=new ClientePagamento();
                $cont=$i+1;
                $ano= explode('-', $request["data".$cont]);
                $c->ano = $ano[0];
                $c->mes = $this->retornaMes($ano[1]);
               
                $multa=$this->moeda($request["valor_multa".$cont]);
                $valor=$this->moeda($request["preco".$cont]);
                $c->multa=$multa;
                $c->cliente_id = $_SESSION['id_cliente'];
                $c->estado='não verificado';
                $c->pagamento_id = $p->id;
                $c->valor =$valor;
                //salvar o pagamento
                $p->save();
                //salvar o cliente pagamento
                $c->pagamento_id=$p->id;
                $c->save();
                //update do ultimo pagamento
                $vector = ['data'=> $request["data".$cont]];
                Ultimopagamento::findOrFail($u[0]->id)->update($vector);
                $mensagem='Pagamento efectuado com sucesso!';
               
            }
            return view('admin.pagamentos',['erros'=>$erros,'pg'=>$this->todosdados(),'sms'=>$mensagem]);

        }else{
            //não é o primeiro pagamento

            //registar o pagamento
            $p=$this->retornaPagamento();
            $qtd=$p->qtd;

            for($i=0; $i<$qtd; $i++){
                $cont=$i+1;
                $ano_request= explode('-', $request["data".$cont]);
                $ano=$ano_request[0];
                $mes= $this->retornaMes($ano_request[1]);

                $cp=ClientePagamento::where('cliente_id',$_SESSION['id_cliente'])//vereificar se o pagamento ja
                ->where('ano',$ano)
                ->get();

                $size=count($cp);
                //verificar se o mês ja foi pago;
                $cpagamento=ClientePagamento::where('cliente_id',$_SESSION['id_cliente'])//vereificar se o pagamento ja
                ->where('mes', $mes)
                ->where('ano',$ano)
                ->get();

               $count=count($cpagamento);

                if($count>0){
                     //possui dividas nos meses do ano anterior
                     $erros[]=" O mês de: $mes de $ano, ja foi pago ";
                    
                     $p=DB::table('clientepagamentos')
                    ->join('clientes','clientepagamentos.cliente_id','=','clientes.id')
                    ->join('pagamentos','clientepagamentos.pagamento_id','=','pagamentos.id')
                    ->select('clientes.nome as cliente','clientes.nif as nif', 'clientepagamentos.mes','pagamentos.datapagamento as data','clientepagamentos.estado as estado','pagamentos.datapagamento as data','pagamentos.modopagamento as modo','pagamentos.id as id','clientepagamentos.id as idpagamento','clientepagamentos.ano as ano')
                    ->orderBy('clientes.id','desc')
                    ->get();
                     return view('admin.pagamentos',['erros'=>$erros,'pg'=>$p]);
                }

                if( $size==0){
                    //pagamento do inicio do ano (janeiro) logo verifico se não há divida nos meses do ano passado
                    
                    $ano=$ano-1;
                    $cp=ClientePagamento::where('cliente_id',$_SESSION['id_cliente'])//vereificar se o pagamento ja
                    ->where('ano',$ano)
                    ->get();
                    foreach($cp as $c){
                        $meses[]=$this->numeroMes($c->mes);
                    }
                    sort($meses);
                    //dd($meses);
                    $totalmeses=count($meses);
                    if($meses[$totalmeses-1]<>12){
                         //verificar se o mês ja foi pago
                         $cpagamento=ClientePagamento::where('mes', $mes)//vereificar se o pagamento ja
                        ->where('ano',$ano)
                        ->get();
                        if(is_null( $cpagamento)){
                             //possui dividas nos meses do ano anterior
                        $erros[]=" não é possivel efectuar o pagamento do mês de: $mes, pois o cliente possui divida no ano passado";
                        }else{
                            $erros[]="O mês de: $mes ja foi pago";
                        }
                       

                    }else{
                        //efectuar o pagamento aqui!!

                        $c=new ClientePagamento();
                        $cont=$i+1;
                        $ano= explode('-', $request["data".$cont]);
                        $c->ano = $ano[0];
                        $c->mes = $this->retornaMes($ano[1]);
                        //$c->multa=$request["multa".$cont];
                        $multa=$this->moeda($request["valor_multa".$cont]);
                        $c->multa=$multa;
                        $valor=$this->moeda($request["preco".$cont]);
    
                        $c->cliente_id = $_SESSION['id_cliente'];
                       
                        $c->estado='não verificado';
                        $c->valor =$valor;
                        //salvar o pagamento
                       //dd('entrou');
                        $p->save();
                        
                        $c->pagamento_id = $p->id;
                        //salvar o cliente pagamento
                        $c->save();
                        //update do ultimo pagamento
                        $vector = ['data'=> $request["data".$cont]];
                         Ultimopagamento::findOrFail($u[0]->id)->update($vector);
                         $mensagem='Pagamento efectuado com sucesso!';
                        return view('admin.pagamentos',['erros'=>$erros,'pg'=>$this->todosdados(),'sms'=>$mensagem]);
                    }

                }else{
                    //
                foreach($cp as $c){
                    $meses[]=$this->numeroMes($c->mes);
                }
                sort($meses);
                $ultimo_mes=$meses[count($meses)-1];
                //verificar se o mes a ser pago 
               
                if($this->numeroMes($mes)==($ultimo_mes+1)){
                    $c=new ClientePagamento();
                    $cont=$i+1;
                    $ano= explode('-', $request["data".$cont]);
                    $c->ano = $ano[0];
                    $c->mes = $this->retornaMes($ano[1]);
                    //$c->multa=$request["multa".$cont];
                    $multa=$this->moeda($request["valor_multa".$cont]);
                    $c->multa=$multa;
                    $valor=$this->moeda($request["preco".$cont]);

                    $c->cliente_id = $_SESSION['id_cliente'];
                    $c->pagamento_id = $p->id;
                    $c->estado='não verificado';
                    $c->valor =$valor;
                    //salvar o pagamento
                    $p->save();
                    //salvar o cliente pagamento
                    $c->pagamento_id = $p->id;
                    $c->save();
                     //update do ultimo pagamento
                     $mensagem='Pagamento efectuado com sucesso!';
                     $vector = ['data'=> $request["data".$cont]];
                     Ultimopagamento::findOrFail($u[0]->id)->update($vector);

                }else{
                    $mes_seguinte=$this->retornaMes($ultimo_mes+1);
                    $erros[]="o mês de:$mes, não deve ser pago, sem pagar o mês de:  $mes_seguinte";
                }
                //
                }
               

                
            }
          

         return view('admin.pagamentos',['erros'=>$erros,'pg'=>$this->todosdados(),'sms'=>$mensagem]);
        session_unset();
        session_destroy();

       
    }
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $valor=$this->moeda($request->valor);
        $multa=$this->moeda($request->multa);
        $s=[
            'valor'=>$valor,
            'multa'=>$multa
        ];
       // $request->id_pagamento;
        ClientePagamento::findOrFail($request->id_pagamento)->update($s);

        $pg=DB::table('clientepagamentos')
        ->join('clientes','clientepagamentos.cliente_id','=','clientes.id')
        ->join('pagamentos','clientepagamentos.pagamento_id','=','pagamentos.id')
        ->select('clientes.nome as cliente','clientes.nif as nif', 'clientepagamentos.mes','pagamentos.datapagamento as data','clientepagamentos.estado as estado','pagamentos.datapagamento as data','pagamentos.modopagamento as modo','pagamentos.id as id','clientepagamentos.id as idpagamento','clientepagamentos.ano as ano')
        ->orderBy('clientes.id','desc')
        ->get();

        return view ('admin.pagamentos',['pg'=>$pg,'sms'=> "Pagamento alterado com sucesso"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function pagamentoefetuado ($cliente_id, $mes,$ano){
        $cp=ClientePagamento::where('cliente_id',$cliente_id)//vereificar se o pagamento ja
        ->where('ano',$ano)
        ->where('mes',$mes)
        ->get();
        return is_null($cp);
    }

    public function aprovarPagamento(Request $request){
        
       
       
       $erros=array();
       $s=['estado'=>'verificado'];
       $p=ClientePagamento::findOrFail($request->id)->update($s);

        $pg=$this->todosdados();
      
      
       
        return view('admin.pagamentos',['pg'=>$pg, 'sms'=>'pagamento aprovado com sucesso']);

       



    }



    public function gerarfatura($id){

       // $p=ClientePagamento::findOrFail($id);
       /* $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $dompdf = new Dompdf($options);*/
        $pg=DB::table('clientepagamentos')
        ->where('pagamentos.id','=',$id)
        ->join('clientes','clientepagamentos.cliente_id','=','clientes.id')
        ->join('pts','clientes.pt_id','=','pts.id')
        ->join('pagamentos','clientepagamentos.pagamento_id','=','pagamentos.id')
        ->select('clientes.nome as cliente','clientes.nif as nif',
         'clientepagamentos.mes',
        'pagamentos.datapagamento as data',
        'clientepagamentos.estado as estado',
        'pagamentos.datapagamento as data',
        'pagamentos.modopagamento as modo',
        'clientes.morada as morada',
        'pts.localizacao as pt',
        'pagamentos.id as id',
        'clientepagamentos.id as idpagamento',
        'clientepagamentos.ano as ano',
        'clientepagamentos.multa as multa',
        'clientepagamentos.valorcaixa as caixa',
        'clientepagamentos.valorbanco as banco')
        ->get();
        $total=0;
        $multas=0;
        
        foreach($pg as $p){
            $total=$total+$p->caixa+$p->banco;
            $multas=$multas + $p->multa;

            
        }
        

        PDF::setOption(['isRemoteEnabled' => true]);
        $pdf=PDF::loadView('relatorios.fatura',['pg'=>$pg,'multas'=>$multas, 'total'=>$total]);
        return $pdf->setPaper('a4')->stream('fatura-recibo.pdf');

    }

    public function teste(){
        $p=ClientePagamento::findOrFail(3);
        return view('relatorios.fatura',['p'=>$p]);

    }

    public function recibos(){

        $pg=DB::table('clientepagamentos')
        ->join('clientes','clientepagamentos.cliente_id','=','clientes.id')
        ->join('pagamentos','pagamentos.id','=','clientepagamentos.pagamento_id')
        ->join('pts','pts.id','=','clientes.pt_id')
        ->select('clientes.nome as cliente','clientes.nif as nif', 'clientepagamentos.ano','clientepagamentos.mes','pagamentos.datapagamento as data','clientepagamentos.estado as estado','pagamentos.datapagamento as data','pagamentos.modopagamento as modo','pagamentos.id as id','clientepagamentos.id as idpagamento', 'clientepagamentos.multa as multa','pts.localizacao as pt', 'clientes.morada as morada', 'clientepagamentos.valor')
        ->orderBy('clientepagamentos.id','desc')
        ->get();

        return view('admin.recibos',['pg'=>$pg]);
    }


    public function mostarpagameto($id){
       

        $cp=ClientePagamento::findOrFail($id);
    

        $pg=$this->todosdados();
      
      
       
        return view('admin.pagamentoalterar',['pg'=>$pg, 'cp'=>$cp]);
      
    }


    public function moeda($v){
		$source=array('.',',');
		$replace=array('','.');
		$valor=str_replace($source, $replace, $v);
		return $valor;
		
	}

    //nova funcao
    public function detalhes($id){

        //Mostra todos dados de ClientePagamento
        $pg=$this->todosdados(); 

        //para mostrar detalhes de um ClientePagamento específico
        $detalhes=DB::table('clientepagamentos')->where('clientepagamentos.id', '=',$id)
        ->join('clientes','clientepagamentos.cliente_id','=','clientes.id')
        ->join('pagamentos','clientepagamentos.pagamento_id','=','pagamentos.id')
        ->join('users','users.id','=','pagamentos.user_id')
        ->select(
            'clientes.nome as cliente',
            'clientes.nif as nif',
            'clientepagamentos.id as idpagamento', 
            'clientepagamentos.mes as mes',
            'clientepagamentos.ano as ano',
            'clientepagamentos.multa as multa',
            'clientepagamentos.valor as valor',
            'pagamentos.datapagamento as data',
            'clientepagamentos.estado as estado',
            'clientepagamentos.created_at as data_pagamento',
            'clientepagamentos.created_at as data_alteracao',
            'pagamentos.modopagamento as modo',
            'pagamentos.id as id',
            'pagamentos.nomebanco as nomebanco',
            'pagamentos.id_docpagamento as referencia',
            'users.name as operador'

 
            )
        ->orderBy('clientes.id','desc')
        ->get();  
       

        //dd($detalhes);
            
        return view('admin.detalhes', ['pg'=>$pg, 'detalhes' => $detalhes]);

    }


    public function verificar_idDocumento($numero){
        
        $numero = Pagamento::where('id_docpagamento', $numero)->first();
        
        if(is_null($numero)){

            return 1;
        }
      
        return 0;
    }


    public function extratopagamento(Request $request){

        $pg=DB::table('clientepagamentos')
            ->whereBetween('pagamentos.datapagamento',[$request->datainicio, $request->datafim])
            ->join('clientes','clientepagamentos.cliente_id','=','clientes.id')
            ->join('pagamentos','pagamentos.id','=','clientepagamentos.pagamento_id')
            ->join('pts','pts.id','=','clientes.pt_id')
            ->select('clientes.nome as cliente','clientes.nif as nif', 'clientepagamentos.ano','clientepagamentos.mes','pagamentos.datapagamento as data','clientepagamentos.estado as estado','pagamentos.datapagamento as data','pagamentos.modopagamento as modo','pagamentos.id as id','clientepagamentos.id as idpagamento', 'clientepagamentos.multa as multa','pts.localizacao as pt', 'clientes.morada as morada', 'clientepagamentos.valor')
            ->orderBy('clientepagamentos.id','asc')
            ->get();

            

      

            if($pg->count()==0){
                

                $pg=DB::table('clientepagamentos')
                ->join('clientes','clientepagamentos.cliente_id','=','clientes.id')
                ->join('pagamentos','pagamentos.id','=','clientepagamentos.pagamento_id')
                ->join('pts','pts.id','=','clientes.pt_id')
                ->select('clientes.nome as cliente','clientes.nif as nif', 'clientepagamentos.ano','clientepagamentos.mes','pagamentos.datapagamento as data','clientepagamentos.estado as estado','pagamentos.datapagamento as data','pagamentos.modopagamento as modo','pagamentos.id as id','clientepagamentos.id as idpagamento', 'clientepagamentos.multa as multa','pts.localizacao as pt', 'clientes.morada as morada', 'clientepagamentos.valor')
                ->orderBy('clientepagamentos.id','desc')
                ->get();
        
                return view('admin.recibos',['pg'=>$pg,'erros'=>'não existe pagamentos dentro deste periodo']);

            }

            $total=0;
            $multas=0;
            foreach($pg as $p){
                $total=$total+$p->valor;
                $multas=$multas+$p->multa;
            }

            PDF::setOption(['isRemoteEnabled' => true]);
            $pdf=PDF::loadView('relatorios.extratopagamento',['pg'=>$pg,'multa'=>$multas, 'total'=>$total]);
            return $pdf->setPaper('a4')->stream('extrato-de-pagamento.pdf');


    }


    public function returnadados(){
        $pg=DB::table('clientepagamentos')
            ->join('clientes','clientepagamentos.cliente_id','=','clientes.id')
            ->join('pagamentos','clientepagamentos.pagamento_id','=','pagamentos.id')
            ->select('clientes.nome as cliente','clientes.nif as nif', 'clientepagamentos.mes','pagamentos.datapagamento as data','clientepagamentos.estado as estado','pagamentos.datapagamento as data','pagamentos.modopagamento as modo','pagamentos.id as id','clientepagamentos.id as idpagamento')
            ->orderBy('clientes.id','desc')
            ->get();
        return $pg;
    }


    public function devedores(){
        $dataAtual = new DateTime('-1 month');
      
        $devedores = DB::table('ultimopagamentos')
        ->where('ultimopagamentos.data','<>',null)
        ->join('clientes','ultimopagamentos.cliente_id','=','clientes.id')
        ->select('clientes.nome as cliente','clientes.nif as nif', 'ultimopagamentos.data as ultimo_pagamento','clientes.id as id')
        ->get();

      
       
        $qtdmes = [];
        $devedor = [];


       
        foreach ($devedores as $dev){

           
                $ultimoPagamento = new DateTime($dev->ultimo_pagamento);
                $diferenca = $dataAtual->diff($ultimoPagamento);
               
                if(($dataAtual > $ultimoPagamento) && ($diferenca->m != 0)){
                    $devedor[] = $dev;
                    $qtdmes[] = $diferenca->m;
                }
            
        }
        
       
        return view('admin.devedores', ['devedor'=>$devedor, 'qtdmes'=>$qtdmes]);
    }


    public function exportextratopagamento(Request $request){
        $_SESSION['datainicio']= $request->datainicio;
        $_SESSION['datafim']= $request->datafim;
        return Excel::download(new PagamentoExport,'extrato-pagamento.xlsx');
    }


    public function isPrimeiroPagamento($cliente_id){

        $cli=ClientePagamento::where('cliente_id',$cliente_id)->first();
       
        return is_null($cli);

    }


    public function retornaPagamento(){
        $p=new Pagamento();
        $p->modopagamento=$_SESSION['modo'];
        $p->nomebanco=$_SESSION['banco'];
        $p->id_docpagamento=$_SESSION['id_documento'];
        $p->user_id=Auth::user()->id;
        $p->datapagamento = date('y-m-d');
        return $p;
    }

    public function todosdados(){
        $pg=DB::table('clientepagamentos')
        ->join('clientes','clientepagamentos.cliente_id','=','clientes.id')
        ->join('pagamentos','clientepagamentos.pagamento_id','=','pagamentos.id')
        ->select('clientes.nome as cliente','clientes.nif as nif', 'clientepagamentos.mes',
        'pagamentos.datapagamento as data',
        'clientepagamentos.estado as estado',
        'pagamentos.datapagamento as data',
        'pagamentos.modopagamento as modo',
        'pagamentos.id as id',
        'clientepagamentos.id as idpagamento',
        'clientepagamentos.ano as ano',
        'clientepagamentos.valorcaixa as caixa',
        'clientepagamentos.valorbanco as banco',
        'clientepagamentos.multa as multa')
        ->orderBy('clientes.id','desc')
        ->get();
       
        return $pg;
    }


    public function salvarPagamento(Request $request){
        $p=new Pagamento();

        $pa=Pagamento::where('nomebanco','=',$request->banco)
        ->where('id_docpagamento','=',$request->id_documento)
        ->get();
       // $pa=array($pa);
       // dd();
        if($pa->count()==0){
        //dd(empty($pa));
        $p->modopagamento=$request->modo_pagamento;
        
        if($request->modo_pagamento=='Remanescente'){
            $p->nomebanco='N/H';
        }else{
                $p->nomebanco = $request->banco;
        }
        $p->id_docpagamento=$request->id_documento;
        $p->user_id=Auth::user()->id;
        $p->datapagamento = date('y-m-d');
        $p->save();
        $codigopagamento = $p->id;
        $_SESSION['modopagamento'] = $request->modo_pagamento;
        return view('admin.dadosdepagamento',['codigopagamento'=>$codigopagamento,'sms'=>'codigo de pagamento gerado com sucesso','modo'=>$_SESSION['modopagamento']]);
        }

        $cliente=DB::table('clientes')->where('clientes.id', $_SESSION['id_cliente'])
        ->join('servicos','clientes.servico_id','=','servicos.id')
        ->join('pts','clientes.pt_id','=','pts.id')
        ->select('clientes.*', 'servicos.descricao as servico','pts.localizacao as pt')->first();
        // verificar se o codigo de pagamento ja foi pago pelo menos 1 mês
        $c=Cliente::findOrFail($_SESSION['id_cliente']);
            $qtdMeses=$this->dividaaPagar($_SESSION['id_cliente']);
            return view("admin.codigofatura", ['cliente' => $cliente,'qtd'=>$qtdMeses,'valorPagar'=>$c->preco,'erro'=> 'este codigo de referencia ja foi registado']); 
           
    }


    public function salvardadosPagamento(Request $request){
                $c=new ClientePagamento();
                    $erros=array();
                    $mensagem="";
                    $verificador = false;
                    $ano = explode('-', $request->data);
                    $c->ano = $ano[0];
                    $c->mes = $this->retornaMes($ano[1]);
                    $c->multa = $this->moeda($request->valor_multa);
                    $c->cliente_id = $_SESSION['id_cliente'];
                    $c->pagamento_id = $request->codigopagamento;
                    $c->estado = 'não verificado';
                    $c->valorbanco = $this->moeda($request->valorbanco);
                    $c->valorcaixa = $this->moeda($request->valorcaixa);

                    if($_SESSION['modopagamento']=='Remanescente'){
                        $caixa = (double) $c->valorcaixa;
                        $multa = (double) $c->multa;
                        $valor= $caixa+$multa;
                       if( $this->verificarvalor($c->cliente_id, $valor)){
                        //fazer o desconto na conta do cliente
                       $verificador = true;
                       }else{
                        $erros[]="o saldo do cliente é insuficente para efectuar este pagamento";
                        return view('admin.dadosdepagamento',['erros'=>$erros,'codigopagamento'=>$c->pagamento_id,'modo'=>$_SESSION['modopagamento']]);


                       }
                    }
        
                    $codigopagamento = $c->pagamento_id;
                    $codigopagamento = $request->codigopagamento;
                   $u= Ultimopagamento::where('cliente_id',$_SESSION['id_cliente'])->get();
       
                    //dd($this->diferencaMes($request->data, $_SESSION['id_cliente']));
        if ($this->isPrimeiroPagamento($_SESSION['id_cliente'])) {
           
            //salvar o primeiro pagamento
            $c->save();
            $vector = ['data'=> $request->data];
            Ultimopagamento::findOrFail($u[0]->id)->update($vector);
           
             if($this->haspagamentoEfectuado($codigopagamento)){
                return view('admin.dadosdepagamento',['sms'=>'pagamento efectuado com sucesso','codimpressao'=>0,'codigopagamento'=> $codigopagamento,'modo'=>$_SESSION['modopagamento']]);
             }

            return view('admin.dadosdepagamento',['sms'=>'pagamento efectuado com sucesso','codigopagamento'=> $codigopagamento,'modo'=>$_SESSION['modopagamento']]);
        }
        $mes_a_pagar = $ano[1];
       // dd($mes_a_pagar);
        $mes_ult_pagamento=explode('-', $u[0]->data);
        $mesUltimoPagamento=$mes_ult_pagamento[1];
        
        $diferencaMes=$this->diferencaMes($request->data, $_SESSION['id_cliente']);
       
        if($mesUltimoPagamento>$mes_a_pagar){
            $diferencaMes=$diferencaMes*(-1);
        }
        if(($diferencaMes>1) && ($this->diferencaAno($mes_ult_pagamento[0], $ano[0],$mes_a_pagar)==true)){
            $erros[]=" O mês de: $c->mes/$c->ano, não pode ser pago, pois o cliente possui divida no /os meses anteriores ";
            return view('admin.dadosdepagamento',['erros'=>$erros,'codigopagamento'=> $codigopagamento,'modo'=>$_SESSION['modopagamento']]);
        }

        if(($diferencaMes<1) && ($this->diferencaAno($mes_ult_pagamento[0], $ano[0],$mes_a_pagar)==true)){
            $erros[]=" O mês de: $c->mes/$c->ano, já foi pago";
            return view('admin.dadosdepagamento',['erros'=>$erros,'codigopagamento'=> $codigopagamento,'modo'=>$_SESSION['modopagamento']]);
        }

        if(($diferencaMes==1) && ($this->diferencaAno($mes_ult_pagamento[0], $ano[0],$mes_a_pagar)==true)){
            $c->save();
            $vector = ['data'=> $request->data];
            Ultimopagamento::findOrFail($u[0]->id)->update($vector);

            if($this->haspagamentoEfectuado($codigopagamento)){
                return view('admin.dadosdepagamento',['sms'=>'pagamento efectuado com sucesso','codimpressao'=>0,'codigopagamento'=> $codigopagamento,'modo'=>$_SESSION['modopagamento']]);
            }

            return view('admin.dadosdepagamento',['sms'=>'pagamento efectuado com sucesso','codigopagamento'=> $codigopagamento,'modo'=>$_SESSION['modopagamento']]);
           
        }
        $erros[]="Não é possivel efectuar o pagamento por favor verifique o mês/ano a pagar";
            return view('admin.dadosdepagamento',['erros'=>$erros,'codigopagamento'=> $codigopagamento,'modo'=>$_SESSION['modopagamento']]);
       

    }


    public function diferencaMes($data, $liente_id){
       // $dataAtual = new DateTime('-1 month');
       $u= Ultimopagamento::where('cliente_id','=',$liente_id)->get();
        //$diferenca = $dataAtual->diff($ultimoPagamento);
        $u = $u[0]->data;
        $ultimoPagamento = new DateTime($u);
        $dt=new DateTime($data);
        $diferenca =  $ultimoPagamento->diff($dt)->m;
        //dd($ultimoPagamento->diff($dt));
       // dd($diferenca);
        return  $diferenca;
       
    }

    public function diferencaAno($ano_ult_pag, $ano_pagamento,$mes){
      $qtd=$ano_pagamento-$ano_ult_pag;

        if($qtd==0){
            return true;
        } 

        if($qtd>1 && $mes==1){
            return true;
        }
        return false;
     }
     public function dividaaPagar($liente_id){
        $u= Ultimopagamento::where('cliente_id','=',$liente_id)->get();
      
        $dataAtual = new DateTime('-1 month');
        $ultimoPagamento = new DateTime($u[0]->data);
        $diferenca=$ultimoPagamento->diff($dataAtual)->m;
      //  dd($diferenca);
        return $diferenca;
        
     }


     public function devedores_num_periodo(Request $request){

        $dataI = (new DateTime($request->datainicio))->format('Y-m');
        $dataF = (new DateTime($request->datafim))->format('Y-m');

     
        $lista_devedor = [];
       
        $devedores = DB::table('ultimopagamentos')
        ->whereBetween('ultimopagamentos.data',[$request->datainicio, $request->datafim])
        //->where('ultimopagamentos.data','<>',null)
        ->join('clientes','ultimopagamentos.cliente_id','=','clientes.id')
        ->select('clientes.nome as cliente','clientes.nif as nif', 'ultimopagamentos.data as ultimo_pagamento','clientes.id as id')
        ->get();

        
       // dd( $devedores);
        foreach ($devedores as $dev){

            if($dev->ultimo_pagamento>= $dataI && $dev->ultimo_pagamento < $dataF){
                $dev->ultimo_pagamento = (new DateTime($dev->ultimo_pagamento));

                $dev->ultimo_pagamento = ($dev->ultimo_pagamento->add(new DateInterval('P1M')))->format('Y-m');  //soma um mes ao ultimo pagamento
                
                $new_dev = new Dev();

                $new_dev->codigo = $dev->id;
                $new_dev->nome=$dev->cliente;
                $new_dev->nif=$dev->nif;

                if($dev->ultimo_pagamento < $dataI){

                    while($dev->ultimo_pagamento < $dataI){

                        $dev->ultimo_pagamento = (new DateTime($dev->ultimo_pagamento));

                        $dev->ultimo_pagamento = ($dev->ultimo_pagamento->add(new DateInterval('P1M')))->format('Y-m');  //soma um mes ao ultimo pagamento
                    }
                }    

                while($dev->ultimo_pagamento <= $dataF){ 

                    $data = explode('-', $dev->ultimo_pagamento);

                    $new_dev->meses [] = $this->retornaMes($data[1]).'/'.$data[0];
                    
                    $auxiliar_data = (new DateTime($dev->ultimo_pagamento));

                    $dev->ultimo_pagamento = ($auxiliar_data->add(new DateInterval('P1M')))->format('Y-m');  //soma um mes ao ultimo pagamento
                    
                    $dev->ultimo_pagamento = $auxiliar_data->format('Y-m');
                }

                $lista_devedor[] = $new_dev;
            }
        }
        return $lista_devedor;
        //dd($lista_devedor);
      //  return view('relatorios.extratodivida',['pg'=>$lista_devedor]);
    }



    public function extratodivida(Request $request){

          $pg=$this->devedores_num_periodo($request);
           //$pg=Pagamento::all();
            if(count($pg)==0){
                $pg=DB::table('clientepagamentos')
                ->join('clientes','clientepagamentos.cliente_id','=','clientes.id')
                ->join('pagamentos','pagamentos.id','=','clientepagamentos.pagamento_id')
                ->join('pts','pts.id','=','clientes.pt_id')
                ->select('clientes.nome as cliente','clientes.nif as nif', 'clientepagamentos.ano','clientepagamentos.mes','pagamentos.datapagamento as data','clientepagamentos.estado as estado','pagamentos.datapagamento as data','pagamentos.modopagamento as modo','pagamentos.id as id','clientepagamentos.id as idpagamento', 'clientepagamentos.multa as multa','pts.localizacao as pt', 'clientes.morada as morada', 'clientepagamentos.valor')
                ->orderBy('clientepagamentos.id','desc')
                ->get();
        
                return view('admin.recibos',['pg'=>$pg,'erros'=>'não existe devedores dentro deste periodo']);
            }
          // dd($pg);
            PDF::setOption(['isRemoteEnabled' => true]);
            $pdf=PDF::loadView('relatorios.extratodivida',['pg'=>$pg]);
            return $pdf->setPaper('a4')->stream('extrato-de-divida.pdf');
    }

    public function haspagamentoEfectuado($idpagamento){
        $cli=ClientePagamento::where('clientepagamentos.pagamento_id', $idpagamento)->get();

        if($cli->count()>0){
            return true;
        }
        return false;
    }


    public function verificarvalor($idcli, $valor){

        $c= ContaCliente::where('cliente_id','=',$idcli)->get();

        if($c->count()>0){
            $saldo = $c[0]->saldo;
            if($saldo>=$valor){
                return true;
            }
        }

        return false;
    }


    public function credito(Request $request){

        $c = new Operacao();
        $c->conta_id = $request->conta_id;
        $c->debito = 0;
        $c->credito = $this->moeda($request->valor);
        $c->data = date('y-m-d');

        return $c->save();


    }

    public function descontoSaldoCliente(){

    }

    

}
