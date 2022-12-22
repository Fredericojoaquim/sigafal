
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

                 <!-- mensagem quando não foi encontrado um cliente pelo nif-->
                 @if(session()->has('sms_erro'))
                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                        <span class="badge badge-pill badge-danger">Success</span>
                        {{session()->get('sms_erro')}}
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
        <table class="table" id="datatable">
            <thead class="table-dark">
           
                <tr>
                        <th>Id</th>
                        <th>Cliente</th>
                        <th>Nif</th>
                        <th>modo de pagamento</th>
                        <th>Mês Pago</th>
                        <th>Banco</th>
                        <th>Caixa</th>
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
                    <td>{{ $p->data}}</td>
                    @if($p->estado=="verificado")
                        <td class="status--process"> {{ $p->estado}}</td>
                    @else
                         <td class="status--denied">{{ $p->estado}}</td>
                    @endif
                    <td class="d-flex justify-content-center"> 
                        <button class="btn btn-primary btn-sm edita mr-1" id="">
                            <a class="bnEditar" href="{{url("/pagamentos/show$p->idpagamento")}}">Alterar</a>
                        </button>

                        <button class="btn btn-secondary btn-sm editar  mr-1" id="">
                            <a class="bnEditar" href="{{url("/dashboard/pagamentos/$p->idpagamento")}}">Detalhes</a>
                        </button>

                        @if($p->estado == 'não verificado')
                        <button class="btn btn-success btn-sm editar mr-1" id="$p->idpagamento" onclick="aprovar({{$p->idpagamento}})" data-toggle="modal"   data-target="#modalaprovar">
                           Aprovar
                        </button>
                    @else
                        <button disabled class="btn btn-warning btn-sm editar mr-1" id="$p->idpagamento">
                            Aprovar
                        </button>

                    @endif
                    </td>
                   

                </tr>
                @endforeach
                   
            @endif 
            </tbody>
          </table>
        </div>
    </div>
</div>

<!--Modal detalhes -->
<div class="modal fade" id="detalhes" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Detalhes de Pagamento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                    <div class="row">

                            
                                        <div class="col-6">
                                            <label for="nome" class="control-label mb-1">Cliente: {{$detalhes[0]->cliente}}</label>
    
                                        </div>

                                        <div class="col-6">
                                            <label for="nif" class="control-label mb-1">Usuário: {{$detalhes[0]->operador}}</label>
                                        
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        
                                        <div class="col-6">
                                            <label for="morada" class="control-label mb-1">Mês Pago: {{$detalhes[0]->mes}}/{{$detalhes[0]->ano}}</label>
                                            
                                        </div>
                                        <div class="col-6">
                                            <label for="morada" class="control-label mb-1">Valor: {{number_format($detalhes[0]->valor, 2,",",".")}}</label>
                                        </div>   
                                    </div>

                                    <div class="row">
                                        
                                        <div class="col-6">
                                            <label for="select" class=" form-control-label">Modo de Pagamento: {{$detalhes[0]->modo}}</label>   
                                        </div>
                                        <div class="col-6">
                                            <label for="select" class=" form-control-label">Multa: {{number_format($detalhes[0]->multa, 2,",",".")}}</label>   
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="select" class=" form-control-label">Estado do Pagamento: {{$detalhes[0]->estado}} </label>   
                                        </div>
                                        <div class="col-6">
                                            <label for="select" class=" form-control-label">Banco: {{$detalhes[0]->nomebanco}}</label>   
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="select" class=" form-control-label">Referencia: {{$detalhes[0]->referencia}} </label>   
                                        </div>
                                        <div class="col-6">
                                            <label for="select" class=" form-control-label">Data do Registo: {{$detalhes[0]->data_pagamento}}</label>   
                                        </div>
                                        @if($detalhes[0]->data_pagamento != $detalhes[0]->data_alteracao)
                                            <div class="col-6">
                                                <label for="select" class=" form-control-label">Data do Registo: {{$detalhes[0]->data_alteracao}}</label>   
                                            </div>
                                        @endif
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>



<!-- modal aprovar-->
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

        <div hidden id="nif_invalido" class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
            <span class="badge badge-pill badge-danger">Invalido</span>
            <p>Por favor digite um nif válido</p>
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


<script>
   $(document).ready(function(){
       //   
        $('#detalhes').modal('show');
        var table=$('#datatable').DataTable();
    });
    function aprovar(id){
    $('#id_aprovar').val(id);
    }
</script>


@endsection