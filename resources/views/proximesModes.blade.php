@extends('layouts.app')

@section('sidebar')
    <!--Si esta loggejat li mostrarem una sidebar o una altra-->
    @if (Auth::check())
        <nav id="sidebar">
            <div class="sidebar-header">        
                <h3 class="h3_sidebar">{{ ucfirst(Auth::user()->name) }}</h3> 
                <strong>{{ Auth::user()->name }}</strong>
            </div>

            <ul class="list-unstyled components">
                <li>
                    <a href="{{ url('') }}">
                        <i class="glyphicon glyphicon-home"></i>
                        Inicio
                    </a>
                </li>
                <li>
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">
                        <i class="glyphicon glyphicon-user"></i>
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
                        <i class="glyphicon glyphicon-send"></i>
                        Novedades
                    </a>
                </li>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">
                        <i class="glyphicon glyphicon-link"></i>
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
                        <i class="glyphicon glyphicon-duplicate"></i>
                        Combinación Guardada
                    </a>
                </li>
                <li class="active">
                    <a href="{{ route('proximaModa') }}">
                        <i class="glyphicon glyphicon-briefcase"></i>
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
    @else
      <nav id="sidebar">
            <div class="sidebar-header">

            </div>

            <ul class="list-unstyled components">
                <li>
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
                <li class="active">
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
    @endif
    
@endsection

@section('content')

<div id="novetats" class="panel panel-primary">
  <div class="panel-body">
      <h1 id="titol_novetats"><img src="{{ URL::asset('img/rss.png') }}" alt="rss_dreta"/> Próximas Modas <img src="{{ URL::asset('img/rss.png') }}" alt="rss_esquerra"/> </h1>
  </div>
</div>


<div id="novetats_cos">
    <div id="novetat_darrera" class="col-md-9">
        <div id="novetats_esquerra" class="panel panel-primary">
            <div class="panel-body">
                <?php  
                    try{
                        //print_r($dades['rss']);
                    foreach($dades['rss']->channel->item as $noticia){
                        echo "<hr class='hr'>";
                        echo "<b class='negreta'><a href='".$noticia->link."' target='_blank'>".$noticia->title."</a></b>";
                        echo "<hr class='hr'>";
                        echo $noticia->description;
                    }
                }

                catch(Exception $e){
                    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
                }
                ?>
            </div>
        </div>     
    </div>
    
    <div id="novetat_darrera" class="col-md-3">
        <div id="novetats_dreta" class="panel panel-primary">
            <div class="panel-body">
                <hr class='hr'>
                <b class='negreta'><a href='#' target='_blank'>Calendario</a></b>
                <hr class='hr'>
                <img class="foto_sidebar" src="{{ URL::asset('img/contingut/gif_moda.gif') }}" alt="gif_dreta"/>
                <?php
                    echo $dades['calendari'];
                ?>
                
            </div>    
        </div>
    </div>
</div>



@endsection
