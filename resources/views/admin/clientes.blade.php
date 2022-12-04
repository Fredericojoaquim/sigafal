@extends('layouts.template')

@section('title', 'Clientes')


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
                        <th>Nif</th>
                        <th>Morada</th>
                        <th>Telefone</th>
                    </tr>
              
            </thead>
            <tbody>
                @if(isset($cliente))
                    @foreach($cliente as $c)
                <tr>
                    <td></td>
                    <td></td>
                    <td>{{$u->email}}</td>
                    <td>{{$u->permicao}}</td>
                    
                    <td class="d-flex justify-content-center"> 
                        <button class="btn btn-sm btn-primary">Alterar</button>
                        <button class="btn btn-sm btn-secondary ">bloquear</button >
                    </td>
                    @endforeach
                   
                @endif    
                </tr>
               
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
                                <form action="{{url('/user/registar')}}" method="Post" novalidate="novalidate">
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
                                                <label for="senha" class="control-label mb-1">Senha</label>
                                                <input id="cc-exp" name="password" type="password" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the card expiration"
                                                    data-val-cc-exp="Please enter a valid month and year"
                                                    autocomplete="cc-exp" required>
                                                <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label for="x_card_code" class="control-label mb-1">Confirmar Senha</label>
                                            <div class="input-group">
                                                <input id="x_card_code" name="password_confirmation" type="password" class="form-control cc-cvc" value="" data-val="true" data-val-required="Please enter the security code"
                                                    data-val-cc-cvc="Please enter a valid security code" autocomplete="off" required>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row form-group">
                                                <div class="col col-md-12">
                                                    <label for="select" class=" form-control-label">Perfil</label>
                                                </div>
                                                <div class="col-12 col-md-12">
                                                    <select name="permission" id="select" class="form-control">
                                                        <option selected="selected">Selecione</option>
                                                        <option value=Administrador">Administrador</option>
                                                        <option value="operador">Operador</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <div class="text-right">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit"  class="btn btn-primary">Confirmar</button>
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

<script>
    //validação do formulário registar cliente

        
            btn_registar=document.getElementById("btn-registar-cliente");
            btn_registar.addEventListener('click', (event)=>{

            event.preventDefault();
            var formregistar=document.getElementById("form-registar-cliente");
            var nome=document.getElementById("nome").value;
            var nif=document.getElementById("nif").value;
            var morada=document.getElementById("morada").value;
            var telefone=document.getElementById("telefone").value;
            var email=document.getElementById("email").value;
            var tipo=document.getElementById("tipo").value;
            var servico=document.getElementById("servico").value;
            var pt = document.getElementById("pt").value;
            var preco= document.getElementById("preco").value;
            var obs=document.getElementById("observacao").value;
            var erro= document.getElementById("erro-registar");
           
            
            if(nome == ''){
                
                erro.innerHTML="O campo <strong> nome </strong> é obrigatório";
                erro.removeAttribute('hidden');
                nome.focus();
                return false;
            }else{
                erro.setAttribute('hidden', true);
            }
            if(nif==''){
                erro.innerHTML="O campo <strong> nif </strong> é obrigatório";
                erro.removeAttribute('hidden');
                nome.focus();
                return false;

            }else{
                erro.setAttribute('hidden', true);
            }
            if(morada==''){
                erro.innerHTML="O campo <strong> morada </strong> é obrigatório";
                erro.removeAttribute('hidden');
                nome.focus();
                return false;
            }else{
                erro.setAttribute('hidden', true);

            }
            if(telefone==''){
                erro.innerHTML="O campo <strong> telefone </strong> é obrigatório";
                erro.removeAttribute('hidden');
                nome.focus();
                return false;
            }else{
                erro.setAttribute('hidden', true);
            }

            if(tipo =='Selecione'){

                erro.innerHTML="Por favor selecione uma opção no campo<strong> Tipo </strong>";
                erro.removeAttribute('hidden');
                nome.focus();
                return false;
            }else{
                erro.setAttribute('hidden', true);
            }

            if(servico=='Selecione'){
                erro.innerHTML="Por favor selecione uma opção no campo<strong> servico </strong>";
                erro.removeAttribute('hidden');
                nome.focus();
                return false;
            }else{
                erro.setAttribute('hidden', true);
            }

            if(pt=='Selecione'){
                erro.innerHTML="Por favor selecione uma opção no campo<strong> pt </strong>";
                erro.removeAttribute('hidden');
                nome.focus();
                return false;
            }else{
                erro.setAttribute('hidden', true);
            }
            if(preco==''){
                erro.innerHTML="O campo <strong> preço </strong> é obrigatório";
                erro.removeAttribute('hidden');
                nome.focus();
                return false;
            }else{
                erro.setAttribute('hidden', true);
                formregistar.submit();
            }
             

        });

</script>

@endsection