<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Models\ModelPermission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$users=User::all();
        //
       // $users=User::with('permission')->get();
       // $users=User::with('permissions')->find(4);
        return view('user',['users'=>$users]);*/
        $users=DB::table('model_has_permissions')
        ->join('permissions','permission_id','=','permissions.id')
        ->join('users','model_id','=','users.id')
        ->select('users.*', 'permissions.name as permicao')
        ->get();
        //return $exp;

        //dd($users);
       
        return view('admin.usuario',['users'=>$users]);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $exp=DB::table('model_has_permissions')
        ->join('permissions','permission_id','=','permissions.id')
        ->join('user','model_id','=','users.id')
        ->select('users.*', 'permissions.*')
        ->get();
        return $exp;
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
        $u=User::findOrFail($request->id);
        $u->name=$request->nome;
        $u->email=$request->email;
        $u->password=Hash::make($request->password);
        if($request->hasFile('imagem')){
        
            $requestImagem = $request->imagem;
            $extensao = $requestImagem->extension();
            $nomeImagem = md5($requestImagem->getClientOriginalName().strtotime("now")).".".$extensao;
            $request->imagem->move(public_path('imagens'),$nomeImagem);
            $u->imagem = $nomeImagem;
        }

        $u->update();

        return view('admin.perfil',['u'=>$u, 'sms'=>'Perfil actualizado com sucesso']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $s=new User();
        $s=User::findOrFail($request->user_id);
       
        if($s->delete()):
            $users=User::all();  
            return view('admin.usuario',['users'=>$users,'sms'=> 'registo eliminado com sucesso']);
        else:
            $users=User::all();   
            return view('admin.usuarios',['users'=>$users,'erro'=> 'erro ao eliminar o registo']);
        endif;
    }


    public function perfil($id){
        $u=User::findOrFail($id);

        return view('admin.perfil',['u'=>$u]);


    }




    


   

}
