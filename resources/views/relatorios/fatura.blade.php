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
                             $totais= (float)$total;
                                
                                $total=number_format($totais, 2,",",".") ;
                                //
                                $multa=(float)$multas;
                                $multas=number_format($multa, 2,",",".");
            
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
                                <th>COMPROVATIVO DE PAGAMENTO</th>
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
                                <td style="text-align: center;">{{$pg[0]->id}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div>
                        <fieldset class="border p-2">
                            <div class="row">
                                <div class="col">
                                    <label for="">Exmo(s).Sr(s): <strong>{{$pg[0]->cliente}}</strong></label><br>
                                    <label for="">NIF: <strong>{{$pg[0]->nif}}</strong></label><br>
                                    <label for="">Endereço:<strong> {{$pg[0]->morada}} </strong></label><br>
                                    <label for="">PT:<strong> {{$pg[0]->pt}} </strong></label><br>
                                    <label for="">Contribuinte PT</label>
                                </div>
                            </div>
                            
                        </fieldset>
                    </div>
                    
               
                </div>

                <div style="clear: both; ">
                    <table style="padding-top: 15px; width: 100%; ">
                        <thead style="background-color: black; color:white; height: 40px; border:none;">
                            <tr>
                                <th>Id</th>
                                <th>Mês</th>
                                <th>Ano</th>
                                <th>Data Pagamento</th>
                                <th>Valor</th>
                                <th>Multa</th>
                              
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($pg))
                                @foreach($pg as $p)
                            <tr>
                                <td>{{$p->idpagamento}}</td>
                                <td>{{$p->mes}}<</td>
                                <td>{{$p->ano}}<</td>
                                <td>{{$p->data}}<</td>
                               
                                @php 
                                //formatando o valor que vem da BD no formato de dinheiro
                                $valor = number_format($p->valor, 2,",",".");
                                $multa = number_format($p->multa, 2,",",".");
                                @endphp
                                 <td >{{$valor}}</td>
                                 <td >{{$multa}}</td>
                             
                            </tr>

                                @endforeach
                                <tr>
                                    @php
                                    
                                    @endphp

                                    @if($i==1)
                                     @php
                                     //dd($total);
                                     @endphp
                                    @endif

                                    
                                    <td ><strong>Total</strong></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td> <strong> {{number_format($totais, 2,",",".")}}</strong> </td>
                                    <td><strong>{{ $multas  }}</strong></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    
                </div>
                <br>
                 <br>
                 <p style="text-align: center">Processado por computador</p>
                <p style="text-align: center">Emitido em:{{date('d/m/y H:i:s')}}  por: {{Auth::user()->name}}</p>
                @if($i==0)
                <br><br><br>
               
               <P style="width: 100%;">--------------------------------------------------------------------------------------------------------------------------------------</P>
                @endif
        </div>
      
        @endfor
       

      

        

       
    </body>
</html>