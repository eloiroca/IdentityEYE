@extends('layouts.app')

@section('scripts')
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js"></script>
@endsection

@section('sidebar')
    <nav id="sidebar">
        <div class="sidebar-header">
             
        </div>

        <ul class="list-unstyled components">
            <li class="active">
                <a href="{{ url('') }}">
                    <i class="glyphicon glyphicon-home activat"></i>
                    Inicio
                </a>
            </li>
            <li>
                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">
                    <i class="glyphicon glyphicon-user desactivat"></i>
                    Perfil
                </a>
                <ul class="collapse list-unstyled" id="homeSubmenu">
                    <li class="no_loguejat"><a href="#">Tu Perfil</a></li>
                    <li class="no_loguejat"><a href="#">Perfiles Identity</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ route('novetats') }}">
                    <i class="glyphicon glyphicon-send activat"></i>
                    Novedades
                </a>
            </li>
            <li>
                
                
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">
                    <i class="glyphicon glyphicon-link desactivat"></i>
                    Generador Identity
                </a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li class="no_loguejat"><a href="#">Configurador Identity</a></li>
                    <li class="no_loguejat"><a href="#">Generador de Ropa</a></li>
                    <li class="no_loguejat"><a href="#">Combinaciones Aleatorias</a></li>
                </ul>
            </li>
            <li class="no_loguejat">
                <a href="#">
                    <i class="glyphicon glyphicon-duplicate desactivat"></i>
                    Combinación Guardada
                </a>
            </li>
            <li>
                <a href="{{ route('proximaModa') }}">
                    <i class="glyphicon glyphicon-briefcase activat"></i>
                    Próxima Moda
                </a>
            </li>
            
        </ul>

        <ul class="list-unstyled CTAs">
            <li>
            © Copyright 2018 IdentityEYE
            </li>
        </ul>
    </nav>
@endsection

