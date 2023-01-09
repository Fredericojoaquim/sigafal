
@extends('layouts.template2')

@section('title', 'Pagamentos')


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

         <!-- -->

         @if(isset($erros))
              
                         @foreach($erros as $erro)
                            <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                <span class="badge badge-pill badge-danger">Erro</span>
                                {{$erro}} 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endforeach            
                    

         @endif  
         <!-- -->

         

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
                            <h2 class="title-1">Pagamentos</h2>
                            <button class="au-btn au-btn-icon au-btn--blue" data-toggle="modal" data-target="#modalbuscar" >
                                <i class="zmdi zmdi-plus"></i>Pagamento</button>
                        </div>
                    </div>
                </div>

        <div class="myresponsivetable table-responsive table-responsive-data3 ">
        <table class="table " id="datatable">
            <thead class="table-dark">
           
                <tr>
                        <th>Id</th>
                        <th>Cliente</th>
                        <th>Nif</th>
                        <th>modo de pagamento</th>
                        <th>Mês Pago</th>
                        <th>Banco</th>
                        <th>Caixa</th>
                        <th>Multa</th>
                        <th>Data</th> 
                        <th>Estado</th> 
                        <th>Acções</th>
                    </tr>
                
            </thead>
            <tbody>
                

                @php 
                //formatando o valor que vem da BD no formato de dinheiro
               // $valor = number_format($s->multa, 2,",",".");
               

                @endphp


            @if(isset($pg))
                  @foreach($pg as $p)
                <tr >
                    <td>{{ $p->id}}</td>
                    <td>{{ $p->cliente}}</td>
                    <td>{{ $p->nif}}</td>
                    <td>{{ $p->modo}}</td>
                   <td>{{ $p->mes}}/{{ $p->ano}}</td>
                   <td>{{number_format($p->banco, 2,",",".");}}</td>
                   <td>{{number_format($p->caixa, 2,",",".");}}</td>
                   <td>{{number_format($p->multa, 2,",",".");}}</td>
                    <td>{{ $p->data}}</td>
                    @if($p->estado=="verificado")
                        <td class="status--process"> {{ $p->estado}}</td>
                    @else
                         <td class="status--denied">{{ $p->estado}}</td>
                    @endif
                    
                  
                    <td class="d-flex justify-content-center"> 
                      
                              
                                <button class="btn btn-primary btn-sm editar mr-1" id="">
                                    <a class="bnEditar" href="{{url("/pagamentos/show$p->idpagamento")}}">Alterar</a>
                                </button>
                             
                     

                        <button class="btn btn-secondary btn-sm editar  mr-1" id="">
                            <a class="bnEditar" href="{{url("/dashboard/pagamentos/$p->idpagamento")}}">Detalhes</a>
                        </button>
                        @can('Administrador')
                            @if($p->estado == 'não verificado')
                                <button class="btn btn-success btn-sm editar mr-1" id="$p->idpagamento" onclick="aprovar({{$p->idpagamento}})" data-toggle="modal"   data-target="#modalaprovar">
                                Aprovar
                                </button>
                            @else
                                <button disabled class="btn btn-warning btn-sm editar mr-1" id="$p->idpagamento">
                                    Aprovar
                                </button>

                            @endif
                        @endcan

                        
                    </td>
                   

                </tr>
                @endforeach
                   
            @endif 
            </tbody>
          </table>
        </div>
    </div>
</div>




<!-- modal registar usuario -->
<div class="modal fade" id="registarcontratos" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Registar Contratos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-12">
                          
                                                <form action="{{url('/dashboard/contratos/store')}}" method="Post" novalidate="novalidate">
                                                    @csrf
                
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="row form-group">
                                                                <div class="col col-md-12">
                                                                    <label for="select" class=" form-control-label">Cliente</label>
                                                                </div>
                                                                <div class="col-12 col-md-12">
                                                                    <select name="cliente" id="select" class="form-control">
                                                                        <option selected="selected">Selecione</option>
                                                                        @if(isset($clientes))
                                                                            @foreach($clientes as $c)
                                                                        <option value="{{$c->id}}">{{$c->nome}}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                
                
                                                        <div class="col-6" id="valor">
                                                            <div class="form-group">
                                                                <label for="valor" class="control-label mb-1">Valor</label>
                                                                <input id="valor" name="valor" type="text" class="form-control cc-exp" value="" required>
                                                                <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    
                                                    
                                                    
                
                                                    <div class="text-right">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                        <a  class="btn btn-primary" id="nav-profile" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home"
                                                        aria-selected="true">Confirmar</a>
                                                    </div>
                                                </form>

                                            </div>
                                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                                <p>Baptista you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth
                                                    master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh
                                                    dreamcatcher synth. Cosby sweater eu banh mi, irure terry richardson ex sd. Alip placeat salvia cillum iphone.
                                                    Seitan alip s cardigan american apparel, butcher voluptate nisi .</p>
                                            </div>
                                           
                                        </div>

                                    </div>
                                </div>
                            
                        </div>
                        <!-- /# column -->


                                     
                             
                </div>
            </div>
            
        </div>
    </div>
</div>
<!-- end modal medium -->


