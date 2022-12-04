@extends('layouts.template')

@section('title', 'Perfil-User')


@section('content')

@php
$caminho='imagens'.'/'.$u->imagem;
@endphp
            
<div class="section__content section__content--p30">
    <div class="container-fluid">

        @if(isset($sms))

        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
            <span class="badge badge-pill badge-success">Success</span>
            {{$sms}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        @endif

        
            

            <div class="col-md-6 centralizar">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title mb-3">Meu Perfil</strong>
                    </div>
                    <div class="card-body">
                        <div class="mx-auto d-block">
                            <img class="rounded-circle mx-auto d-block" src="{{url("$caminho")}}" alt="Card image cap">
                            <h5 class="text-sm-center mt-2 mb-1">{{$u->name}}</h5>
                            <div class="location text-sm-center">
                               <div> <i class="fa fa-map-status"></i> Email: {{$u->email}}</div>
                               <div> <i class="fa fa-email"></i> Estado: {{$u->estado}}</div>
                                <button class="float-center btnaltearuser" data-toggle="modal" data-target="#alteraruser">Alterar</button>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
       
    </div>
    </div>
</div>





<!-- modal registar usuario -->
<div class="modal fade" id="alteraruser" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
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
                                <form id="form-registar-user" action="{{url('/user/update/')}}" method="Post" novalidate="novalidate" enctype="multipart/form-data">
                                    @csrf
                                    {{ method_field('PUT') }}
                                    @if(isset($u))
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="nome" class="control-label mb-1">Nome</label>
                                                <input id="nome" value="{{$u->name}}" name="nome" type="text" class="form-control cc-exp" value="" required>
                                                <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label for="email" class="control-label mb-1">Email</label>
                                            <div class="input-group">
                                                <input id="email" value="{{$u->email}}" name="email" type="email" class="form-control"  required>
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

                                        <div class="col-12">
                                            <label for="foto" class="control-label mb-1">Foto de Perfil</label>
                                            <div class="input-group">
                                                <input id="foto" name="imagem" type="file" class="form-control cc-cvc" data-show-preview="true" required>
                                                <input  name="id" type="hidden" value="{{$u->id}}" class="form-control cc-cvc" data-show-preview="true" required>

                                            </div>
                                        </div>
                                        
                                    </div>

                                    <div class="text-right mt-2">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button id="btn-registar" type="submit" class="btn btn-primary">Confirmar</button>
                                    </div>
                                    @endif
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


<script>
      $(document).ready(function(){
        $('#valor').mask('#.##0,00',{reverse: true});

       
      });

      function validar(){
      //form=document.getElementById("form_pag");
       // alert('ss');
      
         
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