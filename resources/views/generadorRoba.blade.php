@extends('layouts.app')

@section('sidebar')
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3 class="h3_sidebar">{{ ucfirst(Auth::user()->name) }}</h3> 
                
                    
            <strong>{{ Auth::user()->name }}</strong>
              
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
            <li class="active">
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
      <h1 id="titol_novetats"><img src="{{ URL::asset('img/contingut/ropa.png') }}" alt="rss_dreta"/> Ropa del Generador <img src="{{ URL::asset('img/contingut/ropa.png') }}" alt="rss_esquerra"/> </h1>
  </div>
</div>


<div id="afegirModes_Cos" class="panel panel-primary">
    <div class="panel-body">
            <h3 class="h3_normal">Última Paleta Configurada</h3>
            <hr class="hr_dreta">
                <?php
                    for ($i=0; $i<count($dades['colors']); $i++){
                        echo "<div class='col-sm-2 colors-roba' style='background-color:".$dades['colors'][$i].";'></div>";
                    }
                ?>
            <br><br>
            <h3 class="h3_normal">Ropa de la Tienda</h3>
            <hr class="hr_dreta">    
                <?php 
                    for ($i=0; $i<count($dades['roba']); $i++){
                        echo "<div class='col-md-2 cos-roba'><p class='titol-productes'>".$dades['roba'][$i]->nom."</p><hr class='hr-productes'><img class='imatge-productes' src='".URL::asset('img/fotos_productes/'.$dades['roba'][$i]->foto)."'/>".$dades['roba'][$i]->preu."€ <button class='btn btn-primary comprar-bto btn_comprarRoba' data-id='".$dades['roba'][$i]->id."'><span class='glyphicon glyphicon-shopping-cart'></span></button><div class='count-input space-bottom'> <a class='incr-btn' data-action='decrease' href='#'>–</a> <input class='quantity' type='number' readonly name='quantity' value='1'/> <a class='incr-btn' data-action='increase' href='#'>&plus;</a> </div></div>";
                    }

                ?>
        </div>
        
        
        
    </div>


@endsection
