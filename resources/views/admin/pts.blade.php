@extends('layouts.template')

@section('title', 'Pts')


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




        <div class="row mb-3">
            <div class="col-md-12">
                <div class="overview-wrap">
                    <h2 class="title-1">PTs</h2>
                    <button class="au-btn au-btn-icon au-btn--blue" data-toggle="modal" data-target="#registarusuarioModal" >
                        <i class="zmdi zmdi-plus"></i>Registar</button>
                </div>
            </div>
        </div>

        @if(isset($sms))

                <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                    <span class="badge badge-pill badge-success">Success</span>
                    {{$sms}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                @endif

        <table class="table">
            <thead class="table-dark">
                <tr>
                        <th>Id</th>
                        <th>Localização</th>
                        <th>Acções</th>
                    </tr>
              
            </thead>
            <tbody>
          @foreach($pt as $p)
                <tr>
                    <td>{{$p->id}}</td>
                    <td>{{$p->localizacao}}</td>
                   
                    <td> 
                        <button class="btn btn-sm btn-primary">
                            <a href="{{url("/dashboard/Pts/show/$p->id")}}" class="bnEditar">Alterar</a>
                        </button>
                        @can('Administrador')
                            <button class="btn btn-sm btn btn-danger eliminar" id="{{$p->id}}" onclick="retornaid({{$p->id}})" data-toggle="modal"   data-target="#smallmodal">
                                <ion-icon name="trash-outline"></ion-icon> Eliminar
                            </button>
                         @endcan
                    </td>
                   

                </tr>
               @endforeach
            </tbody>
          </table>
    </div>
</div>




<!-- modal registar usuario -->
<div class="modal fade" id="registarusuarioModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Registar PTs</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form id="form-registar" action="{{url('/dashboard/Pts/store')}}" method="Post" novalidate="novalidate">
                                    <div hidden class="sufee-alert alert with-close alert-danger alert-dismissible fade show" id="erro">
                                    </div>
                                    @csrf

                                    <div class="row mb-3">
                                        
                                        <div class="col-12">
                                            <label for="local" class="control-label mb-1">Localização</label>
                                            <div class="input-group">
                                                <input id="local" name="localizacao" type="text" class="form-control"  required>
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
                <form action="{{url("/dashboard/Pts/delete")}}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" value="" name="pt_id" id="pt_id">
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
        $('#multa').mask('#.##0,00',{reverse: true});

         //validação do formulario alterar
         btn_registar=document.getElementById("btn-registar");
        btn_registar.addEventListener('click', (event)=>{

            event.preventDefault();
            var form=document.getElementById("form-registar");
            var local=document.getElementById("local").value;
            var erro=document.getElementById("erro");

            if(local == ''){
                erro.innerHTML="O campo <strong> localização </strong> é Obrigatório ";
                erro.removeAttribute('hidden');
                local.focus();
                return false;
            }else{
                erro.setAttribute('hidden', true);
                form.submit();
            }


        });


    });
    function retornaid(id){
            $('#pt_id').val(id);
        }
         
</script>

@endsection