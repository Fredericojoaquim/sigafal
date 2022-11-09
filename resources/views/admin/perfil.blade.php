@extends('layouts.template')

@section('title', 'Pagamento')


@section('content')

@php
$caminho='imagens'.'/'.$u->imagem;
@endphp
            
<div class="section__content section__content--p30">
    <div class="container-fluid">

        <div class="row">
            <div class="image imagem-profile">
                 <img class="" src="{{url("$caminho")}}" alt="">
                 <p style="text-align: center">Nome: {{$u->name}}</p>
                 <p style="text-align: center">Email: {{$u->email}}</p>
                 <p style="text-align: center">Estado: {{$u->estado}}</p>
                 <a  href="">Alterar</a>
            </div>
        </div>

       
    </div>
</div>

<script>
      $(document).ready(function(){
        $('#valor').mask('#.##0,00',{reverse: true});

       
      });

      function validar(){
      //form=document.getElementById("form_pag");
       // alert('ss');
      
         
      }

         btn=document.getElementById("btne");
         myform=document.getElementById("form_pag");
        btn.addEventListener('click', (event)=>{
            event.preventDefault();
           // event.preventDefault();
           
           var modo= document.getElementById("modo_pagamento").value;
           var banco= document.getElementById("banco").value;
           var qtd= document.getElementById("qtd").value;
           var id_documento= document.getElementById("id_documento").value;
           var erro= document.getElementById("erro");
          
           if(modo=="Selecione"){
            erro.innerHTML="Porfavor selecione uma opção do modo de pagamento";
            erro.removeAttribute('hidden');
            return false;
           }else{
            erro.setAttribute('hidden', true);
           }

           if(banco=="Selecione"){
            erro.innerHTML="Porfavor selecione um nome do Banco";
            erro.removeAttribute('hidden');
            return false;
           }else{
            erro.setAttribute('hidden', true);
           }

           if(qtd==""){
            erro.innerHTML="Porfavor digite a quantidade de mês a ser pago";
            erro.removeAttribute('hidden');
            return false;
           }else{
            erro.setAttribute('hidden', true);
           }

           if(qtd<0 || qtd==0){
            erro.innerHTML="Porfavor digite uma quantidade válida";
            erro.removeAttribute('hidden');
            return false;
           }else{
            erro.setAttribute('hidden', true);
           }

           if(id_documento==""){
            erro.innerHTML="Porfavor digite o ID do documento bancário";
            erro.removeAttribute('hidden');
            return false;
           }else{
            erro.setAttribute('hidden', true);
            myform.submit();
           }
           

           
           
            
        });

        function gerarNumero(){
    
            var modo=document.getElementById("modo_pagamento").value;
            if(modo == "Cash"){
                
                $('#id_documento').val(Date.now());
                $('#banco').val('N/h');
                $('#banco').setAttribute('disable',true);

            }else{
               
                $('#id_documento').val('');
            }
            
        }

     
</script>

@endsection