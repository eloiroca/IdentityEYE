<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>IdentityEYE</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!--LLibreries-->

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src='https://unpkg.com/spritespin@4.0.3/release/spritespin.js'></script>
        <!-- Bootstrap JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!-- Alertes -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <!-- Scripts de altres Pàgines -->
        @yield('scripts')
        <!-- Estil CSS -->
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/tema.css') }}">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Gaegu" rel="stylesheet">
        <!--Favicon -->
        <link rel="icon" href="{{ URL::asset('img/favicon.ico') }}" type="image/gif" sizes="16x16">
    </head>

    <body>
        <!-- WRAPPPER -->
        <div id="botons-barra">
            <div class="barra"><a id="info" data-toggle="modal" href="#myModal"><img class="icono-barra" src="{{ URL::asset('img/contingut/info.png') }}" alt="icono-informacio"></a></div>
            <div class="barra"><a id="sidebarCollapse2"><img class="icono-barra" src="{{ URL::asset('img/contingut/menu.png') }}" alt="icono-bara"></a>
                <!--<a><img class="icono-barra" src="{{ URL::asset('img/contingut/info.png') }}" alt="icono-baara"></a>-->



                            @if (Route::has('login'))
                                @auth

                                    @guest
                                        @else
                                        <div class="barra"><a href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                            <img class="icono-barra" src="{{ URL::asset('img/contingut/logout.png') }}"></a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                        </div>
                                        @endguest
                            @else
                            <div class="barra"><a href="{{ route('register') }}"><img class="icono-barra" src="{{ URL::asset('img/contingut/register.png') }}" alt="icono-registrar"></a></div>
                            <div class="barra"><a href="{{ route('login') }}"><img class="icono-barra" src="{{ URL::asset('img/contingut/login.png') }}" alt="loogin"> </a></div>
                                    @endauth

                            @endif

                        </div>
        </div>
        <div class="wrapper">
          @if (Auth::check())
              <div id="nom_usuari_ocult">{{ Auth::user()->name }}</div>
          @endif
            <!--Barra Fixa de Navegacio-->
            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="menu"><i class="fa fa-bars" id="menu_icon"></i></a>
                        <a class="navbar-brand" href="{{ url('') }}">
                            <img id="img_logo" src="{{ URL::asset('img/logo_navbar.png') }}" alt="saa">
                        </a>
                    </div><!--navbar-header close-->

                    <div class="collapse navbar-collapse drop_menu" id="content_details">
                        <ul class="nav navbar-nav">
                            <li><a id="sidebarCollapse"><span class="glyphicon glyphicon-tasks"></span></a></li>
                            <li><a id="info" data-toggle="modal" href="#myModal"><span class="glyphicon glyphicon-info-sign"></span></a></li>

                        </ul><!--nav navbar-nav close-->
                        <ul class="nav navbar-nav navbar-right">
                            @if (Route::has('login'))
                                @auth
                                    <!-- Authentication Links -->
                                    @guest
                                        @else
                                        <li><a id="btn_carrito"><span class="glyphicon glyphicon-shopping-cart"></span><span class="num_productes"></span></a></li>
                                        <li><a href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                            Salir <span class="glyphicon glyphicon-off"></span></a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                        </li>
                                        @endguest
                            @else
                                        <li><a href="{{ route('register') }}"><span class="glyphicon glyphicon-user"></span> Registrar</a></li>
                                        <li><a href="{{ route('login') }}"><span class="glyphicon glyphicon-log-in"></span> Entrar</a></li>
                                    @endauth

                            @endif
                        </ul><!--navbar-right close-->
                    </div><!--collapse navbar-collapse drop_menu close-->
                </div><!--container-fluid close-->
            </nav><!--navbar navbar-inverse close-->

            <!-- SIDEBAR ESQUERRA -->
            @yield('sidebar')
        </div>
        <div id="particles-js"></div>

            <!-- Contingut -->
            <div id="content">
                @yield('content')
            </div>

           <div id="div_carrito">
              <img src="{{ URL::asset('img/contingut/cerrar.png') }}" class="img_tancar_carrito"/>
              <h1 class="h1_carrito">Piezas del Carrito</h1>
              <div id="contingut_carrito"></div>

              <hr class="hr_carrito"></hr>
              <div id='total'> Total: <span class="total_carrito"></span>€</div>
              <div id="div_botons_carrito"><a class='button' id='btn_buidar_carrito'>VACIAR</a><a class='button' id='btn_comprar_carrito'>COMPRAR</a></div>

           </div>

            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h2 class="modal-title">Información IdentityEYE</h2>
                        <b><i>Actual V1.7</i></b><br><br>

                        <b><i>V1.7<i></b>
                        <ul>
                          <li>Se ha añadido la opcion de Carrito de Compra al comprar una pieza, o combinación</li>                      
                        </ul>

                        <b><i>V1.6<i></b>
                        <ul>
                          <li>Ya se puede comprar una combinacion aleatoria entera</li>
                          <li>Ya se puede comprar una combinación guardada entera</li>
                          <li>Se puede entrar en Novedades i Proximas Modas sin Iniciar Sesión</li>
                          <li>Se han cambiado las imagenes del Slide</li>
                        </ul>

                        <b><i>V1.5<i></b>
                        <ul>
                          <li>Añadadido botón eliminar combinación guardada</li>
                          <li>Formularios adaptados para dispositivos móbiles</li>
                          <li>Ahora no se descarga el PDF del Proyecto al conectarse desde un dispositivo mobil, por culpa del Iframe</li>
                        </ul>
                    </div>
                    <div class="modal-body">
                        <h4>Información Personal</h4>
                        <hr class="hr_dreta">
                        <p>
                            Proyecto realizado como trabajo de fin de curso de CFGS Desarrllador de Apliaciones Web del INS Mollerussa.

                        </p>
                        <ul>
                            <li><b>Eloi Roca Plana</b></li>
                            <li><b>eloi.roca20@gmail.com</b></li>
                        </ul>

                        <h4>Documento del Proyecto</h4>
                        <hr class="hr_dreta">
                        <div class="resultado">
        <object type="application/pdf" width="100%" height="300" id="resultados_google" data="{{ URL::asset('pdf/projecte.pdf') }}">
            <p>Si puede leer este mensaje es que su navegador no soporta correctamente el elemento <code>object</code></p>
        </object>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                  </div>

                </div>
            </div>
        <script>
            //Rutes pel JS, per complementar els href
            var config = {
                rutes: [
                    { inici: "{{ URL::to('') }}", ajax_subestacio: "{{ URL::to('ajax_subestacio') }}", ajax_buscador: "{{ URL::to('ajax_buscador') }}", pagamentcarrito: "{{ URL::to('pagamentcarrito') }}", editarPerfil: "{{ URL::to('editarPerfil') }}", ajax_eliminarPesaCarrito: "{{ URL::to('ajax_eliminarPesaCarrito') }}", ajax_comprarRoba: "{{ URL::to('ajax_comprarRoba') }}", ajax_eliminar: "{{ URL::to('ajax_eliminar') }}", ajax_actualitzarCarrito: "{{ URL::to('ajax_actualitzarCarrito') }}", ajax_eliminarCombinacio: "{{ URL::to('ajax_eliminarCombinacio') }}" @if (Route::has('login')) @auth , id_usuari: "{{ Auth::user()->id }}" @endauth @endif}
                ]
            };
        </script>
        <!-- Llibreria Particules -->
        <script src="{{ URL::asset('js/particules.js') }}"></script>
        <script src="{{ URL::asset('js/particuletes.js') }}"></script>
        <!-- El Nostre JS -->
        <script src="{{ URL::asset('js/codi.js') }}"></script>
        @yield('scripts_baix')
    </body>
</html>
