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
                    <h3 style="text-align:center; font-size: 30px;">Extracto de Divida</h3>
                    <table style="padding-top: 15px; width: 100%; ">
                        <thead style="background-color: black; color:white; height: 40px; border:none;">
                            <tr>
                                <th>Id</th>
                                <th>Nome</th>
                                <th>Nif</th>
                                <th>Mês</th>
                               
                                
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($pg))
                                @foreach($pg as $p)
                                @php
                                $size=count($p->meses);
                                @endphp
                                @for($i=0;$i<$size; $i++)
                            <tr>
                               
                                <td>{{$p->codigo}}</td>
                                <td>{{$p->nome}}</td>
                                <td>{{$p->nif}}</td>
                                <td>{{$p->meses[$i]}}</td>
                                
                            </tr>
                                @endfor
                                @endforeach
                               
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