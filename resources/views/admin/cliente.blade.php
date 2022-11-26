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
                    <h2 class="title-1">Clientes</h2>
                    <button class="au-btn au-btn-icon au-btn--blue" data-toggle="modal" data-target="#registarusuarioModal" >
                        <i class="zmdi zmdi-plus"></i>Registar</button>
                </div>
            </div>
        </div>
        <div class="myresponsivetable table-responsive table-responsive-data3 ">
        <table class="table" id="datatable">
            <thead class="table-dark">
           
                <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Nif</th>
                        <th>Morada</th>
                        <th>Telefone</th>
                        <th>Email</th>
                        <th>Tipo</th>
                        <th>Mensalidade</th>
                        <th>Serviço</th>
                        <th>PT</th>
                        <th>Acções</th>
                    </tr>
                
            </thead>
            <tbody>
                

               
            @if(isset($cliente))
                  @foreach($cliente as $c)

                  @php 
                  //  formatando o valor que vem da BD no formato de dinheiro
                   $valor = number_format($c->preco, 2,",",".");
    
                    @endphp
                <tr>
                    <td>{{ $c->id}}</td>
                    <td>{{ $c->nome}}</td>
                    <td>{{ $c->nif}}</td>
                    <td>{{ $c->morada}}</td>
                    <td>{{ $c->telefone}}</td>
                    <td>{{ $c->email}}</td>
                    <td>{{ $c->tipo}}</td>
                    <td>{{ $valor}}</td>
                    <td>{{ $c->servico}}</td>
                    <td>{{ $c->pt}}</td>
                    <td class="d-flex justify-content-center"> 
                        <button class="mr-1 btn btn-sm btn-outline-primary editar" id="">
                            <a class="bnEditar" href="{{url("/dashboard/clientes/show/$c->id")}}">Alterar</a>
                        </button>
                        @can('Administrador')
                            <button class="btn btn-sm btn btn-danger eliminar" id="{{$c->id}}" onclick="retornaid({{$c->id}})" data-toggle="modal"   data-target="#smallmodal">
                                <ion-icon name="trash-outline"></ion-icon> Eliminar
                            </button>
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




