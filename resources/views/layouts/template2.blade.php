



@if(Auth::check())
   @php
    $nomeuser=Auth::user()->name;
    $imagemuser=Auth::user()->imagem;
    $email=Auth::user()->email;
    $id=Auth::user()->id;
    @endphp
@else
 <input type="hiden" name="is_logado" value="1" >
@endif





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
    <title> @yield('title') </title>

    <!-- Fontfaces CSS-->
    <link href="{{ url('css/meucustom.css')}}" rel="stylesheet" media="all">
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="{{url('assets/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <link href="{{url('assets/vendor/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
    <link href="{{url('assets/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{url('assets/vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">

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

    <!-- Jquery JS-->
    <script src="{{ url('assets/vendor/jquery-3.2.1.min.js')}}"></script>
</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER DESKTOP-->
        <header class="header-desktop3 d-none d-lg-block">
            <div class="section__content section__content--p35">
                <div class="header3-wrap">
                    <div class="header__logo">
                        <a href="{{url('/dashboard')}}">
                            <img src="{{url('images/icon/novo1.png')}}" alt="CoolAdmin" />
                        </a>
                    </div>
                    <div class="header__navbar">
                        <ul class="list-unstyled">
                            <li class="has-sub">
                                <a href="#">
                                    <i class="fas fa-tachometer-alt"></i>Usuários
                                    <span class="bot-line"></span>
                                </a>
                                <ul class="header3-sub-list list-unstyled">
                                    <li>
                                        <a href="{{url('/dashboard/user')}}">Ver Todos</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="has-sub">
                                <a href="#">
                                    <i class="fas fa-tachometer-alt"></i>Clientes
                                    <span class="bot-line"></span>
                                </a>
                                <ul class="header3-sub-list list-unstyled">
                                    <li>
                                        <a href="{{url('/dashboard/clientes')}}">Ver todos</a>
                                    </li>
                                    <li>
                                        <a href="{{url('/dashboard/clientesParticular')}}">Particulares</a>
                                    </li>
                                    <li>
                                        <a href="{{url('/dashboard/clientesempresa')}}">Empresa</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="has-sub">
                                <a href="#">
                                    <i class="fas fa-copy"></i>
                                    <span class="bot-line"></span>Contratos</a>
                                <ul class="header3-sub-list list-unstyled">
                                    <li>
                                        <a href="{{url('/dashboard/contratos')}}">Ver todos</a>
                                    </li>
                                    <li>
                                        <a href="{{url('/dashboard/gestao-de-contratos')}}">Pagamento de Contrato</a>
                                    </li>

                                    <li>
                                        <a href="{{url('/dashboard/gestao-contrato')}}">Gestão de contratos</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="has-sub">
                                <a href="#">
                                    <i class="fas fa-desktop"></i>
                                    <span class="bot-line"></span>Serviços</a>
                                <ul class="header3-sub-list list-unstyled">
                                    <li>
                                        <a href="{{url('/dashboard/servicos')}}">Ver Todos</a>
                                    </li>
                                </ul>
                            </li>


                            <li class="has-sub">
                                <a href="#">
                                    <i class="fas fa-desktop"></i>
                                    <span class="bot-line"></span>Pts</a>
                                <ul class="header3-sub-list list-unstyled">
                                    <li>
                                        <a href="{{url('/dashboard/servicos')}}">Ver Todos</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="has-sub">
                                <a href="#">
                                    <i class="fas fa-desktop"></i>
                                    <span class="bot-line"></span>Pagamentos</a>
                                <ul class="header3-sub-list list-unstyled">
                                    <li>
                                        <a href="{{url('/dashboard/pagamentos')}}">Ver Todos</a>
                                    </li>
                                    <li>
                                        <a href="{{url('/dashboard/devedores')}}">Devedores</a>
                                    </li>

                                    <li>
                                        <a href="{{url('/dashboard/recibos')}}">Facturas-Recibo</a>
                                    </li>
                                </ul>
                            </li>



                            <li class="has-sub">
                                <a href="#">
                                    <i class="fas fa-desktop"></i>
                                    <span class="bot-line"></span>Conta Clientes</a>
                                <ul class="header3-sub-list list-unstyled">
                                    <li>
                                        <a href="{{url('/dashboard/contas')}}">Ver Todos</a>
                                    </li>
                                   
                                    <li>
                                        <a href="{{url('/dashboard/recibos')}}">Gestão de Conta Cliente</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="header__tool">
                        <div class="header-button-item has-noti js-item-menu">
                            <i class="zmdi zmdi-notifications"></i>
                            <div class="notifi-dropdown notifi-dropdown--no-bor js-dropdown">
                                <div class="notifi__title">
                                    <p>You have 3 Notifications</p>
                                </div>
                                <div class="notifi__item">
                                    <div class="bg-c1 img-cir img-40">
                                        <i class="zmdi zmdi-email-open"></i>
                                    </div>
                                    <div class="content">
                                        <p>You got a email notification</p>
                                        <span class="date">April 12, 2018 06:50</span>
                                    </div>
                                </div>
                                <div class="notifi__item">
                                    <div class="bg-c2 img-cir img-40">
                                        <i class="zmdi zmdi-account-box"></i>
                                    </div>
                                    <div class="content">
                                        <p>Your account has been blocked</p>
                                        <span class="date">April 12, 2018 06:50</span>
                                    </div>
                                </div>
                                <div class="notifi__item">
                                    <div class="bg-c3 img-cir img-40">
                                        <i class="zmdi zmdi-file-text"></i>
                                    </div>
                                    <div class="content">
                                        <p>You got a new file</p>
                                        <span class="date">April 12, 2018 06:50</span>
                                    </div>
                                </div>
                                <div class="notifi__footer">
                                    <a href="#">All notifications</a>
                                </div>
                            </div>
                        </div>
                        <div class="header-button-item js-item-menu">
                            <i class="zmdi zmdi-settings"></i>
                            <div class="setting-dropdown js-dropdown">
                                <div class="account-dropdown__body">
                                    <div class="account-dropdown__item">
                                        <a href="#">
                                            <i class="zmdi zmdi-account"></i>Usuários</a>
                                    </div>
                                    <div class="account-dropdown__item">
                                        <a href="#">
                                            <i class="zmdi zmdi-settings"></i>Setting</a>
                                    </div>
                                    <div class="account-dropdown__item">
                                        <a href="#">
                                            <i class="zmdi zmdi-money-box"></i>Billing</a>
                                    </div>
                                </div>
                                <div class="account-dropdown__body">
                                    <div class="account-dropdown__item">
                                        <a href="#">
                                            <i class="zmdi zmdi-globe"></i>Language</a>
                                    </div>
                                    <div class="account-dropdown__item">
                                        <a href="#">
                                            <i class="zmdi zmdi-pin"></i>Location</a>
                                    </div>
                                    <div class="account-dropdown__item">
                                        <a href="#">
                                            <i class="zmdi zmdi-email"></i>Email</a>
                                    </div>
                                    <div class="account-dropdown__item">
                                        <a href="#">
                                            <i class="zmdi zmdi-notifications"></i>Notifications</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="account-wrap">
                            @php
                             if(isset($imagemuser)){
                                $caminho='imagens'.'/'.$imagemuser;
                                }
                                @endphp
                            <div class="account-item account-item--style2 clearfix js-item-menu">
                                <div class="image">
                                @if(isset($caminho))
                                    <img src="{{url("$caminho")}}" alt="{{$nomeuser}}" />
                                @endif
                                </div>
                                 @if(isset($nomeuser))
                                <div class="content">
                                    <a class="js-acc-btn" href="#">{{$nomeuser}}</a>
                                </div>
                                @endif
                                
                                <div class="account-dropdown js-dropdown">
                                    <div class="info clearfix">
                                      @if(isset($caminho))
                                        <div class="image">
                                            <a href="#">
                                                <img src="{{url("$caminho")}}" alt="{{$nomeuser}}" />
                                            </a>
                                        </div>
                                       @endif
                                        @if(isset($nomeuser) && isset($email))
                                        <div class="content">
                                            <h5 class="name">
                                                <a href="#">{{$nomeuser}}</a>
                                            </h5>
                                            <span class="email">{{$email}}</span>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="account-dropdown__body">
                                        <div class="account-dropdown__item">
                                            <a href="#">
                                                <i class="zmdi zmdi-account"></i>Account</a>
                                        </div>
                                        <div class="account-dropdown__item">
                                            <a href="#">
                                                <i class="zmdi zmdi-settings"></i>Setting</a>
                                        </div>
                                        <div class="account-dropdown__item">
                                            <a href="#">
                                                <i class="zmdi zmdi-money-box"></i>Billing</a>
                                        </div>
                                    </div>
                                    <div class="account-dropdown__footer">
                                        <form action="/logout" method="POST">
                                            @csrf
                                      <a href="/logout" class="zmdi zmdi-power" onclick="event.preventDefault(); this.closest('form').submit();"> Logout</a>
                                   </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- END HEADER DESKTOP-->

        <!-- HEADER MOBILE-->
        <header class="header-mobile header-mobile-2 d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
                            <img src="images/icon/logo-white.png" alt="CoolAdmin" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="index.html">Dashboard 1</a>
                                </li>
                                <li>
                                    <a href="index2.html">Dashboard 2</a>
                                </li>
                                <li>
                                    <a href="index3.html">Dashboard 3</a>
                                </li>
                                <li>
                                    <a href="index4.html">Dashboard 4</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="chart.html">
                                <i class="fas fa-chart-bar"></i>Charts</a>
                        </li>
                        <li>
                            <a href="table.html">
                                <i class="fas fa-table"></i>Tables</a>
                        </li>
                        <li>
                            <a href="form.html">
                                <i class="far fa-check-square"></i>Forms</a>
                        </li>
                        <li>
                            <a href="calendar.html">
                                <i class="fas fa-calendar-alt"></i>Calendar</a>
                        </li>
                        <li>
                            <a href="map.html">
                                <i class="fas fa-map-marker-alt"></i>Maps</a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-copy"></i>Pages</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="login.html">Login</a>
                                </li>
                                <li>
                                    <a href="register.html">Register</a>
                                </li>
                                <li>
                                    <a href="forget-pass.html">Forget Password</a>
                                </li>
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-desktop"></i>UI Elements</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="button.html">Button</a>
                                </li>
                                <li>
                                    <a href="badge.html">Badges</a>
                                </li>
                                <li>
                                    <a href="tab.html">Tabs</a>
                                </li>
                                <li>
                                    <a href="card.html">Cards</a>
                                </li>
                                <li>
                                    <a href="alert.html">Alerts</a>
                                </li>
                                <li>
                                    <a href="progress-bar.html">Progress Bars</a>
                                </li>
                                <li>
                                    <a href="modal.html">Modals</a>
                                </li>
                                <li>
                                    <a href="switch.html">Switchs</a>
                                </li>
                                <li>
                                    <a href="grid.html">Grids</a>
                                </li>
                                <li>
                                    <a href="fontawesome.html">Fontawesome Icon</a>
                                </li>
                                <li>
                                    <a href="typo.html">Typography</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="sub-header-mobile-2 d-block d-lg-none">
            <div class="header__tool">
                <div class="header-button-item has-noti js-item-menu">
                    <i class="zmdi zmdi-notifications"></i>
                    <div class="notifi-dropdown notifi-dropdown--no-bor js-dropdown">
                        <div class="notifi__title">
                            <p>You have 3 Notifications</p>
                        </div>
                        <div class="notifi__item">
                            <div class="bg-c1 img-cir img-40">
                                <i class="zmdi zmdi-email-open"></i>
                            </div>
                            <div class="content">
                                <p>You got a email notification</p>
                                <span class="date">April 12, 2018 06:50</span>
                            </div>
                        </div>
                        <div class="notifi__item">
                            <div class="bg-c2 img-cir img-40">
                                <i class="zmdi zmdi-account-box"></i>
                            </div>
                            <div class="content">
                                <p>Your account has been blocked</p>
                                <span class="date">April 12, 2018 06:50</span>
                            </div>
                        </div>
                        <div class="notifi__item">
                            <div class="bg-c3 img-cir img-40">
                                <i class="zmdi zmdi-file-text"></i>
                            </div>
                            <div class="content">
                                <p>You got a new file</p>
                                <span class="date">April 12, 2018 06:50</span>
                            </div>
                        </div>
                        <div class="notifi__footer">
                            <a href="#">All notifications</a>
                        </div>
                    </div>
                </div>
                <div class="header-button-item js-item-menu">
                    <i class="zmdi zmdi-settings"></i>
                    <div class="setting-dropdown js-dropdown">
                        <div class="account-dropdown__body">
                            <div class="account-dropdown__item">
                                <a href="#">
                                    <i class="zmdi zmdi-account"></i>Account</a>
                            </div>
                            <div class="account-dropdown__item">
                                <a href="#">
                                    <i class="zmdi zmdi-settings"></i>Setting</a>
                            </div>
                            <div class="account-dropdown__item">
                                <a href="#">
                                    <i class="zmdi zmdi-money-box"></i>Billing</a>
                            </div>
                        </div>
                        <div class="account-dropdown__body">
                            <div class="account-dropdown__item">
                                <a href="#">
                                    <i class="zmdi zmdi-globe"></i>Language</a>
                            </div>
                            <div class="account-dropdown__item">
                                <a href="#">
                                    <i class="zmdi zmdi-pin"></i>Location</a>
                            </div>
                            <div class="account-dropdown__item">
                                <a href="#">
                                    <i class="zmdi zmdi-email"></i>Email</a>
                            </div>
                            <div class="account-dropdown__item">
                                <a href="#">
                                    <i class="zmdi zmdi-notifications"></i>Notifications</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="account-wrap">

                     
                                 @php
                                 if(isset($imagemuser)){
                                $caminho='imagens'.'/'.$imagemuser;
                                 }
                                @endphp
                    <div class="account-item account-item--style2 clearfix js-item-menu">
                        <div class="image">
                        @if(isset($caminho) && isset($nomeuser))
                            <img src="{{url("$caminho")}}" alt="{{$nomeuser}}" />
                            @endif
                        </div>
                        <div class="content">
                            @if(isset($nomeuser))
                            <a class="js-acc-btn" href="#">{{$nomeuser}}</a>
                            @endif
                        </div>
                        <div class="account-dropdown js-dropdown">
                            <div class="info clearfix">
                                <div class="image">
                                    <a href="#">
                                       @if(isset($caminho) && isset($nomeuser))
                                        <img src="{{url("$caminho")}}" alt="{{$nomeuser}}" />
                                      @endif
                                    </a>
                                </div>
                                <div class="content">
                                 @if(isset($nomeuser) && isset($email))
                                    <h5 class="name">
                                   
                                        <a href="#">{{$nomeuser}}</a>
                                    </h5>
                                    <span class="email">{{$email}}</span>
                                @endif
                                </div>
                            </div>
                            <div class="account-dropdown__body">
                                <div class="account-dropdown__item">
                                    <a href="#">
                                        <i class="zmdi zmdi-account"></i>Account</a>
                                </div>
                                <div class="account-dropdown__item">
                                    <a href="#">
                                        <i class="zmdi zmdi-settings"></i>Setting</a>
                                </div>
                                <div class="account-dropdown__item">
                                    <a href="#">
                                        <i class="zmdi zmdi-money-box"></i>Billing</a>
                                </div>
                            </div>
                            <div class="account-dropdown__footer">
                                <a href="#">
                                    <i class="zmdi zmdi-power"></i>Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END HEADER MOBILE -->

        <!-- PAGE CONTENT-->
        <div class="page-content--bgf7">
           

            

           

            
            <!-- DATA TABLE-->
            <section class="p-t-20">
                
                    @yield('content')
               
            </section>
            <!-- END DATA TABLE-->

            <!-- COPYRIGHT-->
            <section class="p-t-60 p-b-20">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="copyright">
                                <p>Copyright © 2022 TryCode. All rights reserved. Developed by: <a href="https://trycode.ao">TryCode-formação & Tecnologia</a>.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END COPYRIGHT-->
        </div>

    </div>

   

    <!-- Jquery JS-->
    <script src="{{url('assets/vendor/jquery-3.2.1.min.js')}}"></script>
    <!-- Bootstrap JS-->
    <script src="{{url('assets/vendor/bootstrap-4.1/popper.min.js')}}"></script>
    <script src="{{url('assets/vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>
    <!-- Vendor JS       -->
    <script src="{{url('assets/vendor/slick/slick.min.js')}}">
    </script>
   <script src="{{ url('assets/vendor/wow/wow.min.js')}}"></script>
   <script src=" {{ url('assets/vendor/animsition/animsition.min.js')}}"></script>
    <script src="{{url('assets/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js')}}">
    </script>
    <script src="{{url('assets/vendor/counter-up/jquery.waypoints.min.js')}}"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="{{url('assets/vendor/circle-progress/circle-progress.min.js')}}"></script>
    <script src="{{url('assets/vendor/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{url('assets/vendor/chartjs/Chart.bundle.min.js')}}"></script>
    <script src="{{url('assets/vendor/select2/select2.min.js')}}">
    </script>

    <!-- Main JS-->
    <script src="{{url('js/main.js')}}"></script>
    
    <!-- J MASK-->
    <script type= "text/javascript" src="{{url('js/jquery.mask.js')}}"></script>


      <!--DATA TABLE-->
   <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
   
   <script>
       $('document').ready(function(){
       var valor =  $('input[name=is_logado]').val()
             
             if (valor==1) {
                window.location.href ="{{url('/')}}";
             }


       })
   
   </script>
</body>

</html>
<!-- end document-->
