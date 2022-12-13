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
                    <form action="{{url('/dashboard/pagamentos/salvar-dados-pagamento')}}" id="formulario-pagamento" method="Post" novalidate="novalidate">
                        <div hidden id="erro_dados_pagamento" class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                            <span class="badge badge-pill badge-danger">Erro</span>
                            <p id="texto-erro"></p>
                        </div>
                        @csrf
                    
                      
                            
                        <div class="card">
                            <div class="card-body">
                        
                       
                        <div class="row">

                            <div class="col-6">
                                
                                <label for="data" class="control-label mb-1">Mês e ano</label>
                                <div class="input-group">
                                     <input id="data" name="data" type="month" min="0" class="form-control mespagamento"  required>
                                 </div>
                            </div>

                            <div class="col-6">
                                <label for="codigopagamento" class="control-label mb-1">Codigo Pagamento</label>
                                <select name="codigopagamento" id="codigopagamento" class="form-control required">
                                   @if(isset($codigopagamento))
                                    <option value="{{$codigopagamento}}">{{$codigopagamento}}</option>
                                    @endif
                                </select>
                            </div>

                            <div class="col-6">
                                <label for="valorbanco" class="control-label mb-1">Valor em Banco</label>
                                <div class="input-group">
                                     <input id="valorbanco"  name="valorbanco" value="{{number_format(0, 2,",",".")}}" min="0" class="form-control preco"  required>
                                 </div>
                            </div>

                            
                            <div class="col-6">
                                <label for="valorcaixa" class="control-label mb-1">Valor em Caixa</label>
                                <div class="input-group">
                                     <input id="valorcaixa"  name="valorcaixa" value="{{number_format(0, 2,",",".")}}"  min="0" class="form-control preco"  required>
                                 </div>
                            </div>

                            <div class="col-12" id="valor_multa">
                                <label for="banco" class="control-label mb-1">Valor da Multa</label>
                                <input id="valor_multa" name="valor_multa"  value="{{number_format(0, 2,",",".")}}"  min="0" class="form-control multa_valor"  required>
                                 
                            </div>

                         

                            
                            

                            
                        </div>

                        

                        </div>
                    </div>
                 
                        <div class="">
                            <button type="submit" id="btnconcluir" class="btn col-12 btn-primary">Registar</button>
                        </div>

                        @if(isset($codimpressao))

                       

                        @endif

                    </form>


                    <p class="mt-2" style="text-align: center;"> <a style="color:green;" href="{{url("/pagamentos/recibo$codigopagamento")}}" target="_blank">Imprimir a Factura</a> </p>
                    <p class="mt-2" style="text-align: center;"> <a style="color:red;" href="{{url("/dashboard")}}" target="_blank">Sair</a> </p>
                    
                  </div>
              </div>
        </div>
    </div>
</div>


<script>
    
    

    $(document).ready(function(){
        $('.preco').mask('#.##0,00',{reverse: true});
       // $('.multa_valor').val(000);
        $('.multa_valor').mask('#.##0,00',{reverse: true});
      //  $('#valorcaixa').val(000);
        //$('#valorbanco').val(000);
        $('#valorcaixa').mask('#.##0,00',{reverse: true});
        $('#valorbanco').mask('#.##0,00',{reverse: true});
        


       
        
        
        formulario=document.getElementById("formulario-pagamento");
        var concluir=document.getElementById("btnconcluir");
        concluir.addEventListener('click', (event)=>{
           var meses=document.getElementsByClassName("mespagamento");
           var erro=document.getElementById("erro_dados_pagamento");
           var textoerro=document.getElementById("texto-erro");
           var valorbanco=document.getElementsByClassName("valorbanco");
           var valorcaixa=document.getElementsByClassName("valorcaixa");
           var multa=document.getElementsByClassName("multa_valor");

            event.preventDefault();
          
               if( meses.value==''){
                textoerro.innerHTML="O campo <strong>mês e ano</strong> é de carcater obrigatório";
                erro.removeAttribute('hidden');
                return false;
               }else{
                erro.setAttribute('hidden', true);
               }
            

          
               if( valorbanco.value==''){
                textoerro.innerHTML="O campo <strong>valor em banco </strong> é de preenchimento Obrigatório";
                erro.removeAttribute('hidden');
                return false;
               }else{
                erro.setAttribute('hidden', true);
               }


               if( valorcaixa.value==''){
                textoerro.innerHTML="O campo <strong>valor em caixa </strong> é de preenchimento Obrigatório";
                erro.removeAttribute('hidden');
                return false;
               }else{
                erro.setAttribute('hidden', true);
               }


            

           
               if( multa.value==''){
                textoerro.innerHTML="O campo <strong>multa </strong> é de preenchimento Obrigatório";
                erro.removeAttribute('hidden');
                return false;
               }else{
                erro.setAttribute('hidden', true);
                formulario.submit();
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