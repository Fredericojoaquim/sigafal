@extends('layouts.template')

@section('title', 'Serviços')


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

        @if(isset($erro))
            <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
            <span class="badge badge-pill badge-danger">Erro</span>
            {{$erro}} 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
        @endif

        <div class="row mb-3">
            <div class="col-md-12">
                <div class="overview-wrap">
                    <h2 class="title-1">Serviços</h2>
                    <button class="au-btn au-btn-icon au-btn--blue" data-toggle="modal" data-target="#registarusuarioModal" >
                        <i class="zmdi zmdi-plus"></i>Registar</button>
                </div>
            </div>
        </div>

        <table class="table">
            <thead class="table-dark">
                <tr>
                        <th>Id</th>
                        <th>Descrição</th>
                        <th>Multa</th>
                        <th>Acções</th>
                    </tr>
              
            </thead>
            <tbody>
                @foreach($servicos as $s)

                @php 
                //formatando o valor que vem da BD no formato de dinheiro
                $valor = number_format($s->multa, 2,",",".");

                @endphp
                <tr>
                    <td>{{$s->id}}</td>
                    <td>{{$s->descricao}}</td>
                    <td>{{$valor}}</td>
                    <td> 
                        <button class="btn btn-sm btn-outline-primary  editar" id="{{$s->id}}">
                            <a class="bnEditar" href="{{url("/dashboard/servicos/show/$s->id")}}">Alterar</a>
                        </button>

                        <button class="btn btn-sm btn btn-danger eliminar" id="{{$s->id}}" onclick="retornaid({{$s->id}})" data-toggle="modal"   data-target="#smallmodal">
                            <ion-icon name="trash-outline"></ion-icon> Eliminar
                         </button>
                    </td>
                   

                </tr>
                @endforeach
            </tbody>
          </table>
    </div>
</div>




<!-- modal registar serviços -->
<div class="modal fade" id="registarusuarioModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Registar Serviços</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div hidden class="sufee-alert alert with-close alert-danger alert-dismissible fade show" id="erro-registar">
                                </div>

                                <form id="form-registar-servico" action="{{url('/dashboard/servicos')}}" method="Post" novalidate="novalidate">
                                    @csrf

                                    <div class="row">
                                        <div class="col-6">
                                            <div class="row form-group">
                                                <div class="col col-md-12">
                                                    <label for="descricao" class=" form-control-label">Descrição</label>
                                                </div>
                                                <div class="col-12 col-md-12">
                                                    <select name="descricao" id="descricao" class="form-control">
                                                        <option selected="selected">Selecione</option>
                                                        <option value="Monofásico">Monofásico</option>
                                                        <option value="Trifásico">Trifásico</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label for="multa" class="control-label mb-1">Multa</label>
                                            <div class="input-group">
                                                <input id="multa" name="multa" type="text" class="form-control"  required>
                                            </div>
                                        </div>
                                    </div>
         
                                    <div class="text-right">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" id="btn-registar" class="btn btn-primary">Confirmar</button>
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

@if(@isset($se))
@php

@endphp

<!-- modal alterar serviços -->
<div class="modal fade" id="alterarServicoModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Alterar Serviços</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div hidden class="sufee-alert alert with-close alert-danger alert-dismissible fade show" id="erro-alterar">
                                </div>

                                <form  id ="form-alterar-servico" action="{{url("/servicos/update/$se->id")}}"  method="Post" novalidate="novalidate">
                                    {{csrf_field()}}
                                    {{ method_field('PUT') }}

                                    <div class="row">
                                        <div class="col-6">
                                            <div class="row form-group">
                                                <div class="col col-md-12">
                                                    <label for="select" class=" form-control-label">Descrição</label>
                                                </div>
                                                <div class="col-12 col-md-12">
                                                    <select name="descricao" id="descricaoalt" class="form-control">
                                                        <option selected="{{$se->servicocodigo}}">{{$se->descricao}}</option>
                                                        <option value="Monofásico">Monofásico</option>
                                                        <option value="Bifásico">Bifasico</option>
                                                        <option value="Trifásico">Trifásico</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label for="multa" class="control-label mb-1">Multa</label>
                                            <div class="input-group">
                                                @php
                                                $valor = number_format($se->multa, 2,",",".");
                                                @endphp
                                                <input id="altmulta" name="multa" value="{{$valor}}" type="text" class="form-control"  required>
                                                <input  name="id" value="{{$se->id}}" type="hidden">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="text-right">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" id="btn-alterar" class="btn btn-primary">Confirmar</button>
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
@endif
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
                <form action="{{url("/servicos/delete")}}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" value="" name="servico_id" id="servico_id">
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
    $(document).ready(function(){
        //mascaras com jmask
        $('#altmulta').mask('#.##0,00',{reverse: true});
        $('#alterarServicoModal').modal('show');
        $('#multa').mask('#.##0,00',{reverse: true});

        btn_registar=document.getElementById("btn-registar");
        btn_registar.addEventListener('click', (event)=>{

            event.preventDefault();
            var form=document.getElementById("form-registar-servico");
            var descricao=document.getElementById("descricao").value;
            var multa=document.getElementById("multa").value;
            var erro=document.getElementById("erro-registar");

            if(descricao == 'Selecione'){
                erro.innerHTML="Por favor selecione uma <strong> descrição </descrição>";
                erro.removeAttribute('hidden');
                cliente.focus();
                return false;
            }else{
                erro.setAttribute('hidden', true);
            }

            if(multa == ''){
                erro.innerHTML="O campo <strong> multa </strong> é  Obrigatório";
                erro.removeAttribute('hidden');
                cliente.focus();
                return false;
            }else{
                erro.setAttribute('hidden', true);
                form.submit();
            }

        });


        //validação do formulario alterar
        btn_alterar=document.getElementById("btn-alterar");
        btn_alterar.addEventListener('click', (event)=>{

            event.preventDefault();
            var formalt=document.getElementById("form-alterar-servico");
            var descricaoalt=document.getElementById("descricaoalt").value;
            var multaalt=document.getElementById("altmulta").value;
            var erroalterar=document.getElementById("erro-alterar");

            if(descricaoalt == 'Selecione'){
                erroalterar.innerHTML="Por favor selecione uma <strong> descrição </descrição>";
                erroalterar.removeAttribute('hidden');
                cliente.focus();
                return false;
            }else{
                erroalterar.setAttribute('hidden', true);
            }

            if(multaalt == ''){
                erroalterar.innerHTML="O campo <strong> multa </strong> é  Obrigatório";
                erroalterar.removeAttribute('hidden');
                cliente.focus();
                return false;
            }else{
                erroalterar.setAttribute('hidden', true);
                formalt.submit();
            }

        });


    });

    function retornaid(id){
     $('#servico_id').val(id);
     }

    
    $(document).on('click','.editar',function(){

        //$('#alterarServicoModal').modal('show');
    });         
</script>

@endsection