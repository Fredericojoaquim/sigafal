<?php

namespace App\Http\Controllers;

use App\Models\Contratopagamentos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

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
        ->join('contratos','contratopagamentos.contrato_id','=','contratos.id')
        ->join('clientes','contratos.cliente_id','=','clientes.id')
        ->get();
        return view('contratopagamentos',['pc'=>$pc]);
        
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
            $c->save();
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

    public function moeda($v){
		$source=array('.',',');
		$replace=array('','.');
		$valor=str_replace($source, $replace, $v);
		return $valor;	
	}

    public function buscarpagamentos($id){
        $pc=DB::table('contratopagamentos')
            ->where('contrato_id','=',$id)
            ->get();
        
       return $pc;
    }


   
}
