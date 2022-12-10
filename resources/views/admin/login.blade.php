<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Login</title>

    <!-- Fontfaces CSS-->
    <link href="{{url('css/font-face.css')}}" rel="stylesheet" media="all">
    <link href="{{url('assets/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <link href="{{url('assets/vendor/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
    <link href="{{url('assets/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{url('assets/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{url('assets/vendor/animsition/animsition.min.css')}}" rel="stylesheet" media="all">
    <link href="{{url('assets/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet" media="all">
    <link href="{{url('assets/vendor/wow/animate.css')}}" rel="stylesheet" media="all">
    <link href="{{url('assets/vendor/css-hamburgers/hamburgers.min.css')}}" rel="stylesheet" media="all">
    <link href="{{url('assets/vendor/slick/slick.css')}}" rel="stylesheet" media="all">
    <link href="{{url('assets/vendor/select2/select2.min.css')}}" rel="stylesheet" media="all">
    <link href="{{url('assets/vendor/perfect-scrollbar/perfect-scrollbar.css')}}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{url('css/theme.css')}}" rel="stylesheet" media="all">
    <link href="{{url('css/meucustom.css')}}" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <style>
        .logo{
            width: 179px;
            height: 52px;
        }
    </style>
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="{{url('images/icon/novo.png')}}" class="" alt="CoolAdmin">
                            </a>
                        </div>
                        <div class="login-form">
                            @if($errors->any())
              
                                    @foreach($errors->all() as $erro)
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Erro</span>
                                        @if($erro=='auth.failed')
                                        <p style="text-align: center; color:black">  Email ou Password inválido</p>
                                        @else
                                        {{$erro}} 
                                        @endif
                                        
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endforeach            
                       
   
                             @endif
                             <div hidden id="erro" class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                               
                            </div>
                            <form id="form" action="{{url('/login')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="email">Email </label>
                                    <input id="email" class="au-input au-input--full" type="email" name="email" placeholder="Email">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="password">Password</label>
                                    <input id="password" class="au-input au-input--full" type="password" name="password" placeholder="Password">
                                </div>
                                
                                <button id="btn" class="au-btn au-btn--block au-btn--green m-t-20" type="submit">Entrar</button>
                               
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="{{url('assets/vendor/jquery-3.2.1.min.js')}}"></script>
    <!-- Bootstrap JS-->
    <script src="{{url('assets/bootstrap-4.1/popper.min.js')}}"></script>
    <script src="{{url('assets/bootstrap-4.1/bootstrap.min.js')}}"></script>
    <!-- Vendor JS       -->
    <script src="{{url('assets/vendor/slick/slick.min.js')}}">
    </script>
    <script src="{{url('assets/vendor/wow/wow.min.js')}}"></script>
    <script src="{{url('assets/vendor/animsition/animsition.min.js')}}"></script>
    <script src="{{url('assets/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js')}}">
    </script>
    <script src="{{url('assets/vendor/counter-up/jquery.waypoints.min.js')}}"></script>
    <script src="{{url('assets/vendor/counter-up/jquery.counterup.min.js')}}">
    </script>
    <script src="{{url('assets/vendor/circle-progress/circle-progress.min.js')}}"></script>
    <script src="{{url('assets/vendor/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{url('assets/vendor/chartjs/Chart.bundle.min.js')}}"></script>
    <script src="{{url('assets/vendor/select2/select2.min.js')}}">
    </script>

    <!-- Main JS-->
    <script src="{{url('js/main.js')}}"></script>

    <script>

          $(document).ready(function(){

           var  btn=document.getElementById("btn");
            btn.addEventListener('click', (event)=>{

            event.preventDefault();

           var email= document.getElementById("email");
           var senha = document.getElementById("password");
           var erro= document.getElementById("erro");
           var form=document.getElementById("form");

           if(email.value==""){
            erro.innerHTML="Por favor digite o seu email";
            erro.removeAttribute('hidden');
            email.focus();
            return false;
           }else{
            erro.setAttribute('hidden', true);
           }

           if(senha.value==""){
            erro.innerHTML="Porfavor digite a sua senha";
            erro.removeAttribute('hidden');
            senha.focus();
            return false;
           }else{
            erro.setAttribute('hidden', true);
            form.submit();
           }


            });
           


          });


    </script>

</body>

</html>
<!-- end document-->