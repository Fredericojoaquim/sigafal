
@extends('layouts.template')

@section('title', 'Devedores')


@section('content')

<div class="section__content section__content--p30">
    <div class="container-fluid">

   


                 <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="overview-wrap">
                            <h2 class="title-1">Devedores</h2>
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
                        <th>Qtd de Mêses</th>
                        <th>Último Pagamento</th>
                    </tr>
                
            </thead>
            <tbody>
                
            @if(isset($devedor))
                  @for($i = 0; $i< count($devedor); $i++)
                
                <tr >
                    <td>{{ $devedor[$i]->id}}</td>
                    <td>{{ $devedor[$i]->cliente}}</td>
                    <td>{{ $devedor[$i]->nif}}</td>
                    <td style="color: red">{{ $qtdmes[$i]}}</td>
                    <td>{{ $devedor[$i]->ultimo_pagamento}}</td>

                </tr>
                @endfor  
            @endif 

            </tbody>
          </table>
        </div>
    </div>
</div>




<!-- modal meses dem divida -->
<div class="modal fade" id="meses_em_divida" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
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
                                        <label for="nome" class="control-label mb-1">Cliente: </label>
                                    </div>

                                    <div class="col-6">
                                        <label for="nif" class="control-label mb-1">Usuário: </label>            
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
     
     
    });

    
  
    
    
    $(document).ready(function(){
        //codigo para inicializar a data table
       var table=$('#datatable').DataTable();   
    });
      
</script>

@endsection