
@extends('layouts.template2')

@section('title', 'Histórico de Cliente')


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
                            <h2 class="title-1">Histórico de Cliente</h2>
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
                    <td>{{ $p->data}}</td>
                    <td>{{ $p->estado}}</td>
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