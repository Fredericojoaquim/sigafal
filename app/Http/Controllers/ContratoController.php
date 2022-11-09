<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cliente;
use App\Models\Contracto;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Options;

class ContratoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $contratos=DB::table('contratos')
        ->join('clientes','contratos.cliente_id','=','clientes.id')
        ->select('contratos.*', 'clientes.nome as cliente','clientes.nif','clientes.morada','clientes.telefone')
        ->orderBy('contratos.id','desc')
        ->get();
        $clientes=Cliente::orderBy('id','desc')->get();

        return view('admin.contractos',['contratos'=>$contratos,'clientes'=>$clientes]);
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

    public function moeda($v){
		$source=array('.',',');
		$replace=array('','.');
		$valor=str_replace($source, $replace, $v);
		return $valor;	
	}
    public function store(Request $request)
    {
       // date_default_timezone_set('America/Sao_Paulo');
       // dd(date_default_timezone_get());
      // dd($request);
        $c=new Contracto;
        $c->cliente_id=$request->cliente;
       
        $c->precocontrato = $this->moeda($request->valor);
        $c->datacontrato=date('y-m-d');
        $c->valorpagamento= $this->moeda($request->valorapagar);
        $c->modopagamento= $request->modopagamento;
        $c->save();

        $contratos=DB::table('contratos')
        ->join('clientes','contratos.cliente_id','=','clientes.id')
        ->select('contratos.*', 'clientes.nome as cliente','clientes.nif','clientes.morada','clientes.telefone')
        ->orderBy('contratos.id','desc')
        ->get();

        $clientes=Cliente::orderBy('id','desc')->get();

        return view('admin.contractos',['contratos'=>$contratos,'clientes'=>$clientes,'sms'=>'Registo efectuado com sucesso']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contratos_update=DB::table('contratos')
        ->join('clientes','contratos.cliente_id','=','clientes.id')
        ->select('contratos.*', 'clientes.nome as cliente','clientes.nif','clientes.morada','clientes.telefone')
        ->where('contratos.id','=',$id)
        ->get();

        $cont=$contratos_update->toArray();

        $contratos=DB::table('contratos')
        ->join('clientes','contratos.cliente_id','=','clientes.id')
        ->select('contratos.*', 'clientes.nome as cliente','clientes.nif')
        ->orderBy('contratos.id','desc')
        ->get();

        $clientes=Cliente::orderBy('id','desc')->get();
        //return $contratos_update;

       return view('admin.contratosalterar',['contratos'=>$contratos,'clientes'=>$clientes,'contrat'=>$cont]);

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

    
    public function update(Request $request)
    {
   
       // $cont=new Contracto;
       $valor=$this->moeda($request->valor_alt);
       $contrato=[
        'precocontrato'=>$valor,
        'cliente_id'=>$request->cliente,
        'valorpagamento'=>$this->moeda($request->valorapagar),
        'modopagamento'=>$request->modopagamento
         ];

        $cont=  Contracto::findOrFail($request->id)->update( $contrato);
        $contratos=DB::table('contratos')
        ->join('clientes','contratos.cliente_id','=','clientes.id')
        ->select('contratos.*', 'clientes.nome as cliente','clientes.nif')
        ->orderBy('contratos.id','desc')
        ->get();

        $clientes=Cliente::orderBy('id','desc')->get();

        return view('admin.contractos',['contratos'=>$contratos,'clientes'=>$clientes,'sms'=>'Registo alterado com sucesso']);

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    
    {
        //dd($request);
        Contracto::findOrFail($request->id)->delete();
        $contratos=DB::table('contratos')
        ->join('clientes','contratos.cliente_id','=','clientes.id')

        ->select('contratos.*', 'clientes.nome as cliente','clientes.nif','clientes.morada','clientes.telefone')
        ->orderBy('contratos.id','desc')
        ->get();

        $clientes=Cliente::orderBy('id','desc')->get();

        return view('admin.contractos',['contratos'=>$contratos,'clientes'=>$clientes,'sms'=>'Registo Eliminado com sucesso']);
    }



    public function gerarcontrato($id){

        // $p=ClientePagamento::findOrFail($id);
        /* $options = new Options();
         $options->set('isRemoteEnabled', TRUE);
         $dompdf = new Dompdf($options);*/
         $c=DB::table('contratos')
         ->where('contratos.id','=',$id)
        ->join('clientes','contratos.cliente_id','=','clientes.id')
        ->join('pts','clientes.pt_id','=','pts.id')
        ->select('contratos.*', 'clientes.*','pts.*')
        ->get();
        
         
 
         PDF::setOption(['isRemoteEnabled' => true]);
         $pdf=PDF::loadView('relatorios.contrato',['c'=>$c]);
         return $pdf->setPaper('a4')->stream('contrato.pdf');
 
     }
}
