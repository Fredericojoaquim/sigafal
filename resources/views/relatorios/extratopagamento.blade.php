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
   
        <div style="width: 90%; margin: 0 auto; padding: 0;">
            
               
                <div style="float: left; width: 40% margin:0px; padding:0px;">
                    <div class="col-12" id="logotipo">
                       <img src="{{ public_path('images/nb.png')}}" alt="" style="width: 110px; height: 130px;  ">          
                    </div><br>

                    <div id="cabecario" style="margin-top:-50px; font-size: 15px;">
                        <h6>N&B Comércio Geral, LDA</h6>  
                        <h6>RUA DIREITA-PARTE BRAÇO ZONA 20 <br> BAIRRO DANGEREUX <br>LUANDA-ANGOLA</h6>           
                    </div><br>
                    <div id="dados_enpresa">
                        <label for="">Telefone: 944337971</label><br>
                        <label for="">Iban:<strong> AO06005500003125130810136 </strong></label>
                    </div><br>
                    <br><br>
                </div>

                

                <div style="clear: both; ">
                    <h3 style="text-align:center; font-size: 30px;">Extracto de Pagamentos</h3>
                    <table style="padding-top: 15px; width: 100%; ">
                        <thead style="background-color: black; color:white; height: 40px; border:none;">
                            <tr>
                                <th>Id</th>
                                <th>Cliente</th>
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
                                <td>{{$p->cliente}}</td>
                                <td>{{$p->mes}}<</td>
                                <td>{{$p->ano}}<</td>
                                <td style="text-align: center;">{{$p->data}}<</td>
                               
                                @php 
                                //formatando o valor que vem da BD no formato de dinheiro
                                $valor = number_format($p->valor, 2,",",".");
                                $mt = number_format($p->multa, 2,",",".");

                                $totais= (float)$total;
                                $total_tudo=number_format($totais, 2,",",".") ;
                                
                              

                                $multas=(float) $multa;
                                $multas_tudo=number_format($multas, 2,",",".")
                
                                @endphp
                                 <td >{{$valor}}<</td>
                                 <td >{{$mt}}<</td>
                             
                            </tr>

                                @endforeach
                                <tr>
                                    <td ><strong>Total</strong></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td> <strong>{{ $total_tudo}}</strong> </td>
                                    <td><strong>{{ $multas_tudo  }}</strong></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    
                </div>
                
                
        </div>
      

       

        
        <br> <br>
        <p style="text-align: center">Processado por computador</p>
        <p style="text-align: center">Emitido em:{{date('d/m/y H:i:s')}}  por: {{Auth::user()->name}}</p>
    </body>
</html>