@extends('layouts.app')

@section('sidebar')
    <nav id="sidebar">
        <div class="sidebar-header">
            <?php
                if ($dades['dadesUsuari'] == "NULL"){
                    ?><h3 class="h3_sidebar">{{ ucfirst(Auth::user()->name) }}</h3><img class="img_sidebar" src="{{ URL::asset('img/contingut/usuari_perdefecte.png')}}"><?php 
                }else{
                    ?><h3 class="h3_sidebar">{{ ucfirst(Auth::user()->name) }}</h3><img class='img_sidebar' src="{{ URL::asset('img/fotos_perfils/'.$dades['dadesUsuari']->foto_perfil) }}" alt="foto_perfil_sidebar"/><?php            }   
            ?>
                    
            <strong>{{ Auth::user()->name }}</strong>
              
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
                    <i class="glyphicon glyphicon-user activat"></i>
                    Perfil
                </a>
                <ul class="collapse list-unstyled" id="homeSubmenu">
                    <li><a href="{{ route('perfil') }}">Tu Perfil</a></li>
                    <li><a href="{{ route('buscarPerfil') }}">Perfiles Identity</a></li>
                    <li><a href="{{ route('afegirProximaModa') }}">+ Próximas Modas</a></li>
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
                    <i class="glyphicon glyphicon-link activat"></i>
                    Generador Identity
                </a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li><a href="{{ route('generadorConfigurador') }}">Configurador Identity</a></li>
                    <li><a href="{{ route('generarRoba') }}">Generador de Ropa</a></li>
                    <li><a href="{{ route('generarCombinacio') }}">Combinación Aleatoria</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ route('combinacions') }}">
                    <i class="glyphicon glyphicon-duplicate activat"></i>
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
            <img class="foto_home" src="{{ URL::asset('img/titol.png') }}"/>
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
                        <img class="img_home" src="{{ URL::asset('img/contingut/cabell.png') }}"/>
                        <img class="img_home" src="{{ URL::asset('img/contingut/fletxa.png') }}"/>
                        <img class="img_home" src="{{ URL::asset('img/contingut/pell.png') }}"/>
                        <img class="img_home" src="{{ URL::asset('img/contingut/fletxa.png') }}"/>
                        <img class="img_home" src="{{ URL::asset('img/contingut/ull.png') }}"/>
                        <img class="img_home" src="{{ URL::asset('img/contingut/igual.png') }}"/>
                        <img class="img_home" src="{{ URL::asset('img/contingut/roba.png') }}"/>
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
                    <div class="col-md-2"><img class="img_home" src="{{ URL::asset('img/contingut/perfil.png') }}"/><p>Tener tu propio perfil</p></div>
                    <div class="col-md-2"><img class="img_home" src="{{ URL::asset('img/contingut/buscar.png') }}"/><p>Buscar otros perfiles</p></div>
                    <div class="col-md-2"><img class="img_home" src="{{ URL::asset('img/contingut/guardar.png') }}"/><p>Guardar tus combinaciones</p></div>
                    <div class="col-md-2"><img class="img_home" src="{{ URL::asset('img/contingut/opinar.png') }}"/><p>Opinar de las combinaciones</p></div>
                    <div class="col-md-2"><img class="img_home" src="{{ URL::asset('img/contingut/noticies.png') }}"/><p>Leer las últimas novedades</p></div>
                    <div class="col-md-2"><img class="img_home" src="{{ URL::asset('img/contingut/color.png') }}"/><p>Encuentra tu paleta de colores</p></div>
                    
                </div>
        </div>
    </div>
    
@endsection
