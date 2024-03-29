    @if (!Auth::check())
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
    <link href=" {{ url('css/font-face.css')}}" rel="stylesheet" media="all">
    <link href="{{ url('assets/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <link href=" {{ url('assets/vendor/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ url('assets/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ url('css/meucustom.css')}}" rel="stylesheet" media="all">
    <!-- Bootstrap CSS-->
    <link href="{{ url('assets/vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">
    <!-- Vendor CSS-->
    <link href="{{ url('assets/vendor/animsition/animsition.min.css')}}" rel="stylesheet" media="all">
    <link href=" {{ url('assets/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ url('assets/vendor/wow/animate.css')}}" rel="stylesheet" media="all">
    <link href="{{ url('assets/vendor/css-hamburgers/hamburgers.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ url('assets/vendor/slick/slick.css')}}" rel="stylesheet" media="all">
    <link href="{{ url('assets/vendor/select2/select2.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ url('assets/vendor/perfect-scrollbar/perfect-scrollbar.css')}}" rel="stylesheet" media="all">
    <!-- Main CSS-->
    <link href=" {{ url('css/theme.css')}}" rel="stylesheet" media="all">
     <!--DATA TABLE-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <!-- meu CSS-->
    <link href="{{ url('css/meucustom.css')}}" rel="stylesheet" media="all">
     <!-- Jquery JS-->
     <script src="{{ url('assets/vendor/jquery-3.2.1.min.js')}}"></script>
     <!-- Bootstrap JS-->
     <script src="{{ url('assets/vendor/bootstrap-4.1/popper.min.js')}}"></script>
     <script src="{{ url('assets/vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>
</head>

@php

if(Auth::check())
{
    $nomeuser=Auth::user()->name;
    $imagemuser=Auth::user()->imagem;
    $email=Auth::user()->email;
    $id=Auth::user()->id;
}
@endphp





<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
                            <img src="{{url('images/icon/logo.png')}}" alt="CoolAdmin" />
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
                                <i class="fas fa-tachometer-alt"></i>Usuários</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="index.html">Ver Todos</a>
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
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="{{url('/dashboard')}}">
                    <img src="{{url('images/icon/novo.png')}}" alt="Cool Admin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    
                    <ul class="list-unstyled navbar__list">
                        @can('Administrador')
                        <li class="active has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-tachometer-alt"></i>Usuários</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="{{url('/dashboard/user')}}">Ver Todos</a>
                                </li>
                               
                               
                            </ul>
                        
                        </li>
                        @endcan

                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-copy"></i>Clientes</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
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
                            <a class="js-arrow" href="#">
                                <i class="fas fa-copy"></i>Contractos</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
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
                      

                        @can('Administrador')
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-copy"></i>Serviços</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="{{url('/dashboard/servicos')}}">Ver Todos</a>
                                </li>
                            </ul>
                        </li>
                        @endcan
                       
                        
                       
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-copy"></i>Pts</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="{{url('/dashboard/pts')}}">Ver Todos</a>
                                </li>
                            </ul>
                        </li>


                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-desktop"></i>Pagamentos</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="{{url('/dashboard/pagamentos')}}">Ver Todos</a>
                                    <a href="{{url('/dashboard/devedores')}}">Devedores</a>
                                    <a href="{{url('/dashboard/recibos')}}">Facturas-Recibo</a>
                                </li>
                            </ul>
                        </li>


                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-desktop"></i>Conta Clientes</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="{{url('/dashboard/contas')}}">Ver Todos</a>
                                    <a href="{{url('/dashboard/pagamentos')}}">Gestão de Conta Cliente</a>
                                    
                                    
                                </li>
                            </ul>
                        </li>


                        
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->
        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            
                            <!--<form class="form-header" action="" method="POST">
                                <input class="au-input au-input--xl" type="text" name="search" placeholder="Search for datas &amp; reports..." />
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>-->
                            <div class="header-button ml-auto">
                                <div class="noti-wrap">
                                    <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-comment-more"></i>
                                        <span class="quantity">1</span>
                                        <div class="mess-dropdown js-dropdown">
                                            <div class="mess__title">
                                                <p>You have 2 news message</p>
                                            </div>
                                            <div class="mess__item">
                                                <div class="image img-cir img-40">
                                                    <img src="{{url('images/icon/avatar-06.jpg')}}" alt="Michelle Moreno" />
                                                </div>
                                                <div class="content">
                                                    <h6>Michelle Moreno</h6>
                                                    <p>Have sent a photo</p>
                                                    <span class="time">3 min ago</span>
                                                </div>
                                            </div>
                                            <div class="mess__item">
                                                <div class="image img-cir img-40">
                                                    <img src="{{url('images/icon/avatar-04.jpg')}}" alt="Diane Myers" />
                                                </div>
                                                <div class="content">
                                                    <h6>Diane Myers</h6>
                                                    <p>You are now connected on message</p>
                                                    <span class="time">Yesterday</span>
                                                </div>
                                            </div>
                                            <div class="mess__footer">
                                                <a href="#">View all messages</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-email"></i>
                                        <span class="quantity">1</span>
                                        <div class="email-dropdown js-dropdown">
                                            <div class="email__title">
                                                <p>You have 3 New Emails</p>
                                            </div>
                                            <div class="email__item">
                                                <div class="image img-cir img-40">
                                                    <img src="{{url('images/icon/avatar-06.jpg')}}" alt="Cynthia Harvey" />
                                                </div>
                                                <div class="content">
                                                    <p>Meeting about new dashboard...</p>
                                                    <span>Cynthia Harvey, 3 min ago</span>
                                                </div>
                                            </div>
                                            <div class="email__item">
                                                <div class="image img-cir img-40">
                                                    <img src="{{url('images/icon/avatar-05.jpg')}}" alt="Cynthia Harvey" />
                                                </div>
                                                <div class="content">
                                                    <p>Meeting about new dashboard...</p>
                                                    <span>Cynthia Harvey, Yesterday</span>
                                                </div>
                                            </div>
                                            <div class="email__item">
                                                <div class="image img-cir img-40">
                                                    <img src="{{url('images/icon/avatar-04.jpg')}}" alt="Cynthia Harvey" />
                                                </div>
                                                <div class="content">
                                                    <p>Meeting about new dashboard...</p>
                                                    <span>Cynthia Harvey, April 12,,2018</span>
                                                </div>
                                            </div>
                                            <div class="email__footer">
                                                <a href="#">See all emails</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-notifications"></i>
                                        <span class="quantity">3</span>
                                        <div class="notifi-dropdown js-dropdown">
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
                                </div>
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                    @if(isset($imagemuser))
                                        <div class="image">
                                            @php
                                            $caminho='imagens'.'/'.$imagemuser;
                                            @endphp
                                            <img src="{{url("$caminho")}}" alt="user" />
                                        </div>
                                    @endif
                                        <div class="content">
                                        @if(isset($nomeuser))
                                            <a class="js-acc-btn" href="#">{{ $nomeuser }}</a>
                                        @endif
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="{{url("$caminho")}}" alt="User" />
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                    @if(isset($nomeuser))
                                                        <a href="#">{{ $nomeuser}}</a>
                                                    @endif 
                                                    </h5>
                                                    @if(isset($email))
                                                    <span class="email">{{ $email }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                   
                                                <div class="account-dropdown__item">
                                                @if(isset($id))
                                                    <a href="{{url("/dashboard/user/profile$id")}}">
                                                @endif
                                                        <i class=""></i>Account</a>
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
                                            @auth
                                            <div class="account-dropdown__footer">    
                                               <form action="/logout" method="POST">
                                                        @csrf
                                                  <a href="/logout" class="zmdi zmdi-power" onclick="event.preventDefault(); this.closest('form').submit();"> Logout</a>
                                               </form>
                                            </div>
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            <div class="main-content">

                @yield('content')
                
            </div>
        </div>
    </div>


            <!-- meu Js       -->
 
      <!-- Vendor JS       -->
      <script src="{{ url('assets/vendor/slick/slick.min.js')}}"> </script>
      <script src="{{ url('assets/vendor/wow/wow.min.js')}}"></script>
      <script src=" {{ url('assets/vendor/animsition/animsition.min.js')}}"></script>
      <script src="{{ url('assets/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"> </script>
      <script src="{{ url('assets/vendor/counter-up/jquery.waypoints.min.js')}}"></script>
      <script src="  {{ url('assets/vendor/counter-up/jquery.counterup.min.js')}}"></script>
      <script src="{{ url('assets/vendor/circle-progress/circle-progress.min.js')}}"></script>
      <script src=" {{ url('assets/vendor/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
      <script src="{{ url('assets/vendor/chartjs/Chart.bundle.min.js')}}"></script>
      <script src="{{ url('assets/vendor/select2/select2.min.js')}}"> </script>
      <script type= "text/javascript" src="{{url('js/jquery.mask.js')}}"></script>
      <!-- Main JS-->
      <script src="{{ url('js/main.js')}}"></script>
   <!--DATA TABLE-->
   <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
      
      
      <script>

       $('document').ready(function(){
       var valor =  $('input[name=is_logado]').val();
             
             if (valor==1) {
                window.location.href ="{{url('/')}}";
             }


       })
      
      </script>
</body>
    
</html>
<!-- end document-->
