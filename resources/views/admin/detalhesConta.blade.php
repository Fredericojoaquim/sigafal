@extends('layouts.template2')

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
                    <h2 class="title-1">Histórico de Operações</h2>
                    
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
                        <th>Débito</th>
                        <th>Crédito</th>
                        <th>Data</th>
                       
                    </tr>
                
            </thead>
            <tbody>
                

               
            @if(isset($contas))
                  @foreach($contas as $c)

                  @php 
                  //  formatando o valor que vem da BD no formato de dinheiro
                 
    
                    @endphp
                <tr>
                    <td>{{$c->codigo}}</td>
                    <td>{{$c->nome}}</td>
                    <td>{{$c->nif}}</td>
                    <td class="status--process">{{number_format($c->debito, 2,",",".")}}</td>
                    <td class="status--denied">{{number_format($c->credito, 2,",",".")}}</td>
                    <td>{{$c->data}}</td>
                   
                    
                   

                </tr>
                @endforeach
                   
            @endif 
            </tbody>
          </table>
        </div>
    </div>
</div>




<!-- modal registar Clientes -->
<div class="modal fade" id="registarusuarioModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Movimentar Conta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form id="form-movimetar-conta" action="{{url('/dashboard/contas/store')}}" method="Post" novalidate="novalidate">
                                    <div hidden class="sufee-alert alert with-close alert-danger alert-dismissible fade show" id="erro-registar">
                                    </div>
                                    @csrf

                                    <div class="row">
                                        <div class="col-6">
                                            <div class="row form-group">
                                                <div class="col col-md-12">
                                                    <label for="tipo" class=" form-control-label">Tipo de Operação</label>
                                                </div>
                                                <div class="col-12 col-md-12">
                                                    <select name="tipo" id="tipo" class="form-control">
                                                        <option selected="Selecione">Selecione</option>
                                                        <option value="Débito">Débito</option>
                                                        <option value="Crédito">Crédito</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-6">
                                            <label for="valor" class="control-label mb-1">Valor</label>
                                            <div class="input-group">
                                                <input id="valor" value="{{number_format(0, 2,",",".")}}" name="valor" type="text" class="form-control"  required>
                                                <input id="conta_id"  name="conta_id" type="text" hidden>
                                                
                                                
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









<script>
    $(document).ready(function(){
        //mascaras com jmask
        $('#valor').mask('#.##0,00',{reverse: true});
        
    });

    
    $(document).on('click','.editar',function(){
        //$('#alterarServicoModal').modal('show');
    });   
    
    
    $(document).ready(function(){
        //codigo para inicializar a data table
     // var table=$('#datatable').DataTable();
         //validação do formulário registar cliente
         btn_registar=document.getElementById("btn-registar");
        btn_registar.addEventListener('click', (event)=>{
            event.preventDefault();
            var form=document.getElementById("form-movimetar-conta");
            var valor=document.getElementById("valor").value;
            var tipo=document.getElementById("tipo").value;
            var erro= document.getElementById("erro-registar");
           
            
            if(tipo == 'Selecione'){
                
                erro.innerHTML="Selecione um tipo de Operação";
                erro.removeAttribute('hidden');
               
                return false;
            }else{
                erro.setAttribute('hidden', true);
            }
            if(valor=='0,00' || valor<0 ){
                erro.innerHTML="Por favor digite um valor válido";
                erro.removeAttribute('hidden');
                nome.focus();
                return false;

            }else{
                erro.setAttribute('hidden', true);
                form.submit();
            }
            
        });

     
            
        });

        function retornaid(id){
            $('#conta_id').val(id);
     }

   
</script>

@endsection