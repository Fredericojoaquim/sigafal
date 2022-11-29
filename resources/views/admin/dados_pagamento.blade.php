@extends('layouts.template')

@section('title', 'Dados Pagamento')


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

                 @if(session()->has('sms_erro'))

                 <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                     <span class="badge badge-pill badge-danger">erro</span>
                 
                     {{ session()->get('sms_erro') }}
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
 
                 @endif


        <div class="row mb-3">
            <div class="col-md-12">
                <div class="overview-wrap">
                    <h2 class="title-1"></h2>
                </div>
            </div>
        </div>
        <div class="myresponsivetable table-responsive table-responsive-data3 ">
            
            <div class="container">
         
                <div class="row ml-4">
                  
                  <div class="col-md-12">
                   <h4 class="title-3">Dados para o Pagamento</h4><hr>
                   
                   <!-- /dashboard/pagamento/store -->
                    <form action="/dashboard/pagamento/store" id="formulario-pagamento" method="Post" novalidate="novalidate">
                        <div hidden id="erro_dados_pagamento" class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                            <span class="badge badge-pill badge-danger">Erro</span>
                            <p id="texto-erro"></p>
                        </div>
                        @csrf
                    
                        @for ($i=0; $i<$qtd; $i++)
                            
                        <div class="card">
                            <div class="card-body">
                        
                       
                        <div class="row">

                            <div class="col-6">
                                
                                <label for="data" class="control-label mb-1">Mês e ano</label>
                                <div class="input-group">
                                     <input id="data{{$i+1}}" name="data{{$i+1}}" type="month" min="0" class="form-control mespagamento"  required>
                                 </div>
                            </div>

                            <div class="col-6">
                                
                                <label for="preco" class="control-label mb-1">Valor</label>
                                <div class="input-group">
                                     <input id="preco{{$i+1}}"  name="preco{{$i+1}}"  min="0" class="form-control preco"  required>
                                 </div>
                            </div>

                            

                            <div class="col-12" id="valor_multa">
                                <label for="banco" class="control-label mb-1">Valor da Multa</label>
                                <input id="valor_multa{{$i+1}}" name="valor_multa{{$i+1}}"   min="0" class="form-control multa_valor"  required>
                                 
                            </div>

                            
                            

                            
                        </div>

                        

                        </div>
                    </div>
                     @endfor
                        <div class="">
                            <button type="submit" id="btnconcluir" class="btn col-12 btn-primary">Concluir Pagamento</button>
                        </div>

                    </form>
                    
                  </div>
              </div>
        </div>
    </div>
</div>


<script>
    
    

    $(document).ready(function(){
        $('.preco').mask('#.##0,00',{reverse: true});
        $('.multa_valor').val(000);
        $('.multa_valor').mask('#.##0,00',{reverse: true});
        


       
        
        
        formulario=document.getElementById("formulario-pagamento");
        var concluir=document.getElementById("btnconcluir");
        concluir.addEventListener('click', (event)=>{
           var meses=document.getElementsByClassName("mespagamento");
           var erro=document.getElementById("erro_dados_pagamento");
           var textoerro=document.getElementById("texto-erro");
           var preco=document.getElementsByClassName("preco");
           var multa=document.getElementsByClassName("multa_valor");

            event.preventDefault();
            for(var i=0; i<meses.length; i++){
               if( meses[i].value==''){
                textoerro.innerHTML="O campo <strong>mês e ano</strong> é de carcater obrigatório";
                erro.removeAttribute('hidden');
                return false;
               }else{
                erro.setAttribute('hidden', true);
               }
            }

            for(var i=0; i<preco.length; i++){
               if( preco[i].value==''){
                textoerro.innerHTML="O campo <strong>valor </strong> é de preenchimento Obrigatório";
                erro.removeAttribute('hidden');
                return false;
               }else{
                erro.setAttribute('hidden', true);
               }
            }

            for(var i=0; i<multa.length; i++){
               if( multa[i].value==''){
                textoerro.innerHTML="O campo <strong>multa </strong> é de preenchimento Obrigatório";
                erro.removeAttribute('hidden');
                return false;
               }else{
                erro.setAttribute('hidden', true);
                formulario.submit();
               }

            }
        
            });
     });
     
     /*var concluir=document.getElementById("btnconcluir");
     alert('teste');
     concluir.addEventListener('click', (event)=>{
        alert('entrou');
        event.preventDefault();
     });
       // 
       /* console.log(
            document.getElementsByClassName("mespagamento");
        )*7

        
       
       

    function alterar(){
       
        var multa=document.getElementsByClassName("multa_valor");
         var total=multa.length;
        for(var i=0; i<total; i++){
            multa[i].innerHTML="0";
           // multa[i].disabled=true;
        }
         
     }*/


</script>



@endsection