<!-- modal registar Clientes -->
<div class="modal fade" id="registarusuarioModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Registar Clientes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form id="form-registar-cliente" action="{{url('/dashboard/clientes/store')}}" method="Post" novalidate="novalidate">
                                    <div hidden class="sufee-alert alert with-close alert-danger alert-dismissible fade show" id="erro-registar">
                                    </div>
                                    @csrf

                                    <div class="row">
                                        
                                        <div class="col-6">
                                            <label for="nome" class="control-label mb-1">Nome</label>
                                            <div class="input-group">
                                                <input id="nome" name="nome" type="text" class="form-control"  required>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <label for="nif" class="control-label mb-1">Nif</label>
                                            <div class="input-group">
                                                <input id="nif" name="nif" type="text" class="form-control"  required>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        
                                        <div class="col-6">
                                            <label for="morada" class="control-label mb-1">Morada</label>
                                            <div class="input-group">
                                                <input id="morada" name="morada" type="text" class="form-control"  required>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <label for="telefone" class="control-label mb-1">Telefone</label>
                                            <div class="input-group">
                                                <input id="telefone" name="telefone" type="text" class="form-control"  required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        
                                        <div class="col-6">
                                            <label for="email" class="control-label mb-1">Email</label>
                                            <div class="input-group">
                                                <input id="email" name="email" type="text" class="form-control"  required>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="row form-group">
                                                <div class="col col-md-12">
                                                    <label for="tipo" class=" form-control-label">Tipo</label>
                                                </div>
                                                <div class="col-12 col-md-12">
                                                    <select name="tipo" id="tipo" class="form-control">
                                                        <option selected="Selecione">Selecione</option>
                                                        <option value="Particular">Particular</option>
                                                        <option value="Empresa">Empresa</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        
                                    </div>


                                    <div class="row">
                                        
                                        <div class="col-6">
                                            <div class="row form-group">
                                                <div class="col col-md-12">
                                                    <label for="servico" class=" form-control-label">Serviço</label>
                                                </div>
                                              
                                                <div class="col-12 col-md-12">
                                                    <select name="servico" id="servico" class="form-control">
                                                        <option selected="selected">Selecione</option>
                                                        @foreach($servicos as $s)
                                                        <option value="{{$s->id}}">{{$s->descricao}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-6">
                                            <div class="row form-group">
                                                <div class="col col-md-12">
                                                    <label for="pt" class=" form-control-label">PT</label>
                                                </div>
                                                <div class="col-12 col-md-12">
                                                    <select name="pt" id="pt" class="form-control">
                                                        <option selected="selected">Selecione</option>
                                                        @foreach( $pt as $p)
                                                        <option value="{{$p->id}}">{{$p->localizacao}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-6">
                                            <label for="preco" class="control-label mb-1">Preço</label>
                                            <div class="input-group">
                                                <input id="preco" name="preco" type="text" class="form-control"  required>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <label for="observacao" class="control-label mb-1">Observação</label>
                                            <div class="input-group">
                                                <input id="observacao" name="observacao" type="text" class="form-control"  required>
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <div class="text-right">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" id="btn-registar-cliente" class="btn btn-primary">Confirmar</button>
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




<!-- modal Alterar Clientes -->
<div class="modal fade" id="alterarclienteModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Alterar Clientes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{url('/dashboard/clientes/store')}}" method="Post" novalidate="novalidate">
                                    @csrf

                                    <div class="row">
                                        
                                        <div class="col-6">
                                            <label for="nome" class="control-label mb-1">Nome</label>
                                            <div class="input-group">
                                                <input id="nome" name="nome" type="text" class="form-control"  required>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <label for="nif" class="control-label mb-1">Nif</label>
                                            <div class="input-group">
                                                <input id="nif" name="nif" type="text" class="form-control"  required>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        
                                        <div class="col-6">
                                            <label for="morada" class="control-label mb-1">Morada</label>
                                            <div class="input-group">
                                                <input id="morada" name="morada" type="text" class="form-control"  required>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <label for="telefone" class="control-label mb-1">Telefone</label>
                                            <div class="input-group">
                                                <input id="telefone" name="telefone" type="text" class="form-control"  required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        
                                        <div class="col-6">
                                            <label for="email" class="control-label mb-1">Email</label>
                                            <div class="input-group">
                                                <input id=email" name="email" type="text" class="form-control"  required>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="row form-group">
                                                <div class="col col-md-12">
                                                    <label for="select" class=" form-control-label">Tipo</label>
                                                </div>
                                                <div class="col-12 col-md-12">
                                                    <select name="tipo" id="select" class="form-control">
                                                        <option selected="selected">Selecione</option>
                                                        <option value="Particular">Particular</option>
                                                        <option value="Empresa">Empresa</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        
                                    </div>


                                    <div class="row">
                                        
                                        <div class="col-6">
                                            <div class="row form-group">
                                                <div class="col col-md-12">
                                                    <label for="select" class=" form-control-label">Serviço</label>
                                                </div>
                                              
                                                <div class="col-12 col-md-12">
                                                    <select name="servico" id="select" class="form-control">
                                                        <option selected="selected">Selecione</option>
                                                        @foreach($servicos as $s)
                                                        <option value="{{$s->id}}">{{$s->descricao}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-6">
                                            <div class="row form-group">
                                                <div class="col col-md-12">
                                                    <label for="select" class=" form-control-label">PT</label>
                                                </div>
                                                <div class="col-12 col-md-12">
                                                    <select name="pt" id="select" class="form-control">
                                                        <option selected="selected">Selecione</option>
                                                        @foreach( $pt as $p)
                                                        <option value="{{$p->id}}">{{$p->localizacao}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <label for="preco" class="control-label mb-1">Preço</label>
                                            <div class="input-group">
                                                <input id="preco" name="preco" type="text" class="form-control"  required>
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <div class="text-right">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary">Confirmar</button>
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
                <form action="{{url("/dashboard/clientes/delete")}}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="hidden"  name="cliente_id" id="cliente_id">
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
        $('#preco').mask('#.##0,00',{reverse: true});
        $('#telefone').mask('+244 000-000-000');
    });

    
    $(document).on('click','.editar',function(){
        //$('#alterarServicoModal').modal('show');
    });   
    
    
    $(document).ready(function(){
        //codigo para inicializar a data table
      var table=$('#datatable').DataTable();
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

     
            
        });

        function retornaid(id){
            $('#cliente_id').val(id);
     }

   
</script>

@endsection