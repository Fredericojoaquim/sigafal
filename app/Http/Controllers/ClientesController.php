<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\ContaCliente;
use App\Models\Pt;
use App\Models\Servico;
use App\Models\Ultimopagamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cliente=DB::table('clientes')
        ->join('servicos','clientes.servico_id','=','servicos.id')
        ->join('pts','clientes.pt_id','=','pts.id')
        ->select('clientes.*', 'servicos.descricao as servico','pts.localizacao as pt')
        ->orderBy('clientes.id','desc')
        ->get();
        $pt=Pt::all();
        $servicos=Servico::all();
        return view('admin.cliente',['cliente'=>$cliente,'pt'=>$pt, 'servicos'=>$servicos]);
        
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

        if($this->consultarnif($request->nif)){
            $c=new Cliente;
            $c->nome=$request->nome;
            $c->nif=$request->nif;
            $c->tipo=$request->tipo;
            $c->email=$request->email;
            $c->telefone=$request->telefone;
            $c->morada=$request->morada;
            $c->preco=$this->moeda($request->preco);
            $c->servico_id=$request->servico;
            $c->observacao=$request->observacao;
            $c->pt_id=$request->pt;
           // dd($request->pt);
           
            if( $c->save()){
                $u=new Ultimopagamento();
                $u->cliente_id=$c->id;
               // $u->data=date('y-m');
                $u->save();

                $conta = new ContaCliente();
                $conta->data = date('y-m-d');
                $conta->cliente_id = $c->id;
                $conta->saldo = 0;

                $conta->save();

            }
           
            
        }else{
            $cliente=DB::table('clientes')
            ->join('servicos','clientes.servico_id','=','servicos.id')
            ->join('pts','clientes.pt_id','=','pts.id')
            ->select('clientes.*', 'servicos.descricao as servico','pts.localizacao as pt')
            ->orderBy('clientes.id','desc')
            ->get();
            $pt=Pt::all();
            $servicos=Servico::all();
            $erro='Erro ao registar o cliente, o nif digitado já se encontra registado.';
            return view('admin.cliente',['cliente'=>$cliente,'pt'=>$pt, 'servicos'=>$servicos,'erro'=>$erro]);
        }
       
        $cliente=DB::table('clientes')
        ->join('servicos','clientes.servico_id','=','servicos.id')
        ->join('pts','clientes.pt_id','=','pts.id')
        ->select('clientes.*', 'servicos.descricao as servico','pts.localizacao as pt')
        ->orderBy('clientes.id','desc')
        ->get();
        $pt=Pt::all();
        $servicos=Servico::all();
        $sms='Cliente registado com sucesso.';
        return view('admin.cliente',['cliente'=>$cliente,'pt'=>$pt, 'servicos'=>$servicos,'sms'=>$sms]);  
    }

    public function showEmpresa(){

        $cliente=DB::table('clientes')
        ->join('servicos','clientes.servico_id','=','servicos.id')
        ->join('pts','clientes.pt_id','=','pts.id')
        ->select('clientes.*', 'servicos.descricao as servico','pts.localizacao as pt')
        ->where('clientes.tipo','=','Empresa')
        ->orderBy('clientes.id','desc')
        ->get();
        return view('admin.clienteempresa',['cliente'=>$cliente]);

    }


    public function showparticular(){

        $cliente=DB::table('clientes')
        ->join('servicos','clientes.servico_id','=','servicos.id')
        ->join('pts','clientes.pt_id','=','pts.id')
        ->select('clientes.*', 'servicos.descricao as servico','pts.localizacao as pt')
        ->where('clientes.tipo','=','Particular')
        ->orderBy('clientes.id','desc')
        ->get();
        return view('admin.clienteParticular',['cliente'=>$cliente]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente=DB::table('clientes')
        ->join('servicos','clientes.servico_id','=','servicos.id')
        ->join('pts','clientes.pt_id','=','pts.id')
        ->select('clientes.*', 'servicos.descricao as servico','pts.localizacao as pt')
        ->orderBy('clientes.id','desc')
        ->get();
        //
       
        $c=DB::table('clientes')
        ->join('servicos','clientes.servico_id','=','servicos.id')
        ->join('pts','clientes.pt_id','=','pts.id')
        ->select('clientes.*', 'servicos.descricao as servico','clientes.servico_id as servicocodigo','pts.localizacao as pt','clientes.pt_id as ptcodigo')
        ->where('clientes.id','=',$id)
        ->orderBy('clientes.id','desc')
        ->get();

       
       

        $pt=Pt::all();
        $servicos=Servico::all();
        return view('admin.clientealterar',['cliente'=>$cliente,'pt'=>$pt, 'servicos'=>$servicos,'c'=>$c]);
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
      //  dd($request->servico);
        $valor=$this->moeda($request->precoalt);
        $s=[
        'preco'=>$valor,
        'nome'=>$request->nome,
        'id'=>$request->id,
        'nif'=>$request->nif,
        'tipo'=>$request->tipo,
        'telefone'=>$request->telefone,
        'servico_id'=>$request->servico,
        'observacao'=>$request->observacao,
        'pt_id'=>$request->pt,
         'email'=>$request->email,
         'morada'=>$request->morada
        ];

       Cliente::findOrFail($request->id)->update($s);

       $cliente=DB::table('clientes')
       ->join('servicos','clientes.servico_id','=','servicos.id')
       ->join('pts','clientes.pt_id','=','pts.id')
       ->select('clientes.*', 'servicos.descricao as servico','pts.localizacao as pt')
       ->orderBy('clientes.id','desc')
       ->get();
       $pt=Pt::all();
       $servicos=Servico::all();
       $sms='Cliente alterado com sucesso.';
       return view('admin.cliente',['cliente'=>$cliente,'pt'=>$pt, 'servicos'=>$servicos,'sms'=>$sms]);

      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $c=new Cliente();
        $c=Cliente::findOrFail($request->cliente_id);
        $pt=Pt::all();
        $servicos=Servico::all();

        $cliente=DB::table('clientes')
        ->join('servicos','clientes.servico_id','=','servicos.id')
        ->join('pts','clientes.pt_id','=','pts.id')
        ->select('clientes.*', 'servicos.descricao as servico','pts.localizacao as pt')
        ->orderBy('clientes.id','desc')
        ->get();
       
        if($c->delete()):
            
           
            return view('admin.cliente',['cliente'=>$cliente,'pt'=>$pt, 'servicos'=>$servicos,'sms'=>'registo eliminado com sucesso']);
        else:
             
            return view('admin.cliente',['cliente'=>$cliente,'pt'=>$pt, 'servicos'=>$servicos,'erro'=>'Erro ao eliminar o registo']);
        endif;
    }

    public function moeda($v){
		$source=array('.',',');
		$replace=array('','.');
		$valor=str_replace($source, $replace, $v);
		return $valor;
		
	}

    public function consultarnif($nif){
        $c=Cliente::where('nif',$nif)
         ->get();
        $num=count($c);
         if($num==0){
            return true;
         }
         return false;

    }


    public function historico($idcli){

        $pg=DB::table('clientepagamentos')
        ->where('clientepagamentos.cliente_id','=',$idcli)
        ->join('clientes','clientepagamentos.cliente_id','=','clientes.id')
        ->join('pagamentos','clientepagamentos.pagamento_id','=','pagamentos.id')
        ->select('clientes.nome as cliente','clientes.nif as nif', 'clientepagamentos.mes','pagamentos.datapagamento as data','clientepagamentos.estado as estado','pagamentos.datapagamento as data','pagamentos.modopagamento as modo','pagamentos.id as id','clientepagamentos.id as idpagamento','clientepagamentos.ano as ano')
        ->orderBy('clientes.id','desc')
        ->get();

        return view('admin.historico',['pg'=>$pg]);

    

        

    }
}