<!-- Modal -->
<div class="modal fade" id="modalbuscar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Buscar Cliente</h5>
          
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div hidden id="div_erro" class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
            <span class="badge badge-pill badge-danger">Erro</span>
            <p>Por favor digite um nif no campo de busca</p>
        </div>

        

        <div class="modal-body">
            <form id="formenviar" class="d-flex" action="{{url('/dashboard/pagamentos/buscarCliente')}}" method="Post" role="search">
                @csrf
                <input id="nif" name="nif" class="form-control me-2" type="search" placeholder="Informe o NIF do Cliente" aria-label="Search" autofocus>
                <button class="btn btn-outline-success" id="btn_send" type="submit">Buscar</button>
            </form>
        </div>
      </div>
    </div>
  </div>
  <!-- End Modal -->



  <!-- modal small -->
<div class="modal fade" id="modalaprovar" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
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
                    Tem certeza que deseja aprovar este pagamento?
                </p>
                <form action="{{url("/pagamentos/aprovar")}}" method="post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" value="" name="id" id="id_aprovar">
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




<!-- modal alterar pagamentos -->
<div class="modal fade" id="alterarPagamento" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Alterar Pagamento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-12">
                            @if(isset($cp))
                            
                            <form id="form-pagamento-alterar" action="/pagamentos/update" id="formulario-aterar-pagamento" method="Post" novalidate="novalidate">
                                <div hidden id="erro" class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Erro</span>
                                    <p id="texto-erro"></p>
                                </div>
                                @csrf
                                {{ method_field('PUT') }}

                                <div class="card">
                                    <div class="card-body">
                                
                               
                                        <div class="row">
                                            @php
                                            $mes=$cp->mes.' de '.$cp->ano;
                                            $multa= $valor = number_format($cp->multa, 2,",",".");
                                            $valor=number_format($cp->valor, 2,",",".");
                                          

                                            @endphp
                
                                            <div class="col-6">
                                                
                                                <label for="preco" class="control-label mb-1">Valor</label>
                                                <div class="input-group">
                                                    <input id="valoralt" value="{{ $valor }}" name="valor"  min="0" class="form-control preco"  required>
                                                </div>
                                            </div>
                
                                            <div class="col-6" id="valor_multa">
                                                <label for="multalt" class="control-label mb-1">Valor da Multa</label>
                                                <input id="multalt" value="{{$multa}}" name="multa"   min="0" class="form-control multa_valor"  required>
                                                <input id="id_pagamento" hidden value="{{$cp->id}}" name="id_pagamento"   min="0" class="form-control multa_valor"  required>
                                                
                                            </div>
        
                                        </div>
                                    </div>

                                </div>
                            </div>
                        
                                <div class="">
                                    <button type="submit" id="btnalterar" class="btn col-12 btn-primary">Alterar</button>
                                </div>
        
                            </form>
                            @endif

                                            </div>
                                            
                                           
                                        </div>

                                    </div>
                                </div>
                            
                        </div>
                        <!-- /# column -->
                </div>
            </div>
            
        </div>
    </div>
</div>



<script>

function aprovar(id){
  $('#id_aprovar').val(id);
 }

    $(document).ready(function(){
        //mascaras com jmask
        $('#valor').mask('#.##0,00',{reverse: true});
        $('#valoralt').mask('#.##0,00',{reverse: true});
        $('#multalt').mask('#.##0,00',{reverse: true});
        $(this).find('[autofocus]').focus();
        $('#alterarPagamento').modal('show');

        
        var btnalterar=document.getElementById('btnalterar');
        btnalterar.addEventListener('click', (event)=>{
            event.preventDefault();
            var valor=document.getElementById("valoralt").value;
            var multa=document.getElementById("multalt").value;
            var erro= document.getElementById("erro");
            var texto= document.getElementById("texto-erro");
            var form=document.getElementById("form-pagamento-alterar");
           
            if(valor ==''){
                alert('entrou');
                
                 texto.innerHTML="O campo <strong> valor </strong> é obrigatório";
                 erro.removeAttribute('hidden');
               
                return false;
            }else{
                erro.setAttribute('hidden', true);
            }

            if(multa ==''){
                 texto.innerHTML="O campo <strong> multa </strong> é obrigatório";
                erro.removeAttribute('hidden');
               
                return false;
            }else{
                erro.setAttribute('hidden', true);
                form.submit();
            }



        });


    });

    
    $(document).on('click','.editar',function(){

        //$('#alterarServicoModal').modal('show');
    });   
    
    
    $(document).ready(function(){
        //codigo para inicializar a data table
      var table=$('#datatable').DataTable();   
        });
        
        

        var botaopesquisar=document.getElementById('btn_send');
        var erro=document.getElementById("div_erro");
        var form=document.getElementById("formenviar");
        botaopesquisar.addEventListener('click', (event)=>{
         var nif=document.getElementById("nif").value;
               // var form=document.getElementById("d");
               
               
                
                if(nif==""){
                    
                    erro.removeAttribute('hidden');
                    
                }else{
                    erro.setAttribute('hidden', true);
                   form.submit();

                }
               
               });



              


</script>

@endsection