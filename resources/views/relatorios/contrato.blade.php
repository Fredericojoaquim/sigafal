<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
       
        <title>Relatório</title>
    </head>
    <body>
        <style>
            *{
                margin:0;
                padding:0;
                border:0;
            }
        </style>

            @php
                             /*$totais= (float)$total;
                                
                                $total=number_format($totais, 2,",",".") ;
                                //
                                $multa=(float)$multas;
                                $multas=number_format($multa, 2,",",".");*/
            
            @endphp
        @for($i=0; $i<2; $i++)
        <div style="width: 90%; margin: 0 auto; padding: 0;">
            
               
                <div style="float: left; width: 40% margin:0px; padding:0px;">
                    <div class="col-12" id="logotipo">
                       <img src="{{ public_path('images/nb.png')}}" alt="" style="width: 110px; height: 130px;  ">          
                    </div><br>

                    <div id="cabecario" style="margin-top:-50px; ">
                        <h6>N&B Comércio Geral, LDA</h6>  
                        <h6>RUA DIREITA-PARTE BRAÇO ZONA 20 <br> BAIRRO DANGEREUX <br>LUANDA-ANGOLA</h6>           
                    </div><br>
                    <div id="dados_enpresa">
                        <label for="">Telefone: 944337971</label><br>
                        <label for="">Iban:<strong> AO06005500003125130810136 </strong></label>
                    </div><br>
                    <br><br>
                </div>

                <div style="padding-top: 120px; width: 58%; float: left; padding-left: 2%">
                    <table style="width: 100%;">
                        <thead class="table-dark">
                            <tr style="background-color: black; color:white; height: 40px;">
                                <th>CONTRATO</th>
                                <th>Nº: </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @if($i==0) 
                                <td> ( Original )  </td>
                                @else
                                <td> ( Duplicado)  </td>
                                @endif
                                <td style="text-align: center;">{{$c[0]->id}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div style="">
                        <fieldset class="border p-2">
                            <div class="row">
                                <div class="col">
                                    <label for="">Exmo(s).Sr(s): <strong>{{$c[0]->nome}}</strong></label><br>
                                    <label for="">NIF: <strong>{{$c[0]->nif}}</strong></label><br>
                                    <label for="">Contacto:<strong> {{$c[0]->telefone}} </strong></label><br>
                                    <label for="">PT:<strong> {{$c[0]->localizacao}} </strong></label><br>
                                    <label for="">Valor do contrato: <strong> {{number_format($c[0]->precocontrato, 2,",",".")}}</strong> </label><br>
                                    <label for="">Modo de pagamento: <strong> {{$c[0]->modopagamento}} </strong> </label><br>
                                </div>
                            </div>
                            
                        </fieldset>
                    </div>
                    
             
                </div>

                <div style="clear: both; margin-top: 10px; ">
                    <ol>
                        <li>O contrato de energia não se aluga nem se troca com outra pessoa e não há devolução, o valor é de: <strong>{{number_format($c[0]->precocontrato, 2,",",".")}}</strong> Kz pagamento 100%</li>
                        <li>A mensalidade é de :<strong>{{number_format($c[0]->preco, 2,",",".")}}</strong> KZ os pagamentos são feitos através de conta bancária</li>
                        <li>O consumidor tem que pagar o mês consumido até dia 10 do mês seguinte</li>
                        <li>O não cumprimento da mensalidade na data prevista implicará a multa de 50% do valor cobrabo</li>
                        <li>A transmissão de energia a terceiros será punivel ao corte definitivo sem aviso prévio e a anulação do contrato</li>
                        <li>O valor mês será alterado sempre que se verifique alteração no custo da ENDE</li>
                        <li>O consumidor que tiver mais de 1 mês sem liquidar a sua mensalidade será passível a anulação do contrato</li>
                        <li> <strong>Nº de contas bancárias, BFA 119139919/30 KZ, BIC 91330091/10, MILLENNIUM 5006589141, BPC 0049-M152270-011 </strong> </li>
                    </ol>
                    
                </div>
                <p style="text-align: center">Processado por Computador</p>
                <p style="text-align: center">Emitido em:{{date('d/m/y H:i:s')}}  por: {{Auth::user()->name}}</p>
                @if($i==0)
              
               <P style="width: 100%;">--------------------------------------------------------------------------------------------------------------------------------------</P>
                @endif
                @php

                @endphp
                
        </div>
      
        @endfor
       

      

        

       
    </body>
</html>