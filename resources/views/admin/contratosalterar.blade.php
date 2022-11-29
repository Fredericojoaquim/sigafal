
@extends('layouts.template')

@section('title', 'Contractos')


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
                            <h2 class="title-1">Contractos</h2>
                            <button class="au-btn au-btn-icon au-btn--blue" data-toggle="modal" data-target="#registarcontratos" >
                                <i class="zmdi zmdi-plus"></i>Registar</button>
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
                        <th>Modo de pagamento</th>
                        <th>Valor do contracto</th>
                        <th>Data</th> 
                        <th>Acções</th>
                    </tr>
                
            </thead>
            <tbody>
                

                @php 
                //formatando o valor que vem da BD no formato de dinheiro
               // $valor = number_format($s->multa, 2,",",".");

                @endphp
            @if(isset($contratos))
                  @foreach($contratos as $c)
                  
               
                <tr>
                    <td>{{ $c->id}}</td>
                    <td>{{ $c->cliente}}</td>
                    <td>{{ $c->nif}}</td>
                    <td>{{ $c->modopagamento}}</td>
                    <td>{{number_format( $c->precocontrato, 2,",",".") }}</td>
                    <td>{{$c->datacontrato  }}</td>
                    <td class="d-flex justify-content-center"> 
                        <button class="btn btn-sm mr-1 btn-outline-primary editar" id="">
                            <a class="bnEditar" href="{{url("/dashboard/contratos/show/$c->id")}}">Alterar</a>
                        </button>
                        <button class="btn btn-sm btn-secondary mr-1">Imprimir</button>

                        <button class="btn btn-sm btn btn-danger eliminar mr-1" id="{{$c->id}}" onclick="retornaid({{$c->id}})" data-toggle="modal"   data-target="#smallmodal">
                            Eliminar
                           </button>
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
                        <div class="card">
                            <div class="card-body">
                                <div hidden class="sufee-alert alert with-close alert-danger alert-dismissible fade show" id="erro-registar">
                                </div>
                                <form id="form-registar-contrato" action="{{url('/dashboard/contratos/store')}}" method="Post" novalidate="novalidate">
                                    @csrf

                                    <div class="row">
                                        <div class="col-6">
                                            <div class="row form-group">
                                                <div class="col col-md-12">
                                                    <label for="cliente" class=" form-control-label">Cliente</label>
                                                </div>
                                                <div class="col-12 col-md-12">
                                                    <select name="cliente" id="cliente" class="form-control">
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


                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="valor" class="control-label mb-1">Valor</label>
                                                <input id="valor" name="valor" type="text" class="form-control cc-exp" required>
                                                <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                            </div>
                                        </div>


                                        <div class="col-6">
                                            <div class="row form-group">
                                                <div class="col col-md-12">
                                                    <label for="modopagamento" class=" form-control-label">Modo de pagamento</label>
                                                </div>
                                                <div class="col-12 col-md-12">
                                                    <select name="modopagamento" id="modopagamento" class="form-control">
                                                        <option selected="selected">Selecione</option>
                                                        <option value="Prestação">Prestação</option>
                                                        <option value="Completo">Completo</option>
                                                       
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="valorapagar" class="control-label mb-1">Valor a pagar</label>
                                                <input id="valorapagar" name="valorapagar" type="text" class="form-control cc-exp" required>
                                                <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                    
                                    

                                    <div class="text-right">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" id="btn-registar-contrato" class="btn btn-primary">Confirmar</button>
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