@section('content')

    <div id="novetats" class="panel panel-primary">
        <div class="panel-body">
            <img class="foto_home" src="{{ URL::asset('img/titol.png') }}" alt="titoll"/>
        </div>
    </div>
        
    <div id="cos_home" class="panel panel-primary">
        <div class="panel-body">   
            <!-- SLIDE-->
            <div id="elMeuCarousel" class="carousel slide" data-ride="carousel">    
                <!-- Menú - - - - - - - - - - -->
                <ol class="carousel-indicators">
                    <li data-target="#elMeuCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#elMeuCarousel" data-slide-to="1"></li>
                    <li data-target="#elMeuCarousel" data-slide-to="2"></li>
                    <li data-target="#elMeuCarousel" data-slide-to="3"></li>
                    <li data-target="#elMeuCarousel" data-slide-to="4"></li>
                    <li data-target="#elMeuCarousel" data-slide-to="5"></li>
                    <li data-target="#elMeuCarousel" data-slide-to="6"></li>
                    <li data-target="#elMeuCarousel" data-slide-to="7"></li>
                    <li data-target="#elMeuCarousel" data-slide-to="8"></li>
                </ol>
                <!-- Slides - - - - - - - - - - -->
                <div class="carousel-inner" role="listbox">
                    <div class="item active"> 
                     <img src="{{ URL::asset('img/contingut/slide-taula.jpg') }}" alt="Grid Complet">
                      
                    </div>
                    <div class="item">
                        <img src="{{ URL::asset('img/contingut/slide-formulari.jpg') }}" alt="Formulari" >
                        </div>       
                    <div class="item">
                      
                      <img src="{{ URL::asset('img/contingut/slide-galeri.jpg') }}" alt="Taula" >
                      
                    </div>
                    <div class="item">
                      
                      <img src="{{ URL::asset('img/contingut/slide-taul.jpg') }}" alt="Taula" >
                      
                    </div>
                    <div class="item">
                      
                      <img src="{{ URL::asset('img/contingut/slide-galeria.jpg') }}" alt="Taula" >
                      
                    </div>
                    <div class="item">
                      
                      <img src="{{ URL::asset('img/contingut/slide-component.jpg') }}" alt="Taula" >
                      
                    </div>
                    <div class="item">
                      
                      <img src="{{ URL::asset('img/contingut/slide-mes.jpg') }}" alt="Taula" >
                      
                    </div>
                    <div class="item">
                      
                      <img src="{{ URL::asset('img/contingut/slide-roba.jpg') }}" alt="Taula" >
                      
                    </div>
                    <div class="item">
                      
                      <img src="{{ URL::asset('img/contingut/slide-components.jpg') }}" alt="Altres" >
                      
                </div>
                <!-- Controls - - - - - - - - - - -->
                <a class="left carousel-control" href="#elMeuCarousel" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Següent</span>
                </a>
                <a class="right carousel-control" href="#elMeuCarousel" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Anterior</span>
                </a>
            </div>
                </div>
                
                <div class="col-md-6">
                    <h2 class="h1_home">IdentityEYE</h2>
                    <hr class="hr_dreta">
                    <p class="tex_home">IdentityEYE es un portal web donde podrás encontrar tus piezas de ropa ideal tanto de mujer como de hombre, la aplicación se basa en, según tu tono de piel, ojos y pelo te recomendará una paleta de colores ideal para ti, de esa paleta tendrás la opción de añadirle o quitarle colores.</p>
                    <p class="tex_home">Según tu paleta de colores personalizada la aplicación te mostrará unos productos concretos.</p>
                    <div class="images_home">
                        <img class="img_home" src="{{ URL::asset('img/contingut/cabell.png') }}" alt="asa"/>
                        <img class="img_home" src="{{ URL::asset('img/contingut/fletxa.png') }}" alt="assa"/>
                        <img class="img_home" src="{{ URL::asset('img/contingut/pell.png') }}" alt="assasa"/>
                        <img class="img_home" src="{{ URL::asset('img/contingut/fletxa.png') }}" alt="aasdsa"/>
                        <img class="img_home" src="{{ URL::asset('img/contingut/ull.png') }}" alt="asadsf"/>
                        <img class="img_home" src="{{ URL::asset('img/contingut/igual.png') }}" alt="asaaaea"/>
                        <img class="img_home" src="{{ URL::asset('img/contingut/roba.png') }}" alt="asdfcasa"/>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <h2 class="h1_home">Colorimetría de las estaciones</h2>
                    <hr class="hr_dreta">
                    <p class="tex_home">La colorimetría de las estaciones se trata de una teoría que afirma que todas las personas tienen una paleta de color personal, que puede asociarse con una determinada estación, y que es lo que va a determinar los colores que deberían vestirse.</p>
                    <p class="tex_home">Aunque no lo parezca, los rasgos físicos y de tono de cada persona marcan unas diferencias muy importantes a la hora de escoger una prenda u otra. La piel se ve más luminosa y saludable, además un mejor aspecto general que todo el mundo notará.</p>
                </div>
                
                <div class="col-md-12">
                    <h2 class="h1_home">Ventajas</h2>
                    <hr class="hr_dreta">
                    <div class="col-md-2"><img class="img_home" src="{{ URL::asset('img/contingut/perfil.png') }}" alt="asasdfa"/><p>Tener tu propio perfil</p></div>
                    <div class="col-md-2"><img class="img_home" src="{{ URL::asset('img/contingut/buscar.png') }}" alt="adda"/><p>Buscar otros perfiles</p></div>
                    <div class="col-md-2"><img class="img_home" src="{{ URL::asset('img/contingut/guardar.png') }}" alt="agdsgsa"/><p>Guardar tus combinaciones</p></div>
                    <div class="col-md-2"><img class="img_home" src="{{ URL::asset('img/contingut/opinar.png') }}" alt="assdgsda"/><p>Opinar de las combinaciones</p></div>
                    <div class="col-md-2"><img class="img_home" src="{{ URL::asset('img/contingut/noticies.png') }}" alt="asdgdsga"/><p>Leer las últimas novedades</p></div>
                    <div class="col-md-2"><img class="img_home" src="{{ URL::asset('img/contingut/color.png') }}" alt="asgsdaa"/><p>Encuentra tu paleta de colores</p></div>
                    
                </div>
        </div>
    </div>

    

@endsection

@section('scripts_baix')
    <script>
        window.addEventListener("load", function(){
        window.cookieconsent.initialise({
          "palette": {
            "popup": {
              "background": "#0e374d",
              "text": "#cfcfe8"
            },
            "button": {
              "background": "#f71559"
            }
          },
          "showLink": false,
          "position": "bottom-right",
          "content": {
            "message": "<p class='cookies'>Esta web utiliza cookies para obtener datos estadísticos de la navegación y guardar los colores personales de sus usuarios. Si continúas navegando consideramos que aceptas su uso.</p>",
            "dismiss": "Aceptar"
          }
        })});
        </script>
@endsection

