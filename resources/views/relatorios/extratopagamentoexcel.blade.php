<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    
   


   <div style="width: 100%;  height: 10px; margin: 0 auto;">
    <h3 style="text-align:center; font-size: 30px;">Extracto de Pagamentos</h3> <br>
   </div>


    <table>

        <thead>
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
            @foreach($pg as $p)
            <tr>
                               
                <td>{{$p->idpagamento}}</td>
                <td>{{$p->cliente}}</td>
                <td>{{$p->mes}}</td>
                <td>{{$p->ano}}</td>
                <td >{{$p->data}}</td>
                <td >{{$p->valor}}</td>
                <td>{{$p->multa}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
</body>
</html>