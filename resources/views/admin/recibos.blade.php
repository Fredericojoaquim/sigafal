
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
                        <button  style="color: blue" data-toggle="modal" data-target="#modaldata"> 
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-file-pdf-fill" viewBox="0 0 16 16">
                                <path d="M5.523 10.424c.14-.082.293-.162.459-.238a7.878 7.878 0 0 1-.45.606c-.28.337-.498.516-.635.572a.266.266 0 0 1-.035.012.282.282 0 0 1-.026-.044c-.056-.11-.054-.216.04-.36.106-.165.319-.354.647-.548zm2.455-1.647c-.119.025-.237.05-.356.078a21.035 21.035 0 0 0 .5-1.05 11.96 11.96 0 0 0 .51.858c-.217.032-.436.07-.654.114zm2.525.939a3.888 3.888 0 0 1-.435-.41c.228.005.434.022.612.054.317.057.466.147.518.209a.095.095 0 0 1 .026.064.436.436 0 0 1-.06.2.307.307 0 0 1-.094.124.107.107 0 0 1-.069.015c-.09-.003-.258-.066-.498-.256zM8.278 4.97c-.04.244-.108.524-.2.829a4.86 4.86 0 0 1-.089-.346c-.076-.353-.087-.63-.046-.822.038-.177.11-.248.196-.283a.517.517 0 0 1 .145-.04c.013.03.028.092.032.198.005.122-.007.277-.038.465z"/>
                                <path fill-rule="evenodd" d="M4 0h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm.165 11.668c.09.18.23.343.438.419.207.075.412.04.58-.03.318-.13.635-.436.926-.786.333-.401.683-.927 1.021-1.51a11.64 11.64 0 0 1 1.997-.406c.3.383.61.713.91.95.28.22.603.403.934.417a.856.856 0 0 0 .51-.138c.155-.101.27-.247.354-.416.09-.181.145-.37.138-.563a.844.844 0 0 0-.2-.518c-.226-.27-.596-.4-.96-.465a5.76 5.76 0 0 0-1.335-.05 10.954 10.954 0 0 1-.98-1.686c.25-.66.437-1.284.52-1.794.036-.218.055-.426.048-.614a1.238 1.238 0 0 0-.127-.538.7.7 0 0 0-.477-.365c-.202-.043-.41 0-.601.077-.377.15-.576.47-.651.823-.073.34-.04.736.046 1.136.088.406.238.848.43 1.295a19.707 19.707 0 0 1-1.062 2.227 7.662 7.662 0 0 0-1.482.645c-.37.22-.699.48-.897.787-.21.326-.275.714-.08 1.103z"/>
                            </svg> 
                           Extrato de Pagamento
                        </button> <br>


                        <button  style="color: blue" class="" data-toggle="modal" data-target="#modaldata1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-file-earmark-excel-fill" viewBox="0 0 16 16">
                                <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM5.884 6.68 8 9.219l2.116-2.54a.5.5 0 1 1 .768.641L8.651 10l2.233 2.68a.5.5 0 0 1-.768.64L8 10.781l-2.116 2.54a.5.5 0 0 1-.768-.641L7.349 10 5.116 7.32a.5.5 0 1 1 .768-.64z"/>
                              </svg>
                              Extracto de dívida
                           
                        </button>
                    </div>


                    <div class="col-6">
                        <div class="float-right">
                        <button style="color: green;"  class="mr-3" data-toggle="modal" data-target="#modaldataexcel">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-file-earmark-excel-fill" viewBox="0 0 16 16">
                                <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM5.884 6.68 8 9.219l2.116-2.54a.5.5 0 1 1 .768.641L8.651 10l2.233 2.68a.5.5 0 0 1-.768.64L8 10.781l-2.116 2.54a.5.5 0 0 1-.768-.641L7.349 10 5.116 7.32a.5.5 0 1 1 .768-.64z"/>
                              </svg>
                            Extracto de pagamento
                        </button> <br>
                        <button style="color: green;" class="mt-2" data-toggle="modal" data-target="#modaldataexcel">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-file-earmark-excel-fill" viewBox="0 0 16 16">
                                <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM5.884 6.68 8 9.219l2.116-2.54a.5.5 0 1 1 .768.641L8.651 10l2.233 2.68a.5.5 0 0 1-.768.64L8 10.781l-2.116 2.54a.5.5 0 0 1-.768-.641L7.349 10 5.116 7.32a.5.5 0 1 1 .768-.64z"/>
                              </svg>
                            Extracto de dívida
                        </button>
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




<!-- modal buscar extrato de pagamentos -->
<div class="modal fade" id="modaldata1" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Extracto de Dívida</h5>
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

                                <form target="_blank" id="formextrato-pagamento" action="{{url('/dashboard/extrato-de-divida')}}" method="Post" novalidate="novalidate">
                                    @csrf

                                    <div class="row">
                                        
                                                <div class="col-6">
                                                    <label for="data1" class="control-label mb-1">Data inicio</label>
                                                    <div class="input-group">
                                                        <input id="data1" name="datainicio" type="month" class="form-control"  required>
                                                    </div>
                                                </div>
                                         
                                      
                                        <div class="col-6">
                                            <label for="data2" class="control-label mb-1">Data de fim </label>
                                            <div class="input-group">
                                                <input id="data2" name="datafim" type="month" class="form-control"  required>
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