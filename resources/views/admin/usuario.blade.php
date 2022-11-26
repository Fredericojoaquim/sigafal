@extends('layouts.template')

@section('title', 'Usuários')


@section('content')

<div class="section__content section__content--p30">
    <div class="container-fluid">

        @if($errors->any())
              
                         @foreach($errors->all() as $erro)
                            <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                <span class="badge badge-pill badge-danger">Erro</span>
                                {{$erro}} 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endforeach            
                    

                 @endif  

                 @if(isset($sms))

                <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                    <span class="badge badge-pill badge-success">Success</span>
                    {{$sms}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                @endif


        <div class="row mb-3">
            <div class="col-md-12">
                <div class="overview-wrap">
                    <h2 class="title-1">Usuários</h2>
                    <button class="au-btn au-btn-icon au-btn--blue" data-toggle="modal" data-target="#registarusuarioModal" >
                        <i class="zmdi zmdi-plus"></i>Registar</button>
                </div>
            </div>
        </div>

        <table class="table">
            <thead class="table-dark">
                <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Perfil</th>
                        <th>Foto</th>
                        <th>Ações</th>
                    </tr>
              
            </thead>
            <tbody>
                @foreach ($users as $u)
                <tr>
                    <td>{{$u->id}}</td>
                    <td>{{$u->name}}</td>
                    <td>{{$u->email}}</td>
                    <td>{{$u->permicao}}</td>
                    @php
                         $caminho='imagens'.'/'.$u->imagem;
                      @endphp
                    <td> <img src="{{url("$caminho")}}" alt="imagem-profile" class="foto-perfil rounded"> </td>
                    
                    <td  class="d-flex justify-content-center"> 

                        <button class="btn btn-sm btn-primary mr-1">Alterar</button>
                         <button class="btn btn-sm btn btn-danger eliminar" id="{{$u->id}}" onclick="retornaid({{$u->id}})" data-toggle="modal"   data-target="#smallmodal">
                                <ion-icon name="trash-outline"></ion-icon> Eliminar
                         </button>
                   
                    </td>
                   

                </tr>
                @endforeach
            </tbody>
          </table>
    </div>
</div>




<!-- modal registar usuario -->
<div class="modal fade" id="registarusuarioModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Registar Usuário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div hidden class="sufee-alert alert with-close alert-danger alert-dismissible fade show" id="erro">
                                </div>
                                <form id="form-registar-user" action="{{url('/user/registar')}}" method="Post" novalidate="novalidate" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="nome" class="control-label mb-1">Nome</label>
                                                <input id="nome" name="name" type="text" class="form-control cc-exp" value="" required>
                                                <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label for="email" class="control-label mb-1">Email</label>
                                            <div class="input-group">
                                                <input id="email" name="email" type="email" class="form-control"  required>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="senha1" class="control-label mb-1">Senha</label>
                                                <input id="senha1" name="password" type="password" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the card expiration"
                                                    data-val-cc-exp="Please enter a valid month and year"
                                                    autocomplete="cc-exp" required>
                                                <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label for="senha2" class="control-label mb-1">Confirmar Senha</label>
                                            <div class="input-group">
                                                <input id="senha2" name="password_confirmation" type="password" class="form-control cc-cvc" value="" data-val="true" data-val-required="Please enter the security code"
                                                    data-val-cc-cvc="Please enter a valid security code" autocomplete="off" required>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <div class="row form-group">
                                                <div class="col col-md-12">
                                                    <label for="perfil" class=" form-control-label">Perfil</label>
                                                </div>
                                                <div class="col-12 col-md-12">
                                                    <select id="perfil" name="permission" id="select" class="form-control">
                                                        <option selected="selected">Selecione</option>
                                                        <option value="Administrador">Administrador</option>
                                                        <option value="operador">Operador</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <label for="foto" class="control-label mb-1">Foto de Perfil</label>
                                            <div class="input-group">
                                                <input id="foto" name="imagem" type="file" class="form-control cc-cvc" data-show-preview="true" required>

                                            </div>
                                        </div>
                                        
                                    </div>

                                    <div class="text-right">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button id="btn-registar" type="submit" class="btn btn-primary">Confirmar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
<!-- end modal medium -->



<!-- modal small -->
<div class="modal fade" id="smallmodal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="smallmodalLabel">Atenção</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="mb-3">
                    Tem certeza que deseja eliminar este registo?
                </p>
                <form action="{{url("/user/delete")}}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" value="" name="user_id" id="user_id">
                    <div class="float-right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                        <button type="submit" class="btn btn-primary">Sim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end modal small -->

<script>
     function retornaid(id){
            $('#user_id').val(id);
    }


    $(document).ready(function(){
        var botao=document.getElementById('btn-registar');
        botao.addEventListener('click', (event)=>{
        event.preventDefault();
        var nome=document.getElementById("nome");
        var erro=document.getElementById("erro");
        var email = document.getElementById('email');
        var perfil = document.getElementById('perfil');
        var senha1 = document.getElementById('senha1');
        var senha2 = document.getElementById('senha2');
        var form=document.getElementById("form-registar-user");

        if(nome.value==''){
            erro.innerHTML="o campo<strong> nome </strong> é obrigatório";
            erro.removeAttribute('hidden');
            nome.focus();
            return false;
        }else{
            erro.setAttribute('hidden', true);
        }

        if(email.value==''){
            erro.innerHTML="o campo<strong> Email </strong> é obrigatório";
            erro.removeAttribute('hidden');
            email.focus();
            return false;
        }else{
            erro.setAttribute('hidden', true);
        }

        if(senha1.value==''){
            erro.innerHTML="o campo<strong> Senha </strong> é obrigatório";
            erro.removeAttribute('hidden');
            senha1.focus();
            return false;
        }else{
         
            erro.setAttribute('hidden', true);
        }

        if(senha2.value==''){
            erro.innerHTML="o campo<strong> confirmar senha </strong> é obrigatório";
            erro.removeAttribute('hidden');
            senha2.focus();
            return false;
        }else{
            erro.setAttribute('hidden', true);
        }

        if(perfil.value=='Selecione'){
            erro.innerHTML="Selecione um tipo de perfil";
            erro.removeAttribute('hidden');
         
            return false;
        }else{
            erro.setAttribute('hidden', true);
        }
        if(senha2.value !== senha1.value){
            erro.innerHTML="As senhas digitadas não conferem, por favor verifique";
            erro.removeAttribute('hidden');
            senha2.focus();
            return false;
        }else{
            erro.setAttribute('hidden', true);
            form.submit();
        }

        





        });
    });
</script>

@endsection