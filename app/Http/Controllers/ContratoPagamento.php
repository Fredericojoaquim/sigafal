<?php

namespace App\Http\Controllers;

use App\Models\Contratopagamentos;
use App\Models\Contracto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class ContratoPagamento extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pc=DB::table('contratopagamentos')
        ->join('contratos','contratos.id','=','contratopagamentos.contrato_id')
        ->join('clientes','contratos.cliente_id','=','clientes.id')
        ->select('clientes.*','contratos.*','contratopagamentos.valor as valor','contratopagamentos.created_at as data','contratopagamentos.id as codigo','contratopagamentos.estado as estado')
        ->get();

      
     //  $pc= Contratopagamentos::all();

       return view('admin.contratopagamentos',['pc'=>$pc]);
        
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
            $c= new  Contratopagamentos();
            $c=new Contratopagamentos();
            $c->contrato_id=$request->contrato_id;
            $c->valor=$this->moeda($request->valor);
            $c->estado="não verificado";
            $c->datapagamento=date('y-m-d');
            $c->save();

         $contratos=DB::table('contratopagamentos')
         ->where('contratopagamentos.contrato_id','=',$request->contrato_id)
        ->join('contratos','contratopagamentos.contrato_id','=','contratos.id')
         ->join('clientes','contratos.cliente_id','=','clientes.id')
        ->groupBy('contratopagamentos.contrato_id')
        ->select('contratos.precocontrato as valor',DB::raw('SUM(contratopagamentos.valor) as total'),DB::raw('COUNT(contratopagamentos.contrato_id) as qtd'))
         ->get();

         $estado="";
       
         if($contratos[0]->valor == $contratos[0]->total){
            $estado="Concluido";

         }else{
            $estado="inconcluido";
         }
         $s=['estado'=>$estado];
         $cont=Contracto::findOrFail($c->contrato_id)->update($s);
            //

            $pc=DB::table('contratopagamentos')
            ->join('contratos','contratos.id','=','contratopagamentos.contrato_id')
            ->join('clientes','contratos.cliente_id','=','clientes.id')
            ->select('clientes.*','contratos.*','contratopagamentos.valor as valor','contratopagamentos.created_at as data','contratopagamentos.id as codigo','contratopagamentos.estado as estado')
            ->get();

            return view('admin.contratopagamentos',['pc'=>$pc,'sms'=>'pagamento efecuado com sucessos']);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $c=Contratopagamentos::findOrFail($id);
        return view('admin.contratopagamentos',['cont'=>$c]);


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
       // dd($request->valor);
        $s=['valor'=>$this->moeda($request->valor)];
        $p=Contratopagamentos::findOrFail($request->codigo)->update($s);

        $pc=DB::table('contratopagamentos')
        ->join('contratos','contratos.id','=','contratopagamentos.contrato_id')
        ->join('clientes','contratos.cliente_id','=','clientes.id')
        ->select('clientes.*','contratos.*','contratopagamentos.valor as valor','contratopagamentos.created_at as data','contratopagamentos.id as codigo','contratopagamentos.estado as estado')
        ->get();

        return view('admin.contratopagamentos',['pc'=>$pc,'sms'=>'pagamento alterado com sucesso']);
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

    public function moeda($v){
		$source=array('.',',');
		$replace=array('','.');
		$valor=str_replace($source, $replace, $v);
		return $valor;	
	}

    public function buscarpagamento($id){

        
            $pc=DB::table('contratopagamentos')
            ->where('contratopagamentos.id','=',$id)
            ->join('contratos','contratos.id','=','contratopagamentos.contrato_id')
            ->join('clientes','contratos.cliente_id','=','clientes.id')
            ->select('clientes.*','contratopagamentos.valor as valor','contratopagamentos.created_at as data','contratopagamentos.id as codigo','contratopagamentos.estado as estado')
            ->get();
         
            return view('admin.alterar_contrato_pagamento',['ct'=>$pc,'pg'=>$this->todosregistos()]);

    }



    public function gerarcomprovativo($id){
        $pg=DB::table('contratopagamentos')
        ->where('contratopagamentos.id','=',$id)
        ->join('contratos','contratos.id','=','contratopagamentos.contrato_id')
        ->join('clientes','contratos.cliente_id','=','clientes.id')
        ->select('clientes.nome','clientes.telefone as telefone','clientes.nif','contratos.*','contratopagamentos.valor as valor','contratopagamentos.created_at as data','contratopagamentos.id as codigo','contratopagamentos.estado as estado')
        ->get();

        PDF::setOption(['isRemoteEnabled' => true]);
        $pdf=PDF::loadView('relatorios.comprovativo_contrato',['pg'=>$pg]);
        return $pdf->setPaper('a4')->stream('comprovatico-de-pagamento.pdf');
    }

    public function aprovarpagamento(Request $request){
      
        $s=['estado'=>'verificado'];
        $p=Contratopagamentos::findOrFail($request->id)->update($s);

        $pc=DB::table('contratopagamentos')
        ->join('contratos','contratos.id','=','contratopagamentos.contrato_id')
        ->join('clientes','contratos.cliente_id','=','clientes.id')
        ->select('clientes.*','contratos.*','contratopagamentos.valor as valor','contratopagamentos.created_at as data','contratopagamentos.id as codigo','contratopagamentos.estado as estado')
        ->get();

        return view('admin.contratopagamentos',['pc'=>$pc,'sms'=>'pagamento aprovado com sucesso']);
    }


    public function todosregistos(){
        $pc=DB::table('contratopagamentos')
        ->join('contratos','contratos.id','=','contratopagamentos.contrato_id')
        ->join('clientes','contratos.cliente_id','=','clientes.id')
        ->select('clientes.*','contratos.*','contratopagamentos.valor as valor','contratopagamentos.created_at as data','contratopagamentos.id as codigo','contratopagamentos.estado as estado')
        ->get();
        return $pc;
    }


   
}
