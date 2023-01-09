
@extends('layouts.template')

@section('title', 'Gestão de Contratos')


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


        <div class="row">

           
                <div class="col-3">
                    <a href="">todos contratos</a>
                </div>

                <div class="col-3">
                    <a href="">todos contratos</a>
                </div>

                <div class="col-3">
                    <a href="">todos contratos</a>
                </div>

                <div class="col-3">
                    <a href="">todos contratos</a>
                </div>
               
           

        </div>  

        <div class="myresponsivetable table-responsive table-responsive-data3 ">
        <table class="table " id="datatable">
            <thead class="table-dark">
           
                <tr>
                    <th>Id </th>
                    <th>Cliente</th>
                    <th>Nif</th>
                    <th>Modo de pagamento</th>
                    <th>Valor do contracto</th>
                    <th>valor Pago</th> 
                     <th>Estado</th> 
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
                    <td>{{ $c->idcontrato}}</td>
                    <td>{{ $c->nome}}</td>
                    <td>{{ $c->nif}}</td>
                    <td>{{ $c->modo}}</td>
                   
                    <td>{{number_format( $c->valor, 2,",",".") }}</td>
                    <td>{{number_format( $c->total, 2,",",".")  }}</td>
                    @if($c->valor== $c->total)
                    <td class="status--process">concluido</td>
                    @else
                    <td class="status--denied">inconcluido</td>
                    @endif
                    <td  class="d-flex justify-content-center"> 
                        <button class="btn btn-secondary mr-1 btn-sm editar  " id="">
                            <a class="bnEditar" href="{{url("/dashboard/contratos-detalhes/$c->idcontrato")}}">Detalhes</a>
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
        $('#valor').mask('#.##0,00',{reverse: true});
        $('#valorapagar').mask('#.##0,00',{reverse: true});
        $('#pagarcontrato').mask('#.##0,00',{reverse: true});


    });
    
    $(document).ready(function(){
        //codigo para inicializar a data table
       var table=$('#datatable').DataTable();

  
            
   });

        function retornaid(id){
            $('#contrato_id').val(id);
        }

        function pagar(id){
            $('#contrato_id').val(id);
        }

</script>

@endsection