<!-- modal alterar contratos -->
<div class="modal fade" id="alterarcontratos" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Alterar Contratos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                @php
                                   //dd($contrat);
                                  $id=$contrat[0]->id;
                                    @endphp
                                    <div hidden class="sufee-alert alert with-close alert-danger alert-dismissible fade show" id="erro-alterar">
                                    </div>
                                <form id="form-alterar-contrato" action="{{url("/dashboard/contratos/update")}}" method="post" novalidate="novalidate">
                                    @csrf
                                    
                                    {{ method_field('PUT') }}
                                    @if(isset($contrat))
                                    

                                    <div class="row">
                                        <div class="col-6">
                                            <div class="row form-group">
                                                <div class="col col-md-12">
                                                    <label for="clientealt" class=" form-control-label">Cliente</label>
                                                </div>
                                                <div class="col-12 col-md-12">
                                                    <select name="cliente" id="clientealt" class="form-control">
                                                        <option value="{{$contrat[0]->cliente_id}}">{{$contrat[0]->cliente}}</option>
                                                        @if(isset($clientes))
                                                            @foreach($clientes as $c)
                                                        <option value="{{$c->id}}">{{$c->nome}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="valoralt" class="control-label mb-1">Valor</label>
                                                <input id="valoralt" name="valor_alt" type="text" class="form-control cc-exp" value="{{number_format( $contrat[0]->precocontrato, 2,",",".")}}" required>
                                                <input id="id_contrato" name="id" type="hidden" value={{$contrat[0]->id}}>
                                                <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <div class="row form-group">
                                                <div class="col col-md-12">
                                                    <label for="modopagamentoalt" class=" form-control-label">Modo de pagamento</label>
                                                </div>
                                                <div class="col-12 col-md-12">
                                                    <select name="modopagamento" id="modopagamentoalt" class="form-control">
                                                        <option value="{{$contrat[0]->modopagamento}}">{{$contrat[0]->modopagamento}}</option>
                                                        <option value="Prestação">Prestação</option>
                                                        <option value="Completo">Completo</option>
                                                       
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
    
    
                                        
                                        
                                    </div>


                                    
                                    
                                    
                                    

                                    <div class="text-right">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" id="btn-alterar-contrato" class="btn btn-primary">Confirmar</button>
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
                <form action="{{url("/dashboard/contratos/delete")}}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" value="" name="id" id="contrato_id">
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
        $('#valor').mask('#.##0,00',{reverse: true});
        $('#valor_alt').mask('#.##0,00',{reverse: true});
        $('#valorapagaralt').mask('#.##0,00',{reverse: true});
        $('#valorapagar').mask('#.##0,00',{reverse: true});
        $('#alterarcontratos').modal('show');
    });
    
    
   
    
    
    $(document).ready(function(){
        //codigo para inicializar a data table
       var table=$('#datatable').DataTable();

       btn_registar=document.getElementById("btn-registar-contrato");
       btn_registar.addEventListener('click', (event)=>{

            event.preventDefault();
            var formregistar=document.getElementById("form-registar-contrato");
            var cliente=document.getElementById("cliente").value;
            var valor=document.getElementById("valor").value;
            var erro= document.getElementById("erro-registar");
            var modo=document.getElementById("modopagamento").value;
          


            if(cliente == 'Selecione'){
                erro.innerHTML="Por favor Selecione um cliente";
                erro.removeAttribute('hidden');
                cliente.focus();
                return false;
            }else{
                erro.setAttribute('hidden', true);
            }

            if(valor == ''){
                erro.innerHTML="O campo <strong> Valor </strong> é de Obrigatório";
                erro.removeAttribute('hidden');
                cliente.focus();
                return false;
            }else{
                erro.setAttribute('hidden', true);
                
            }

            if(modo == 'Selecione'){
                erro.innerHTML="Por favor Selecione um <strong> modo de pagamento </strong>";
                erro.removeAttribute('hidden');
                modo.focus();
                return false;
            }else{
                erro.setAttribute('hidden', true);
            }

           

            

        });

      


      btn_alterar=document.getElementById("btn-alterar-contrato");
      btn_alterar.addEventListener('click', (event)=>{

            event.preventDefault();
            var formralterar=document.getElementById("form-alterar-contrato");
            var clientealt=document.getElementById("clientealt").value;
            var valoralt=document.getElementById("valoralt").value;
            var erroalt= document.getElementById("erro-alterar");
            var modoalt=document.getElementById("modopagamentoalt").value;
           

            if(clientealt == 'Selecione'){
                erroalt.innerHTML="Por favor Selecione um cliente";
                erroalt.removeAttribute('hidden');
             
                return false;
            }else{
                erroalt.setAttribute('hidden', true);
            }

            if(modoalt == 'Selecione'){
                erroalt.innerHTML="Por favor Selecione um <strong> modo de pagamento </strong>";
                erroalt.removeAttribute('hidden');
              
                return false;
            }else{
                erroalt.setAttribute('hidden', true);
                formralterar.submit();
            }

           

        });
     
            
        });

        function retornaid(id){
            $('#contrato_id').val(id);
        }
</script>

@endsection