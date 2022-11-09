
@extends('layouts.template')

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
              
                        
                            <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                <span class="badge badge-pill badge-danger">Erro</span>
                                {{$erros}} 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                                
                    

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

                 <div class="row mb-3 fixed">
                    <div class="col-6">
                        <button class="btn-md btn-success mr-3" data-toggle="modal" data-target="#modaldata">Extracto de pagamento</button>
                        <button class="btn-md btn-info" data-toggle="modal" data-target="#modaldataexcel">Extracto de dívida</button>

                    </div>


                    <div class="col-6">
                        <div class="float-right">
                            <button class="btn-md btn-success mr-3" data-toggle="modal" data-target="#modaldata">Extracto de pagamento</button>
                        <button class="btn-md btn-info" data-toggle="modal" data-target="#modaldataexcel">Extracto de dívida</button>
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
                        <th>Data</th> 
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
             
                    <td>{{ $p->data}}</td>
                   
                    
                  
                    <td> 
                        <button class="btn btn-primary btn-sm editar" id="">
                            <a target="_blank" class="bnEditar" href="{{url("/pagamentos/recibo$p->id")}}">Imprimir Recibo</a>
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










<!-- modal buscar extrato de pagamentos -->
<div class="modal fade" id="modaldata" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Extracto de Pagamento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">

                                <div hidden class="sufee-alert alert with-close alert-danger alert-dismissible fade show" id="erroextrato">
                                
                                </div>

                                <form target="_blank" id="formextrato-pagamento" action="{{url('/dashboard/extratopagamento')}}" method="Post" novalidate="novalidate">
                                    @csrf

                                    <div class="row">
                                        
                                                <div class="col-6">
                                                    <label for="data1" class="control-label mb-1">Data inicio</label>
                                                    <div class="input-group">
                                                        <input id="data1" name="datainicio" type="date" class="form-control"  required>
                                                    </div>
                                                </div>
                                         
                                      
                                        <div class="col-6">
                                            <label for="data2" class="control-label mb-1">Data de fim </label>
                                            <div class="input-group">
                                                <input id="data2" name="datafim" type="date" class="form-control"  required>
                                            </div>
                                        </div>
                                    </div>
         
                                    <div class="text-right mt-3">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" id="btnextratopagamento" class="btn btn-primary">Confirmar</button>
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





<!-- modal buscar extrato de pagamentos excel -->
<div class="modal fade" id="modaldataexcel" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Extracto de Pagamento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">

                                <div hidden class="sufee-alert alert with-close alert-danger alert-dismissible fade show" id="erroextrato">
                                
                                </div>

                                <form target="_blank" id="formextrato-pagamento" action="{{url('/dashboard/exportextratopagamentoexel')}}" method="Post" novalidate="novalidate">
                                    @csrf

                                    <div class="row">
                                        
                                                <div class="col-6">
                                                    <label for="data1" class="control-label mb-1">Data inicio</label>
                                                    <div class="input-group">
                                                        <input id="data1" name="datainicio" type="date" class="form-control"  required>
                                                    </div>
                                                </div>
                                         
                                      
                                        <div class="col-6">
                                            <label for="data2" class="control-label mb-1">Data de fim </label>
                                            <div class="input-group">
                                                <input id="data2" name="datafim" type="date" class="form-control"  required>
                                            </div>
                                        </div>
                                    </div>
         
                                    <div class="text-right mt-3">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" id="btnextratopagamento" class="btn btn-primary">Confirmar</button>
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

function aprovar(id){
  $('#id_aprovar').val(id);
 }

    $(document).ready(function(){
        //mascaras com jmask
        $('#valor').mask('#.##0,00',{reverse: true});
        $(this).find('[autofocus]').focus();


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
               
                event.preventDefault();
                
                if(nif==""){
                    
                    erro.removeAttribute('hidden');
                    
                }else{
                    erro.setAttribute('hidden', true);
                   form.submit();

                }
               
               });

               var btnextratopagamento=document.getElementById('btnextratopagamento');
               btnextratopagamento.addEventListener('click', (event)=>{

                event.preventDefault();
                var erro=document.getElementById("erroextrato");
                var form=document.getElementById("formextrato-pagamento");
                var data1=document.getElementById("data1").value;
                var data2=document.getElementById("data2").value;

                if(data1==""){
                    
                    erro.removeAttribute('hidden');
                    erro.innerHTML="Por favor selecione uma data de inicio";
                    return false;
                    
                }else{
                    erro.setAttribute('hidden', true);
                }

                if(data2==""){
                   
                    erro.removeAttribute('hidden');
                    erro.innerHTML="Por favor selecione uma data de fim"
                    return false;
                    
                }else{
                    erro.setAttribute('hidden', true);
                   form.submit();

                }

            });


</script>

@endsection