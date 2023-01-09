<?php

namespace App\Http\Controllers;

use App\Models\ContaCliente as ModelsContaCliente;
use App\Models\Operacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class ContaCliente extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contas=DB::table('contaclientes')
        
        ->join('clientes','contaclientes.cliente_id','=','clientes.id')
       // ->join('pts','clientes.pt_id','=','pts.id')
        ->select('clientes.nome as nome', 'clientes.nif as nif','contaclientes.id as codigo','contaclientes.saldo as saldo')
        ->get();

       

        return view('admin.contas', ['contas' => $contas]);
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
        //
        if($request->tipo=='Débito'){
           if( $this->debito($request)){
                $op = $this->dados_saldo($request->conta_id);
                $debito = $op[0]->debito;
                $credito = $op[0]->credito;
                $saldo = $debito - $credito;
                $s = ['saldo' => $saldo];

                ModelsContaCliente::findOrFail($request->conta_id)->update($s);

            $contas=DB::table('contaclientes')
        
            ->join('clientes','contaclientes.cliente_id','=','clientes.id')
        // ->join('pts','clientes.pt_id','=','pts.id')
            ->select('clientes.nome as nome', 'clientes.nif as nif','contaclientes.id as codigo','contaclientes.saldo as saldo')
            ->get();

       

          return view('admin.contas', ['contas' => $contas,'sms'=>'Operação efectuada com sucesso']);

           }
        }


        if($request->tipo=='Crédito'){
           if( $this->credito($request)){
            $op = $this->dados_saldo($request->conta_id);
            $debito = $op[0]->debito;
            $credito = $op[0]->credito;
            $saldo = $debito - $credito;
            $s = ['saldo' => $saldo];

            ModelsContaCliente::findOrFail($request->conta_id)->update($s);
            $contas=DB::table('contaclientes')
        
            ->join('clientes','contaclientes.cliente_id','=','clientes.id')
        // ->join('pts','clientes.pt_id','=','pts.id')
            ->select('clientes.nome as nome', 'clientes.nif as nif','contaclientes.id as codigo','contaclientes.saldo as saldo')
            ->get();

       

        return view('admin.contas', ['contas' => $contas,'sms'=>'Operação efectuada com sucesso']);
           }
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
    public function update(Request $request, $id)
    {
        //
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

    public function debito(Request $request){

        $c = new Operacao();
        $c->conta_id = $request->conta_id;
        $c->debito = $this->moeda($request->valor);
        $c->credito = 0;
        $c->data = date('y-m-d');

        return $c->save();

    }


    public function credito(Request $request){

        $c = new Operacao();
        $c->conta_id = $request->conta_id;
        $c->debito = 0;
        $c->credito = $this->moeda($request->valor);
        $c->data = date('y-m-d');

        return $c->save();


    }

    public function moeda($v){
		$source=array('.',',');
		$replace=array('','.');
		$valor=str_replace($source, $replace, $v);
		return $valor;	
	}

    public function dados_saldo($conta_id){
        $op = DB::table('operacao')
        ->where('conta_id', '=', $conta_id)
        ->join('contaclientes','operacao.conta_id','=','contaclientes.id')
        ->groupBy('operacao.conta_id')
        ->select(DB::raw('SUM(operacao.debito) as debito'),DB::raw('SUM(operacao.credito) as credito'))
        ->get();
        return $op;
    }

    public function detalhes($id){

        $contas = DB::table('operacao')
        ->where('conta_id', '=', $id)
        ->join('contaclientes','operacao.conta_id','=','contaclientes.id')
        ->join('clientes','contaclientes.cliente_id','=','clientes.id')
        ->select('clientes.nome as nome','clientes.nif as nif','operacao.debito as debito','operacao.credito as credito','operacao.data as data','operacao.id as codigo')
        ->get();

        return view('admin.detalhesConta', ['contas' => $contas]);


    }
}
